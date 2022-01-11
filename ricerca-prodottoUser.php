<?php

require_once 'connection.php';

$templateParams["home"] = "ris-ricerca.php";
$templateParams["titolo"] = "header.php";
$templateParams["js"] = array("./js/dropdown.js");


$nomeProdotto = "";
if (isset($_GET["nomeProdotto"])) {
    $nomeProdotto = $_GET["nomeProdotto"];
}
$listaProdotti = $dbh->getProductByName($nomeProdotto);
if (count($listaProdotti) > 0) {
    $templateParams["prodotti"] = $listaProdotti;
} else {
    $templateParams["prodotti"] = array();
}


require 'template/base.php';
