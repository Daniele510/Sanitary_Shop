<?php

require_once 'connection.php';

$templateParams["js"] = array("js/login.js");

//controllo utente loggato + campo azione
if (!isUserLoggedIn() || !isset($_GET["action"])) {
    //reindirizzamento al login
    header("location: user-login.php");
}

$templateParams["azione"] = $_GET["action"];
$templateParams["titolo"] = "titoloUser.php";
switch ($templateParams["azione"]) {
    case 'mod-info-carta':
        $templateParams["home"] = "modifica-dati-carta-form.php";
        $templateParams["info-cart"] = $dbh->getCartUserInfo($_SESSION["Email"]);
        break;
    case 'mod-info-spedizione':
        $templateParams["home"] = "mod-info-sped-form.php";
        $templateParams["info-sped"] = $dbh->getDeliveryUserInfo($_SESSION["Email"]);
        break;
    default:
        header("location: user-login.php");
        break;
}

//inclusione template
require 'template/baseUser.php';
