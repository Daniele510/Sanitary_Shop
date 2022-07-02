<?php

require_once 'connection.php';

if (!isUserLoggedIn()) {
    header("location:index.php");
    return;
}
$templateParams["ordini"] = $dbh->getPreviewUserOrders($_SESSION["EmailUser"]);

if(!empty($templateParams["ordini"])){

    $codOrdine =  !empty($_GET["CodOrdine"]) ? $_GET["CodOrdine"] : $templateParams["ordini"][0]["CodOrdine"];

    $res = $dbh->getOrderDetails($codOrdine);

    if(!empty($res) && !empty($res["lista-prodotti"]) && !empty($res["dettagli-ordine"])){
        $templateParams["lista-prodotti"] = $res["lista-prodotti"];
        $templateParams["dettagli-ordine"] = $res["dettagli-ordine"];
        $templateParams["num-articoli"] = count($res["lista-prodotti"]);

        $templateParams["dettagli-ordine"]["CodOrdine"] = $codOrdine;
        $templateParams["dettagli-ordine"]["ImportoTotale"] = $templateParams["dettagli-ordine"]["ImportoFinale"] + $templateParams["dettagli-ordine"]["ScontoTotale"];

    } else {
        $templateParams["lista-prodotti"] = [];
        $templateParams["dettagli-ordine"] = [];
        $templateParams["num-articoli"] = 0;
    }

}

$templateParams["back"] = true;

$templateParams["home"] = "storico_ordini.php";
$templateParams["header"] = "header.php";
$templateParams["js"] = ["./js/ordini.js"];

require 'template/base.php';

?>