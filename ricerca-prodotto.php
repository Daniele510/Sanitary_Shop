<?php

require_once 'connection.php';

$templateParams["home"] = "ris-ricerca.php";
$templateParams["titolo"] = "header.php";
$templateParams["js"] = array("./js/dropdown.js");


$filtri = array();
if(isset($_GET["NomeProdotto"])){
    $filtri["NomeProdotto"] = str_replace(array("+","%20"), " ", $_GET["NomeProdotto"]);
}
else {
    header("location:index.php");
    return;
}
if(isset($_GET["NomeCompagnia"])){
    $filtri["NomeCompagnia"] = [];
    foreach ($_GET["NomeCompagnia"] as $value) {
        array_push($filtri["NomeCompagnia"], str_replace(array("+","%20"), " ", $value));
    }
}
if(isset($_GET["Order"])){
    $filtri["Ordine"] = str_replace(array("+","%20"), " ", $_GET["Order"]);
}
$listaProdotti = $dbh->getProductByFilters($filtri);
if (count($listaProdotti) > 0) {
    $templateParams["prodotti"] = $listaProdotti;
    // raggruppo i diversi produttori
    $templateParams["produttori_distinti"]=[];
    foreach ($listaProdotti as $prodotto){
        array_push($templateParams["produttori_distinti"], $prodotto["NomeCompagnia"]);
    }
    $templateParams["produttori_distinti"] = array_unique($templateParams["produttori_distinti"]);
} else {
    $templateParams["prodotti"] = array();
}

require 'template/base.php';

?>