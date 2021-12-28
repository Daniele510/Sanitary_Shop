<?php 

require_once 'connection.php';

$templateParams["titolo"] = "titoloUser.php";
$templateParams["home"] = "homeUser.php";
$templateParams["categorie"] = $dbh->getCategories();

require './template/baseUser.php';

?>