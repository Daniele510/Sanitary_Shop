<?php

require_once 'connection.php';

$templateParams["js"] = array("js/login.js");

$templateParams["titolo"] = "titoloUser.php";

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

if (isUserLoggedIn()) {
    $templateParams["home"] = "modifica-dati-carta-form.php";
    $templateParams["info-utente"] = $dbh->getInfoUser($_SESSION["Email"]);
} else {
    $templateParams["home"] = "login-form.php";
}

require 'template/baseUser.php';
