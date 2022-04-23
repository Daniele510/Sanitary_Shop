<?php 

require_once 'connection.php';

$templateParams["home"] = "userCart.php";
$templateParams["header"] = "header.php";
$templateParams["titolo_pagina"] = "Il tuo carrello è vuoto";
$numArticoli = 0;


if(isset($POST[""]))


if(isset($POST["aggiungi_al_carrello"])){ 
    if(isset($COOKIE["carrello"])){
        $cookie_data = stripslashes($_COOKIE['carrello']);
        $templateParams["dati_carrello"] = json_decode($cookie_data, true);
    }else{
        $templateParams["dati_carrello"]=array();
    }
    $lista_cod_prodotti = array_column($templateParams["dati_carrello"], 'id_prodotto');
    
    if(in_array($_POST["id_nascosto"],$lista_cod_prodotti)){
        foreach($templateParams["dati_carrello"] as $keys => $values){
            if($templateParams["dati_carrello"][$keys]['id_prodotto'] == $_POST["id_nascosto"]){
                $templateParams["dati_carrello"][$keys]["quantità_prodotto"] = $templateParams["dati_carrello"][$keys]["quantità_prodotto"] + $_POST["quantità"];
            }
        }
    }else{
        $array_dati = array(
            'id_prodotto' => $_POST["id_nascosto"],
            'nome_prodotto' => $_POST["nome_nascosto"],
            'prezzo_prodotto' => $_POST["prezzo_nascosto"],
            'quantità_prodotto' => $_POST["quantità"]
        );
        $templateParams["dati_carrello"][] = $array_dati;
    }

    $dati_prodotto = json_encode($templateParams["dati_carrello"]);
    setcookie('carrello', $dati_prodotto, time()+(86400*30));
    header("location:userCart.php?success=1");

}


$templateParams["totaleCassa"]="";

$testo1= "articolo";
$testo2= "articoli";
require 'template/base.php';
