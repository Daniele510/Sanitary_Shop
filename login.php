<?php

require_once 'connection.php';

$templateParams["js"] = array("js/login.js", "js/form-validation.js");

$templateParams["header"] = "header.php";

if (isset($_POST["EmailUser"]) && isset($_POST["PasswordUser"]) && !isUserLoggedIn()) {
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
} elseif (isset($_POST["EmailCompany"]) && isset($_POST["PasswordCompany"]) && !isCompanyLoggedIn()) {
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
    header("location:area-aziende/login.php");
}

if (isUserLoggedIn() && count($ris = $dbh->getUserInfo($_SESSION["EmailUser"]))>0) {
    //reperimento delle informazioni dell'utente
    $templateParams["info-utente"] = $ris[0];
    $templateParams["info-utente"]["Notifiche"] = $dbh->getUserNewNotification($_SESSION["EmailUser"]);

    setDefaultLoginHome();

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
    }

} else {
    setLoginHome("login-form.php");
}

if (isset($_GET["action"]) && !isUserLoggedIn()) {
    switch ($_GET["action"]) {
        case 'login-azienda':
            setLoginHome("./template-azienda/login-form.php");
            break;
        case 'registrazione-azienda':
            setLoginHome("./template-azienda/form-registrazione.php");
            break;
        case 'registrazione-utente':
            setLoginHome("form-registrazione.php");
            break;
        default:
            break;
    }
}

$templateParams["home"] = $_SESSION["login-home"];


require 'template/base.php';
