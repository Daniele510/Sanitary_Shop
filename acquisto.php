<?php

require_once 'connection.php';


if (!isUserLoggedIn()) {
    header("location:login.php");
    return;
}

$templateParams["prodotti_ordine"] = [];
$templateParams["ImportoSenzaSconto"] = 0;
$templateParams["ImportoConSconto"] = 0;
if(empty(getTmpOrder())){
    header("location:carrello.php");
    return;
}
foreach (getTmpOrder() as $value) {
    $res=$dbh->getProductById($value["CodProdotto"],$value["CodFornitore"])[0];
    array_push($templateParams["prodotti_ordine"],array('CodProdotto' => $value["CodProdotto"], 'CodFornitore' => $value["CodFornitore"], 'Qta' => $value["Qta"], 'Prezzo' => $res["Prezzo"],  'ImgPath' => $res["ImgPath"], 'NomeProdotto' => $res["NomeProdotto"]));

    $templateParams["ImportoSenzaSconto"] += $res["PrezzoUnitario"] * $value["Qta"];
    $templateParams["ImportoConSconto"] += $res["Prezzo"] * $value["Qta"];
}
$templateParams["Sconto"] = $templateParams["ImportoSenzaSconto"] - $templateParams["ImportoConSconto"]; 

$templateParams["info_utente"] = $dbh->getUserInfo($_SESSION["EmailUser"])[0];

$templateParams["home"] = "conferma-acquisto.php";
$templateParams["header"] = "header.php";
$templateParams["js"] = ["./js/order-manager.js"];

require 'template/base.php';

?>