<?php 

require_once 'connection.php';

$templateParams["home"] = "product.php";
$templateParams["header"] = "header.php";
$templateParams["js"] = ["./js/cart-manager.js", "./js/back.js"];
$templateParams["back"] = true;

$idprodotto = -1;
$idfornitore = "";
if (isset($_GET['id']) && isset($_GET["idFornitore"])) {
    $idprodotto = $_GET['id'];
    $idfornitore = $_GET["idFornitore"];
} else {
    header("location:index.php");
    return;
}

$prodotto = $dbh->getProductById($idprodotto, $idfornitore);
if(empty($prodotto)){
    $templateParams["titolo_pagina"] = "Prodotto non esistente";
    
}else{
    $templateParams["prodotto"] = $prodotto[0];
    
}


require 'template/base.php';