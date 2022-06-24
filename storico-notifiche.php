<?php

require_once 'connection.php';

if (!isUserLoggedIn()) {
    header("location:index.php");
    return;
}
$templateParams["notifiche"] = $dbh->getPreviewUserNotification($_SESSION["EmailUser"], true);

if(!empty($templateParams["notifiche"])){

    $codNotifica =  !empty($_GET["CodNotifica"]) ? $_GET["CodNotifica"] : $templateParams["notifiche"][0]["CodNotifica"];

    $templateParams["notifica"] = $dbh->getUserNotificationByID($codNotifica, $_SESSION["EmailUser"]);

}

$templateParams["back"] = true;

$templateParams["home"] = "storico_notifiche.php";
$templateParams["header"] = "header.php";
$templateParams["js"] = ["./js/next.js"];

require 'template/base.php';

?>