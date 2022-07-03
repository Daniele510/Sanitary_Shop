<?php 

require_once '../connection.php';

$templateParams["home"] = "company-product.php";
$templateParams["header"] = "../template/header.php";
$templateParams["js"] = ["../js/product-graph.js","../js/refill.js", "https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"];
$templateParams["back"] = true;
$templateParams["no-search"] = true;

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

if (isset($_GET["action"]) && $_GET["action"] == "mod-info-prod") {
    $templateParams["home"] = "form-info-prodotto.php";
    $templateParams["action"] = "mod-info-prod";
    $templateParams["js"] = ["../js/form-validation.js"];
    $templateParams["categorie"] = $dbh->getCategories();
    $templateParams["back"] = false;
}


require '../template-azienda/base.php';

