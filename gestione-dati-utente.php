<?php

require_once 'connection.php';

$templateParams["js"] = array("js/login.js");

//controllo utente loggato + campo azione
if (!isUserLoggedIn() || !isset($_GET["action"])) {
    //reindirizzamento al login
    header("location: login.php");
}

$templateParams["titolo"] = "header.php";
switch ($_GET["action"]) {
    case 'mod-info-carta':
        $templateParams["home"] = "mod-dati-carta-form.php";
        $templateParams["info-cart"] = $dbh->getUserCartInfo($_SESSION["Email"]);
        break;
    case 'mod-info-spedizione':
        $templateParams["home"] = "mod-info-spedizione-form.php";
        $templateParams["info-sped"] = $dbh->getUserDeliveryInfo($_SESSION["Email"]);
        break;
    default:
        header("location: login.php");
        break;
}

//inclusione template
require 'template/base.php';
