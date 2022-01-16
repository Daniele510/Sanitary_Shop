<?php

require_once 'connection.php';

$templateParams["home"] = "ris-ricerca.php";
$templateParams["titolo"] = "header.php";
$templateParams["js"] = array("./js/dropdown.js");


$nomeProdotto = "";
if (isset($_GET["NomeProdotto"])) {
    $nomeProdotto = $_GET["NomeProdotto"];
} else {
    header("location:index.php");
}
$listaProdotti = $dbh->getProductByName($nomeProdotto);
if (count($listaProdotti) > 0) {
    $templateParams["prodotti"] = $listaProdotti;
} else {
    $templateParams["prodotti"] = array();
}


require 'template/base.php';
