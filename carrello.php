<?php 

require_once 'connection.php';

$templateParams["home"] = "userCart.php";
$templateParams["header"] = "header.php";
$templateParams["js"] = ["./js/cart-manager.js"];
$templateParams["titolo_pagina"] = "Il tuo carrello è vuoto";
$templateParams["prodotti_carrello"] = [];
$templateParams["numArticoli"]=0;
$templateParams["totaleCassa"]=0;


if(isUserLoggedIn()){
    $templateParams["prodotti_carrello"] = $dbh->getProductsFromUserCart($_SESSION["EmailUser"]);
    $templateParams["info_carrello"] = $dbh->getUserCartInfo($_SESSION["EmailUser"]);
    if(!empty($templateParams["info_carrello"])){
        $templateParams["numArticoli"]= $templateParams["info_carrello"][0]["NumArticoli"];
        $templateParams["totaleCassa"]= $templateParams["info_carrello"][0]["Totale"];
    }
}

require 'template/base.php';
