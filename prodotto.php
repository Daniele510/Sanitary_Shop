<?php 

require_once 'connection.php';

$templateParams["home"] = "product.php";
$templateParams["header"] = "header.php";

$idprodotto = -1;
$idfornitore = "";
if (isset($_GET['id']) && isset($_GET["idFornitore"])) {
    $idprodotto = $_GET['id'];
    $idfornitore = $_GET["idFornitore"];
} else {
    header("location:index.php");
}

$prodotto = $dbh->getProductById($idprodotto, $idfornitore);
if(empty($prodotto)){
    $templateParams["titolo_pagina"] = "Prodotto non esistente";
    
}else{
    $templateParams["prodotto"] = $prodotto[0];
    
}

if(isset($_POST["aggiungi_al_carrello"])){
    if(isset($_POST["id_prodotto"],$POST["id_fornitore"],$POST["quantità"])) {
        $id_prodotto = $_POST["id_prodotto"];
        $id_fornitore = $POST["id_fornitore"];
        $quantità = $POST["quantità"];

        $prodotto = $dbh->getProductById($idprodotto, $idfornitore);

        if(isUserLoggedIn() && count($dbh->checkUserLogin($_SESSION["EmailUser"]))>0){
            $res = $dbh->updateCartUserInfo();
            if($res){
                
            }
        }
    }
}




require 'template/base.php';