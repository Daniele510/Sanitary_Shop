<?php

require_once 'connection.php';


if (!isUserLoggedIn()) {
    header("location:login.php");
    return;
}

$templateParams["home"] = "dett-ordine.php";
$templateParams["header"] = "header.php";
if(empty($_GET["CodOrdine"])){
    header("location:index.php");
    return;
}

$res = $dbh->getOrderDetails($_GET["CodOrdine"]);
$templateParams["prodotti_ordine"] = $res["lista-prodotti"];
$templateParams["dettagli-ordine"] = $res["dettagli-ordine"];
$templateParams["num-articoli"] = count($res["lista-prodotti"]);

$templateParams["dettagli-ordine"]["CodOrdine"] = $_GET["CodOrdine"];
$templateParams["dettagli-ordine"]["ImportoSenzaSconto"] = $templateParams["dettagli-ordine"]["ImportoConSconto"] + $templateParams["dettagli-ordine"]["ScontoTotale"];

require 'template/base.php';

?>