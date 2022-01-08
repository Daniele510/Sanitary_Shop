<?php 

require_once 'connection.php';

$templateParams["js"] = array("js/registration.js");

$templateParams["home"] = "registration-form.php";
$templateParams["titolo"] = "titoloUser.php";

require 'template/baseUser.php';

?>