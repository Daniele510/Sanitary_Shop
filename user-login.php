<?php 

require_once 'connection.php';

$templateParams["js"] = array("js/login.js");

$templateParams["home"] = "login-form.php";
$templateParams["titolo"] = "titoloUser.php";

require 'template/baseUser.php';

?>