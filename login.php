<?php

require_once 'connection.php';

$templateParams["js"] = array("js/login.js");

$templateParams["titolo"] = "header.php";

if (isset($_POST["Email"]) && isset($_POST["Password"])) {
    $login_result = $dbh->checkLogin($_POST["Email"]);
    if (count($login_result) > 0) {
        $pwd_db = $login_result[0]["Password"];
        $usr_input = $_POST["Password"];
        if (!password_verify($usr_input, $pwd_db)) {
            $templateParams["errorelogin"] = "Errore! Controllare username o password!";
        } else {
            registerLoggedUser($login_result[0]);
        }
    } else {
        $templateParams["errorelogin"] = "Errore! Controllare username o password!";
    }
}

if (isset($_GET["action"])) {
    switch ($_GET["action"]) {
        case 'mod-info-carta':
            setLoginHome("mod-dati-carta-form.php");
            break;
        case 'mod-info-spedizione':
            setLoginHome("mod-info-spedizione-form.php");
            break;
        case 'logout':
            setLoginHome("login-form.php");
            unset($_SESSION["Email"]);
            break;
        default:
            setDefaultLoginHome();
            break;
    }
} else {
    if (isUserLoggedIn()) {
        setDefaultLoginHome();
    } else {
        setLoginHome("login-form.php");
    }
}

if (isUserLoggedIn()) {
    $email = $_SESSION["Email"];
    $ris = $dbh->getInfoUser($email);
    if (!count($ris) > 0) {
        unset($_SESSION["Email"]);
        setLoginHome("login-form.php");
    } else {
        switch ($_SESSION["login-home"]) {
            case 'mod-dati-carta-form.php':
                $templateParams["info-cart"] = $dbh->getUserCartInfo($email);
                break;
            case 'mod-info-spedizione-form.php':
                $templateParams["info-sped"] = $dbh->getUserDeliveryInfo($email);
                break;
            default:
                setDefaultLoginHome();
                $templateParams["info-utente"] = $ris;
                break;
        }
    }
}
$templateParams["home"] = $_SESSION["login-home"];


require 'template/base.php';
