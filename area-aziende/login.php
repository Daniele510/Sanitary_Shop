<?php

require_once '../connection.php';

if (isCompanyLoggedIn() && count($ris = $dbh->getCompanyInfo($_SESSION["EmailCompany"])) > 0) {
    $templateParams["info-azienda"] = $ris[0];
    $templateParams["categorie"] = $dbh->getCategories();
    setDefaultLoginHome();
} elseif (isset($_GET["action"]) && $_GET["action"]=="registrazione") {
    setLoginHome("form-registrazione.php");
}else{
    header("location:../login.php?action=login-azienda");
}

if (isset($_GET["action"]) && isCompanyLoggedIn()) {
    switch ($_GET["action"]) {
        case 'mod-info-azienda':
            setLoginHome("mod-info-azienda.php");
            break;
        case 'logout':
            unset($_SESSION["EmailCompany"]);
            header("location:../login.php?action=login-azienda");
            break;
        // FIXME: rimuovere inserimento nuovo prodotto dalla home e metterlo nelol'apposita sezione
        case 'ins-new-prod':
            setLoginHome("nuovo-prodotto-form.php");
            break;
        default:
            setDefaultLoginHome();
            break;
    }
}

$templateParams["js"] = array("../js/login.js");

$templateParams["header"] = "header.php";

$templateParams["home"] = $_SESSION["login-home"];

require '../template-azienda/base.php';
