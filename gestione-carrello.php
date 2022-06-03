<?php

require_once 'connection.php';




$msg = "";
$location = "prodotto.php";
$action = "";
if (isset($_POST["action"])) {
    switch ($_POST["action"]) {
        case "Aggiungi al carrello":
            if(isset($_POST["id_prodotto"],$_POST["id_fornitore"],$_POST["quantità"]) && is_numeric($_POST["id_prodotto"]) && is_numeric($_POST["id_fornitore"])) {
                $id_prodotto = $_POST["id_prodotto"];
                $id_fornitore = $_POST["id_fornitore"];
                $qta = !empty($_POST["quantità"]) && is_numeric($_POST["quantità"]) ? $_POST["quantità"] : 1;

                $prodotto = $dbh->getProductById($id_prodotto, $id_fornitore);
                
                if(!empty($prodotto)){
                    if (!isUserLoggedIn()) {
                        return;
                    }
                    }
                    if (isUserLoggedIn()) {
                        $res = $dbh->updateCartUserInfo($email = $_SESSION["EmailUser"], $id_prod = $id_prodotto, $id_forn = $id_fornitore, $quantità = $qta);
                        echo $res;
                        return;
                    }
                }
    }
}


?>