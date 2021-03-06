<?php

require_once 'connection.php';

$templateParams["home"] = "ris-ricerca.php";
$templateParams["header"] = "header.php";
$templateParams["js"] = array("./js/dropdown.js", "js/product-list-update.js");


if(isset($_GET["NomeProdotto"])){
    $filtri["NomeProdotto"] = urldecode($_GET["NomeProdotto"]);
}
else {
    header("location:index.php");
    return;
}
if(isset($_GET["NomeCompagnia"])){
    $filtri["NomeCompagnia"] = [];
    foreach ($_GET["NomeCompagnia"] as $value) {
        array_push($filtri["NomeCompagnia"], urldecode($value));
    }
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
    $templateParams["produttori_distinti"] = [];
    $templateParams["categorie"] = [];
    foreach ($listaProdotti as $prodotto){
        array_push($templateParams["produttori_distinti"], $prodotto["NomeCompagnia"]);
        array_push($templateParams["categorie"], $prodotto["NomeCategoria"]);
    }
    $templateParams["categorie"] = array_values(array_unique($templateParams["categorie"]));
    $templateParams["produttori_distinti"] = array_values(array_unique($templateParams["produttori_distinti"]));
} else {
    $templateParams["prodotti"] = [];
}

require 'template/base.php';

?>