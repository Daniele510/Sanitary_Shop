<?php 

require_once '../connection.php';

$templateParams["home"] = "product.php";
$templateParams["header"] = "header.php";
$templateParams["js"] = [];

$idprodotto = -1;
if(!isCompanyLoggedIn()){
    header("Location: ../login.php?action=login-azienda");
    return;
}

if (isset($_GET['id'])) {
    $idprodotto = $_GET['id'];
} else {
    header("location:prodotti-compagnia.php");
    return;
}

$prodotto = $dbh->getProductById($idprodotto, null,$_SESSION["EmailCompany"]);
if(empty($prodotto)){
    $templateParams["titolo_pagina"] = "Prodotto non esistente";
    
}else{
    $templateParams["prodotto"] = $prodotto[0];
    
}


require '../template-azienda/base.php';