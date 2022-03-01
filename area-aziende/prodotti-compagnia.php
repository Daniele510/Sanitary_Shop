<?php

require_once '../connection.php';

$templateParams["home"] = "lista-prodotti.php";
$templateParams["header"] = "header-with-searchbar.php";
$templateParams["js"] = array("../js/dropdown.js");

if(!isCompanyLoggedIn()){
    header("location:login.php");
    return;
}

// carico la schermata di inserimento di un nuovo prodotto
if(isset($_GET["action"]) && $_GET["action"]==="ins-new-prod"){
    $templateParams["home"] = "nuovo-prodotto-form.php";
    $templateParams["header"] = "header.php";
    $templateParams["js"] = [];
    require '../template-azienda/base.php';
    return;
}

$filtri = array();
if(isset($_GET["NomeProdotto"])){
    $filtri["NomeProdotto"] = urldecode($_GET["NomeProdotto"]);
}
// FIXME: riesaminare i filtri possibili
// if(isset($_GET["NomeCompagnia"])){
//     $filtri["NomeCompagnia"] = [];
//     foreach ($_GET["NomeCompagnia"] as $value) {
//         array_push($filtri["NomeCompagnia"], str_replace(array("+","%20"), " ", $value));
//     }
// }
if(isset($_GET["Order"])){
    $filtri["Ordine"] = urldecode($_GET["Order"]);
}
$listaProdotti = $dbh->getProductByFilters($filtri,$_SESSION['EmailCompany']);
if (count($listaProdotti) > 0) {
    $templateParams["prodotti"] = $listaProdotti;
    // raggruppo i diversi produttori
    $templateParams["produttori_distinti"]=[];
    foreach ($listaProdotti as $prodotto){
        array_push($templateParams["produttori_distinti"], $prodotto["NomeCompagnia"]);
    }
    $templateParams["produttori_distinti"] = array_unique($templateParams["produttori_distinti"]);
} else {
    $templateParams["prodotti"] = array();
}

require '../template-azienda/base.php';

?>