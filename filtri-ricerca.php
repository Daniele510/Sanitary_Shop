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
    $filtri["IDCompangia"] = $_POST["IDCompagnia"];
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
        echo
            '<li class="col-12 list-group-item">
                <a href="#" class="card col-12 text-decoration-none text-body p-2">
                    <div class="row g-0 p-0 m-0 justify-content-between justify-content-xl-start gap-xl-4">
                        <div class="col-4 align-self-center">
                            <img src="' . UPLOAD_DIR . $value["ImgPath"] . '" alt="" />
                        </div>
                        <div class="col-7 p-0 m-0">
                            <div class="card-body d-flex flex-wrap">
                                <h5 class="card-title col-12 mb-4"><span class="visually-hidden">nome prodotto </span>' . $value["NomeProdotto"] . '</h5>' .
                                (round($value["PrezzoUnitario"],2) != round($value["Prezzo"],2) ?
                                    '<p class="card-text m-0 mt-2">
                                        <span class="fw-lighter me-3 text-decoration-line-through " aria-hidden="true">
                                            ' . round($value["PrezzoUnitario"], 2) . '€
                                        </span>
                                        <span class="visually-hidden">prezzo scontato</span>' . round($value["Prezzo"], 2) . '€</p>
                                    </p>'
                                : '<p class="card-text m-0 mt-2"><span class="visually-hidden">prezzo</span>' . round($value["PrezzoUnitario"], 2) . '€</p>') . 
                                ($value["QtaInMagazzino"]==0 ?
                                    '<div class="w-auto ms-auto"></div><span class="visually-hidden">prodotto esaurito</span><img src="' . ICON_DIR . "warning-icon.svg" . '" alt=""/></div>'
                                : '') . '
                            </div>
                        </div>
                    </div>
                </a>
            </li>';
    }
} else {
    echo 
    '<li class="col-12 list-group-item">
        <div class="visually-hidden">nessun prodotto trovato</div>
        <img class="bg-white h-100 w-100" id="error_img" src="' . PROD_IMG_DIR . 'no-product.png" alt="" />
    </li>';
}

?>