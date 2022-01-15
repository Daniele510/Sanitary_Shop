<?php

require_once '../connection.php';

if (isCompanyLoggedIn() && count($ris = $dbh->getCompanyInfo($_SESSION["EmailCompany"])) > 0) {
    $templateParams["info-azienda"] = $ris[0];
} else {
    header("location:../login.php?action=login-azienda");
}

if (isset($_GET["action"])) {
    switch ($_GET["action"]) {
        case 'mod-info-azienda':
            setLoginHome("mod-info-azienda.php");
            break;
        case 'logout':
            unset($_SESSION["EmailCompany"]);
            header("location:../login.php?action=login-azienda");
            break;
        default:
            setLoginHome("login-home.php");
            break;
    }
} else {
    setLoginHome("login-home.php");
}

$templateParams["js"] = array("../js/login.js");

$templateParams["header"] = "header.php";

$templateParams["home"] = $_SESSION["login-home"];

require '../template-azienda/base.php';
