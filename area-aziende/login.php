<?php

require_once '../connection.php';

if (isCompanyLoggedIn() && count($ris = $dbh->getCompanyInfo($_SESSION["EmailCompany"])) > 0) {
    $templateParams["info-azienda"] = $ris[0];
    $templateParams["info-azienda"]["Notifiche"] = $dbh->getCompanyNewNotification($_SESSION["EmailCompany"]);
    $templateParams["categorie"] = $dbh->getCategories();
    setDefaultLoginHome();
} else {
    unset($_SESSION["EmailCompany"]);
    header("location:../login.php?action=login-azienda");
    return;
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
        default:
            setDefaultLoginHome();
            break;
    }
}

$templateParams["js"] = array("../js/login.js", "../js/form-validation.js");

$templateParams["header"] = "header.php";

$templateParams["home"] = $_SESSION["login-home"];

require '../template-azienda/base.php';

?>
