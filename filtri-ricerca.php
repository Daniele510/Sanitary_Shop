<?php

require_once 'connection.php';

$filtri = array();

// conversione dei + in spazi ed inserimento dei valori dei filtri scelti dentro ad un vetotre
if(isset($_POST["NomeProdotto"])){
    $filtri["NomeProdotto"] = urldecode($_POST["NomeProdotto"]);
}
if(isset($_POST["NomeCompagnia"])){
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

$result = $dbh->getProductByFilters($filtri);
if(count($result)>0){
    foreach ($result as $value) {
        echo 
            '<li class="col-12">
                <div class="card col-12">
                    <div class="row g-0 p-0 m-0 align-items-center">
                        <div class="col-4">
                            <img src="' . UPLOAD_DIR . $value["ImgPath"] . '" alt="" />
                        </div>
                        <div class="col-8 p-0 m-0">
                            <div class="card-body d-flex flex-wrap">
                                <h5 class="card-title col-12"><span class="visually-hidden">nome prodotto </span>' . $value["NomeProdotto"] . '</h5>
                                <p class="card-text m-0"><span class="visually-hidden">prezzo </span>' . round($value["Prezzo"], 2) . '</p>' . 
                                ($value["QtaInMagazzino"]==0 ?
                                    '<span class="visually-hidden">prodotto esaurito</span><img class="ms-auto" src="' . ICON_DIR . "warning-icon.svg" . '" alt=""/>'
                                : '') . '
                            </div>
                        </div>
                    </div>
                </div>
            </li>';
    }
}

?>