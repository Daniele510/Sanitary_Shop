<?php

require_once 'connection.php';




$msg = "";
$location = "login.php";
$action = "";
if (isset($_POST["action"])) {
    switch ($_POST["action"]) {
        case "Aggiungi al carrello":
            if(isset($_POST["id_prodotto"],$_POST["id_fornitore"],$_POST["quantità"]) && is_numeric($POST["id_prodotto"],$POST["id_fornitore"])) {
                $id_prodotto = $POST["id_prodotto"];
                $id_fornitore = $POST["id_fornitore"];
                $qta = !empty($_POST["quantità"]) && is_numeric($_POST["quantità"]) ? $_POST["quantità"] : 1;

                $prodotto = $dbh->getProductById($idprodotto, $idfornitore);
                
                if(!empty($dbh->getProductById($idprodotto, $idfornitore))){
                    if (!isUserLoggedIn()) {
                        $test = "";
                    }
                    if (isUserLoggedIn()) {
                        $res = $dbh->updateCartUserInfo($email = $_SESSION["EmailUser"], $id_prod = $id_prodotto, $id_forn = $id_fornitore, $quantità = $qta);
                        if($res){
                            
                            header("location:product.php");
                         }
                    }
                }
            }
    }
}

?>