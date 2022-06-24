<?php

require_once '../connection.php';

if (!isCompanyLoggedIn()) {
    header("location:login.php");
    return;
}

$templateParams["notifiche"] = $dbh->getPreviewCompanyNotification($_SESSION["EmailCompany"], true);


if(!empty($templateParams["notifiche"])){

    $codNotifica =  !empty($_GET["CodNotifica"]) ? $_GET["CodNotifica"] : $templateParams["notifiche"][0]["CodNotifica"];

    $templateParams["notifica"] = $dbh->getCompanyNotificationByID($codNotifica, $_SESSION["EmailCompany"]);

}

$templateParams["back"] = true;

$templateParams["home"] = "storico_notifiche.php";
$templateParams["header"] = "../template/header.php";
$templateParams["js"] = ["../js/next.js"];
$templateParams["no-search"] = true;

require '../template-azienda/base.php';

?>