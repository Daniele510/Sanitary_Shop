<?php 

require_once 'connection.php';

$templateParams["js"] = array("js/registration.js");

$templateParams["home"] = "form-registrazione.php";
$templateParams["titolo"] = "header.php";

require 'template/base.php';

?>