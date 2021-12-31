<?php 

require_once 'connection.php';

$templateParams["titolo"] = "titoloUser.php";
$templateParams["home"] = "homeUser.php";
$templateParams["categorie"] = $dbh->getCategories();
$templateParams["prodotti_scontati"] = $dbh->getRandomDiscountedProduct(3);

require './template/baseUser.php';

?>
