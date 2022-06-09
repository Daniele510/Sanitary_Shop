<?php

require_once 'connection.php';

$filtri = array();

if(isset($_POST["NomeProdotto"])){
    $filtri["NomeProdotto"] = urldecode($_POST["NomeProdotto"]);
}
if(!(isset($_POST["from"]) && $_POST["from"]=="company") && isset($_POST["NomeCompagnia"])){
    $filtri["NomeCompagnia"] = [];
    foreach ($_POST["NomeCompagnia"] as $value) {
        array_push($filtri["NomeCompagnia"], urldecode($value));
    }
}
if (!(isset($_POST["from"]) && $_POST["from"]=="company") && isset($_POST["IDCompagnia"])) {
    $filtri["IDCompagnia"] = $_POST["IDCompagnia"];
}

if(isset($_POST["NomeCategoria"])){
    $filtri["NomeCategoria"] = [];
    foreach ($_POST["NomeCategoria"] as $value) {
        array_push($filtri["NomeCategoria"], urldecode($value));
    }
}
if(isset($_POST["Order"])){
    $filtri["Ordine"] = urldecode($_POST["Order"]);
}
if(isset($_POST["from"]) && $_POST["from"]=="company" && isCompanyLoggedIn()){
    $result = $dbh->getProductByFilters($filtri, $_SESSION["EmailCompany"]);
} else{
    $result = $dbh->getProductByFilters($filtri);
}
if(count($result)>0){
    foreach ($result as $value) {
        echo convertToCard($value);
    }
} else {
    echo 
    '<li class="col-12 list-group-item">
        <img class="bg-white h-100 w-100" id="error_img" src="' . PROD_IMG_DIR . 'no-product.png" alt="nessun prodotto trovato" />
    </li>';
}

function convertToCard($product) {
    $card = '<li class="col-12 list-group-item">';
    if(isset($_POST["from"]) && $_POST["from"]=="company" && isCompanyLoggedIn()){
        $card .= '
            <a href="prodotto.php?id=' . $product["CodProdotto"] .'" class="card col-12 text-decoration-none text-body p-2">';
    } else{
        $card .= '
        <a href="prodotto.php?id=' . $product["CodProdotto"] . '&idFornitore=' . $product["CodFornitore"] .'" class="card col-12 text-decoration-none text-body p-2">';
    }
    $card .= '
            <div class="row g-0 p-0 m-0 justify-content-between justify-content-xl-start gap-xl-4 justify-content-xxs-start">
                <div class="col-4 align-self-center d-xxs-none">
                    <img src="' . UPLOAD_DIR . $product["ImgPath"] . '" alt="" />
                </div>
                <div class="col-7 col-lg-6 p-0 m-0 flex-grow-xxs-1 flex-grow-xl-1">
                    <div class="card-body d-flex flex-wrap">
                        <p class="card-text col-12 mb-4"><span class="visually-hidden">nome prodotto</span>' . $product["NomeProdotto"] . '</p>' .
                        (round($product["PrezzoUnitario"],2) != round($product["Prezzo"],2) ?
                            '<p class="card-text m-0 mt-2 col-12 fw-bold">
                                <span class="fw-lighter me-3 text-decoration-line-through " aria-hidden="true">
                                    ' . round($product["PrezzoUnitario"], 2) . '€
                                </span>
                                <span class="visually-hidden">prezzo scontato</span>' . round($product["Prezzo"], 2) . '€
                            </p>'
                        : '<p class="card-text m-0 mt-2 col-12"><span class="visually-hidden">prezzo</span>' . round($product["PrezzoUnitario"], 2) . '€</p>') . 
                        ($product["QtaInMagazzino"]==0 ?
                            '<div class="w-auto mt-3">
                                <img src="' . ICON_DIR . "warning-icon.svg" . '" alt="prodotto esaurito"/>
                            </div>' : '') . '
                    </div>
                </div>
            </div>
        </a>
    </li>';
    return $card;
}

?>