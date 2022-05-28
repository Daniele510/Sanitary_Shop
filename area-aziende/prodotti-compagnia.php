<?php

require_once '../connection.php';

$templateParams["home"] = "lista-prodotti.php";
$templateParams["header"] = "header-with-searchbar.php";
$templateParams["js"] = array("../js/dropdown.js", "../js/company-prod-list-update.js", "../js/text-suggestion.js");

if(!isCompanyLoggedIn()){
    header("location:login.php");
    return;
}

// carico la schermata di inserimento di un nuovo prodotto
if(isset($_GET["action"]) && $_GET["action"]==="ins-new-prod"){
    $templateParams["home"] = "form-info-prodotto.php";
    $templateParams["header"] = "header.php";
    $templateParams["js"] = ["../js/form-validation.js"];
    $templateParams["categorie"] = $dbh->getCategories();
    $templateParams["action"] = $_GET["action"];
    require '../template-azienda/base.php';
    return;
}

$filtri = array();
if(isset($_GET["NomeProdotto"])){
    $filtri["NomeProdotto"] = urldecode($_GET["NomeProdotto"]);
}
if(isset($_GET["NomeCategoria"])){
    $filtri["NomeCategoria"] = [];
    foreach ($_GET["NomeCategoria"] as $value) {
        array_push($filtri["NomeCategoria"], urldecode($value));
    }
}
if(isset($_GET["Order"])){
    $filtri["Ordine"] = urldecode($_GET["Order"]);
}
$listaProdotti = $dbh->getProductByFilters($filtri, $_SESSION['EmailCompany']);
if (count($listaProdotti) > 0) {
    $templateParams["prodotti"] = $listaProdotti;
    // raggruppo i diversi produttori
    $templateParams["categorie"]=[];
    foreach ($listaProdotti as $prodotto){
        array_push($templateParams["categorie"], $prodotto["NomeCategoria"]);
    }
    $templateParams["categorie"] = array_values(array_unique($templateParams["categorie"]));
} else {
    $templateParams["prodotti"] = array();
}

require '../template-azienda/base.php';

?>