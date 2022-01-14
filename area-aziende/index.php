<?php 

require_once '../connection.php';

if(!isCompanyLoggedIn()){
    header("location:login.php");
}

$templateParams["header"] = "header.php";

require '../template-azienda/base.php';
?>