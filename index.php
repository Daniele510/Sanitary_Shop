<?php 

require_once 'connection.php';

if(isCompanyLoggedIn()){
    header("location:area-aziende/index.php");
}

$templateParams["titolo"] = "header.php";
$templateParams["home"] = "home.php";
$templateParams["categorie"] = $dbh->getCategories();
$templateParams["prodotti-scontati"] = $dbh->getRandomDiscountedProduct(3);
$templateParams["prodotti_consigliati"] = $dbh->getRandomProduct(5);

$templateParams["js"] = array("./js/homeUser.js");

require './template/base.php';

?>