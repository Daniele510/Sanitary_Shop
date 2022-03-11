<?php 

session_start();
define("UPLOAD_DIR", "../../Sanitary_Shop/upload/");
define("ICON_DIR", UPLOAD_DIR . "iconImgs/");
require_once("utils/functions.php");
require_once("db/database.php");
$dbh = new DatabaseHelper("localhost", "root", "", "sanitary_shop","3307");

?>