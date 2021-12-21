<?php 

session_start();
define("UPLOAD_DIR", "./upload/");
require_once 'db/database.php';
$dbh = new DatabaseHelper("localhost","root","","e-commerce",3306);

?>