<?php

require_once '../connection.php';

if(isset($_POST["id_prodotto"],$_POST["type"],$_POST["last"]) && isCompanyLoggedIn()) {
    $stats = $dbh->getProductSellStats($_POST["id_prodotto"], $_SESSION["EmailCompany"], $_POST["type"], intval($_POST["last"]));
    $dates = [];
    $numProd  = [];
    foreach($stats as $value){
        array_push($dates,$value["Date"]);
        array_push($numProd,is_null($value["NumProdottiVenduti"])? 0: $value["NumProdottiVenduti"]);
    }

    echo json_encode(["NumProdottiVenduti"=>$numProd,"Date"=>$dates]);
}
return;

?>