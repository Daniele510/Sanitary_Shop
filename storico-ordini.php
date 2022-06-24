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
        
        if(!empty($_GET["CodProdotto"]) && !empty($_GET["CodFornitore"])){
            $codProdotto = $_GET["CodProdotto"];
            $codFornitore = $_GET["CodFornitore"];
        } else {
            $codProdotto = $templateParams["lista-prodotti"][0]["CodProdotto"];
            $codFornitore = $templateParams["lista-prodotti"][0]["CodFornitore"];
        }

        $res = $dbh->getProductAndStatesInOrderByID($codProdotto, $codFornitore, $codOrdine);
        $templateParams["prodotto"] = $res["prodotto"];
        $templateParams["stati-prodotto"] = $res["stati"];

    } else {
        $templateParams["lista-prodotti"] = [];
        $templateParams["dettagli-ordine"] = [];
        $templateParams["num-articoli"] = 0;
        $templateParams["prodotto"] = [];
        $templateParams["stati-prodotto"] = [];
    }

}

$templateParams["back"] = true;

$templateParams["home"] = "storico_ordini.php";
$templateParams["header"] = "header.php";
$templateParams["js"] = ["./js/ordini.js"];

require 'template/base.php';

?>