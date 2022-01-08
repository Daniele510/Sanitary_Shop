<?php 

require_once 'connection.php';

$templateParams["home"] = "userCart.php";
$templateParams["titolo"] = "titoloUser.php";
$templateParams["titolo_pagina"] = "Il tuo carrello è vuoto";

$totaleCassa="";
$articoli=array();
$numArticoli= count($articoli);
$testo1= "articolo";
$testo2= "articoli";
require 'template/baseUser.php';
