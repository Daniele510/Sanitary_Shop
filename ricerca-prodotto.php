<?php

require_once 'connection.php';

$templateParams["home"] = "ris-ricerca.php";
$templateParams["titolo"] = "header.php";
$templateParams["js"] = array("./js/dropdown.js");


$filtri = array();
if(isset($_GET["NomeProdotto"])){
    $filtri["NomeProdotto"] = $_GET["NomeProdotto"];
} else {
    header("location:index.php");
    return;
}
if(isset($_GET["NomeCompagnia[]"])){
    foreach ($_GET["NomeCompagnia"] as $value) {
        array_push($filtri["NomeCompagnia"],$value);
    }
}
if(isset($_GET["Ordine"])){
    $filtri["Ordine"] = $_POST["Ordine"];
}
$listaProdotti = $dbh->getProductByFilters($filtri);
if (count($listaProdotti) > 0) {
    $templateParams["prodotti"] = $listaProdotti;
} else {
    $templateParams["prodotti"] = array();
}


require 'template/base.php';
