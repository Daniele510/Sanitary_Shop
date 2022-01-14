<?php

require_once 'connection.php';

$templateParams["js"] = array("js/login.js");

$templateParams["titolo"] = "header.php";

if (isset($_POST["EmailUser"]) && isset($_POST["PasswordUser"])) {
    $login_result = $dbh->checkUserLogin($_POST["EmailUser"]);
    if (count($login_result) > 0) {
        $pwd_db = $login_result[0]["Password"];
        $usr_input = $_POST["PasswordUser"];
        if (!password_verify($usr_input, $pwd_db)) {
            $templateParams["errorelogin"] = "Errore! Controllare username o password!";
        } else {
            registerLoggedUser($login_result[0]);
        }
    } else {
        $templateParams["errorelogin"] = "Errore! Controllare username o password!";
    }
} elseif(isset($_POST["EmailCompany"]) && isset($_POST["PasswordCompany"])){
    $login_result = $dbh->checkCompanyLogin($_POST["EmailCompany"]);
    if (count($login_result) > 0) {
        $pwd_db = $login_result[0]["Password"];
        $usr_input = $_POST["PasswordCompany"];
        if (!password_verify($usr_input, $pwd_db)) {
            $templateParams["errorelogin"] = "Errore! Controllare username o password!";
        } else {
            registerLoggedCompany($login_result[0]);
        }
    } else {
        $templateParams["errorelogin"] = "Errore! Controllare username o password!";
    }
}

if (isset($_GET["action"])) {
    switch ($_GET["action"]) {
        case 'mod-info-carta':
            if (isUserLoggedIn()) {
                setLoginHome("mod-dati-carta-form.php");
                break;
            }
        case 'mod-info-spedizione':
            if (isUserLoggedIn()) {
                setLoginHome("mod-info-spedizione-form.php");
                break;
            }
        case 'logout':
            setLoginHome("login-form.php");
            unset($_SESSION["EmailUser"]);
            break;
        case 'login-azienda':
            setLoginHome("./template-azienda/login-form.php");
            break;
        default:
            if (isUserLoggedIn()) {
                setDefaultLoginHome();
            } else {
                setLoginHome("login-form.php");
            }
            break;
    }
} else {
    if (isUserLoggedIn()) {
        setDefaultLoginHome();
    } else {
        setLoginHome("login-form.php");
    }
}

if(isCompanyLoggedIn()){
    header("location:./area-aziende/login.php");
}

if (isUserLoggedIn()) {
    $email = $_SESSION["EmailUser"];
    $ris = $dbh->getInfoUser($email);
    if (!count($ris) > 0) {
        unset($_SESSION["EmailUser"]);
        setLoginHome("login-form.php");
    } else {
        switch ($_SESSION["login-home"]) {
            case 'mod-dati-carta-form.php':
                $templateParams["info-cart"] = $dbh->getUserCartInfo($email);
                break;
            case 'mod-info-spedizione-form.php':
                $templateParams["info-sped"] = $dbh->getUserDeliveryInfo($email);
                break;
            case './template-azienda/login-form.php':

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
