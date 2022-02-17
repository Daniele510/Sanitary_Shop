<?php

$result = $_GET["result"];
$res = explode("&",$result);
foreach ($res as $res) {
    echo $res . " ";
}
?>