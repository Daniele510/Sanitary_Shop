<?php

require_once '../connection.php';

$templateParams["js"] = array("../js/form-validation.js");

if (isUserLoggedIn()) {
    header("location:../login.php");
    return;
}

if (isCompanyLoggedIn() && count($ris = $dbh->getCompanyInfo($_SESSION["EmailCompany"])) > 0) {
    $templateParams["info-azienda"] = $ris[0];
    $templateParams["info-azienda"]["Notifiche"] = $dbh->getPreviewCompanyNotification($_SESSION["EmailCompany"]);
    setDefaultLoginHome();
} else {
    logoutCompany();
    header("location:../login.php?action=login-azienda");
    return;
}

if (isset($_GET["action"])) {
    switch ($_GET["action"]) {
        case 'mod-info-azienda':
            setLoginHome("mod-info-azienda.php");
            break;
        case 'logout':
            logoutCompany();
            header("location:../login.php");
            return;
        default:
            setDefaultLoginHome();
            break;
    }
}


$templateParams["header"] = "../template/header.php";
$templateParams["no-search"] = true;
$templateParams["home"] = $_SESSION["login-home"];
$templateParams["stat-venditore"] = $dbh->getCompanyStats($_SESSION["EmailCompany"]);

require '../template-azienda/base.php';

?>
