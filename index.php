<?php 

require_once 'connection.php';

$templateParams["titolo"] = "titoloUser.php";
$templateParams["home"] = "homeUser.php";
$templateParams["categorie"] = $dbh->getCategories();
$templateParams["prodotti-scontati"] = $dbh->getRandomDiscountedProduct(3);
$templateParams["prodotti_consigliati"] = $dbh->getRandomProduct(5);

$templateParams["js"] = array("./js/homeUser.js");

require './template/baseUser.php';

?>