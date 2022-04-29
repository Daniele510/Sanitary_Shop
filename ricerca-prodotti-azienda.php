<?php

require_once 'connection.php';

$templateParams["home"] = "lista-prodotti-azienda.php";
$templateParams["header"] = "header.php";
$templateParams["js"] = array("./js/dropdown.js", "js/company-pr-list.js");

if(isset($_GET["idFornitore"])){
    $filtri["IDCompagnia"] = urldecode($_GET["idFornitore"]);
} else {
    header("location:index.php");
    return;
}
if(isset($_GET["NomeCategoria"])){
    $filtri["NomeCategoria"] = [];
    foreach ($_GET["NomeCategoria"] as $value) {
        array_push($filtri["NomeCategoria"], urldecode($value));
    }
}
if(isset($_GET["Order"])){
    $filtri["Ordine"] = urldecode($_GET["Order"]);
}

$listaProdotti = $dbh->getProductByFilters($filtri);
if (count($listaProdotti) > 0) {
    $templateParams["prodotti"] = $listaProdotti;
    // raggruppo i diversi produttori
    $templateParams["categorie"] = [];
    foreach ($listaProdotti as $prodotto){
        array_push($templateParams["categorie"], $prodotto["NomeCategoria"]);
    }
    $templateParams["categorie"] = array_values(array_unique($templateParams["categorie"]));
} else {
    $templateParams["prodotti"] = array();
}

require 'template/base.php';

?>