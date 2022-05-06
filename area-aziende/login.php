<?php

require_once '../connection.php';

$templateParams["js"] = array("../js/form-validation.js");

if (isUserLoggedIn()) {
    header("location:../login.php");
    return;
}

if (isCompanyLoggedIn() && count($ris = $dbh->getCompanyInfo($_SESSION["EmailCompany"])) > 0) {
    $templateParams["info-azienda"] = $ris[0];
    $templateParams["info-azienda"]["Notifiche"] = $dbh->getCompanyNotification($_SESSION["EmailCompany"]);
    setDefaultLoginHome();
} else {
    rememberMe("ID_Company", "", -1); // elimino il cookie
    if (isset($_SESSION["EmailCompany"])){
        unset($_SESSION["EmailCompany"]);  
    }
    header("location:../login.php?action=login-azienda");
    return;
}

if (isset($_GET["action"])) {
    switch ($_GET["action"]) {
        case 'mod-info-azienda':
            setLoginHome("mod-info-azienda.php");
            break;
        case 'logout':
            rememberMe("ID_Company", "", -1); // elimino il cookie
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
