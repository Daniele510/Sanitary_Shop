<?php

require_once './connection.php';

if (isUserLoggedIn()) {
    header("location:login.php");
} elseif (isCompanyLoggedIn()) {
    header("location:area-aziende/login.php");
}

$templateParams["js"] = array("js/registration.js");

$templateParams["home"] = "template-azienda/form-registrazione.php";
$templateParams["titolo"] = "header.php";

require 'template/base.php';
