<?php

require_once 'connection.php';

$templateParams["home"] = "lista-prodotti.php";
$templateParams["titolo"] = "titoloUser.php";
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


require 'template/baseUser.php';
