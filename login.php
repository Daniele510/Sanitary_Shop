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
            print($_SESSION["login-home"]);
            break;
        case 'default':
            setDefaultLoginHome();
            break;
        default:
            if (!empty($_SESSION["login-home"])) {
                unset($_SESSION["login-home"]);
            }
            break;
    }
}

if (isUserLoggedIn()) {
    $email = $_SESSION["Email"];
    if (!empty($_SESSION["login-home"])) {
        switch ($_SESSION["login-home"]) {
            case 'login-home.php':
                $templateParams["info-utente"] = $dbh->getInfoUser($email);
                break;
            case 'mod-dati-carta-form.php':
                $templateParams["info-cart"] = $dbh->getUserCartInfo($email);
                break;
            case 'mod-info-spedizione-form.php':
                $templateParams["info-sped"] = $dbh->getUserDeliveryInfo($email);
                break;
            default:
                // TODO: possibile schermata di errore
                break;
        }
    } else {
        setDefaultLoginHome();
        $templateParams["info-utente"] = $dbh->getInfoUser($email);
    }
    $templateParams["home"] = $_SESSION["login-home"];
} else {
    $templateParams["home"] = "login-form.php";
}

require 'template/base.php';
