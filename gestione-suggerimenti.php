<?php

require_once 'connection.php';

if (isset($_POST["NomeProdotto"])) {
    $result = [];
    if(isset($_POST["from"]) && $_POST["from"]=="company" && isCompanyLoggedIn()){
        $res = $dbh->getProductByFilters(filtri:["NomeProdotto" => $_POST["NomeProdotto"]], emailCompany:$_SESSION["EmailCompany"]);
    } else {
        $res = $dbh->getProductByFilters(filtri:["NomeProdotto" => $_POST["NomeProdotto"]]);
    }
    foreach($res as $val){
       array_push($result, '<option value="' . $val["NomeProdotto"] . '">');
    }
    echo (count($result) > 0 ? json_encode(["productsSeggestion" => implode(" ", $result)]) : json_encode([]));
}

?>