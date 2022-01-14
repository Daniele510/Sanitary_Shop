<?php

require_once '../connection.php';

if (isCompanyLoggedIn() && count($ris = $dbh->getInfoCompany($_SESSION["EmailCompany"])) > 0) {
    $templateParams["info-azienda"] = $ris[0];
} else {
    header("location:../login.php");
}

$templateParams["js"] = array("../js/login.js");

$templateParams["header"] = "header.php";


$templateParams["home"] = "login-home.php";

require '../template-azienda/base.php';
