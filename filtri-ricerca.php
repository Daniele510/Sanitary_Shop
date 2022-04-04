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
if(isset($_POST["NomeCategoria"])){
    $filtri["NomeCategoria"] = [];
    foreach ($_POST["NomeCategoria"] as $value) {
        array_push($filtri["NomeCategoria"], urldecode($value));
    }
}
if(isset($_POST["Order"])){
    $filtri["Ordine"] = urldecode($_POST["Order"]);
}
if(isset($_POST["from"]) && isCompanyLoggedIn()){
    $result = $dbh->getProductByFilters($filtri, $_SESSION["EmailCompany"]);
} else{
    $result = $dbh->getProductByFilters($filtri);
}
if(count($result)>0){
    foreach ($result as $value) {
        echo
            '<li class="col-12">
                <a href="#" class="card col-12 text-decoration-none text-body">
                    <div class="row g-0 p-0 m-0 align-items-center">
                        <div class="col-4">
                            <img src="' . UPLOAD_DIR . $value["ImgPath"] . '" alt="" />
                        </div>
                        <div class="col-8 p-0 m-0">
                            <div class="card-body d-flex flex-wrap">
                                <h5 class="card-title col-12"><span class="visually-hidden">nome prodotto </span>' . $value["NomeProdotto"] . '</h5>' .
                                (round($value["PrezzoUnitario"],2) != round($value["Prezzo"],2) ?
                                    '<p class="card-text m-0 text-decoration-line-through fw-lighter me-3" aria-hidden="true">' . round($value["PrezzoUnitario"], 2) . '€</p>
                                    <p class="card-text m-0"><span class="visually-hidden">prezzo scontato</span>' . round($value["Prezzo"], 2) . '€</p>' 
                                    : '<p class="card-text m-0"><span class="visually-hidden">prezzo</span>' . round($value["PrezzoUnitario"], 2) . '€</p>') . 
                                ($value["QtaInMagazzino"]==0 ?
                                    '<span class="visually-hidden">prodotto esaurito</span><img class="ms-auto" src="' . ICON_DIR . "warning-icon.svg" . '" alt=""/>'
                                : '') . '
                            </div>
                        </div>
                    </div>
                </a>
            </li>';
    }
} else {
    echo 
    '<li class="col-12">
        <div class="visually-hidden">nessun prodotto trovato</div>
        <img id="error_img" src="' . PROD_IMG_DIR . 'no-product.png" alt="" />
    </li>';
}

?>