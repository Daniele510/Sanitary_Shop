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
} elseif (isset($_POST["EmailCompany"]) && isset($_POST["PasswordCompany"])) {
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


if (isCompanyLoggedIn()) {
    header("location:./area-aziende/login.php");
}

if (isset($_GET["action"]) && ($_GET["action"] === "login-azienda")) {
    unset($_SESSION["EmailUser"]);
    setLoginHome("./template-azienda/login-form.php");
}

if (isUserLoggedIn() &&  count($ris = $dbh->getUserInfo($_SESSION["EmailUser"]))) {
    //reperimento delle informazioni dell'utente
    $templateParams["info-utente"] = $ris[0];

    //aggiornamento section in base all'azione richiesta
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
                unset($_SESSION["EmailUser"]);
                break;
            default:
                setDefaultLoginHome();
                break;
        }
    } else {
        setDefaultLoginHome();
    }
} else {
    setLoginHome("login-form.php");
}

$templateParams["home"] = $_SESSION["login-home"];


require 'template/base.php';
