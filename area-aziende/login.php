<?php

require_once '../connection.php';

$templateParams["js"] = array("../js/login.js", "../js/form-validation.js");

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

if (isset($_GET["action"])) {
    switch ($_GET["action"]) {
        case 'mod-info-azienda':
            setLoginHome("mod-info-azienda.php");
            array_push($templateParams["js"], "../js/form-validation-with-confirm.js");
            $templateParams["js"] = array_diff($templateParams["js"], ["../js/form-validation.js"]);
            break;
        case 'logout':
            unset($_SESSION["EmailCompany"]);
            header("location:../login.php?action=login-azienda");
            return;
        default:
            setDefaultLoginHome();
            break;
    }
}


$templateParams["header"] = "header.php";

$templateParams["home"] = $_SESSION["login-home"];

require '../template-azienda/base.php';

?>
