<?php 

require_once 'connection.php';

$templateParams["home"] = "product.php";
$templateParams["titolo"] = "header.php";

$idprodotto = -1;
$idfornitore = "";
if (isset($_GET['id']) && isset($_GET["idFornitore"])) {
    $idprodotto = $_GET['id'];
    $idfornitore = $_GET["idFornitore"];
} else {
    header("location:index.php");
}

$prodotto = $dbh->getProductById($idprodotto, $idfornitore);
if(!$prodotto){
    $templateParams["titolo_pagina"] = "Prodotto non esistente";
    
}else{
    $templateParams["prodotto"] = $prodotto;
}

require 'template/base.php';