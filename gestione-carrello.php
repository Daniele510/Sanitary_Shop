<?php

require_once 'connection.php';




$msg = "";
$location = "";
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
                        $res = $dbh->updateCartUserInfo($email = $_SESSION["EmailUser"], $id_prod = $id_prodotto, $id_forn = $id_fornitore, $quantità = $qta);
                        echo $res;
                        return;
                    }
                }

        case "Acquista ora":
            if (!isUserLoggedIn()) {
               header("location: login.php");
               return;
            }
            if(isset($_POST["id_prodotto"],$_POST["id_fornitore"])) {
                $qta = 1;
                if(isset($_POST["quantità"]) && $_POST["quantità"] > 1){
                    $qta = $_POST["quantità"];
                }
                $res=$dbh->getProductById($_POST["id_prodotto"],$_POST["id_fornitore"]);
                if(empty($res)){
                    header("location: index.php");
                    return;
                }else if($res[0]["QtaInMagazzino"] >= $qta){
                    $prodotto_ordine = [['CodProdotto' => $_POST["id_prodotto"], 'CodFornitore' => $_POST["id_fornitore"], 'Qta' => $qta]];

                    setTmpOrder($prodotto_ordine, 600);
                    header("location: acquisto.php");
                    return;
                }else{
                    header("location: prodotto.php?id=".$_POST['id_prodotto']."&idFornitore=".$_POST['id_fornitore']);
                    return;
                }
            }
            header("location: index.php");
            return;

        case "Vai alla cassa":
            if (!isUserLoggedIn()) {
                echo "Utente non loggato";
                return;
            }

            $templateParams["prodotti_carrello"] = $dbh->getProductsFromUserCart($_SESSION["EmailUser"]);
            $prodotti_ordine = [];
            foreach ($templateParams["prodotti_carrello"]  as $value) {
                if(!empty($res=$dbh->getProductById($value["CodProdotto"],$value["CodFornitore"])) && $res[0]["QtaInMagazzino"] >= $value["Qta"]){
                    array_push($prodotti_ordine,array('CodProdotto' => $value["CodProdotto"], 'CodFornitore' => $value["CodFornitore"], 'Qta' => $value["Qta"], 'Prezzo' => $value["Prezzo"]));
                }

            }
            if(empty($prodotti_ordine)){
                echo "Prodotti richiesti non esistenti o quantità richiesta maggiore della quantità in magazzino";
                return;
            }
            setTmpOrder($prodotti_ordine, 600);
            return;

        case "Annulla acquisto":
            deleteTmpOrder();
            return;
        
        case "Aggiorna quantità":
            if(isset($_POST["id_prodotto"],$_POST["id_fornitore"]) && isUserLoggedIn()) {
                $qta = 1;
                if(isset($_POST["quantità"]) && $_POST["quantità"] > 1){
                    $qta = $_POST["quantità"];
                }
                $dbh->updateProductQuantity($_SESSION["EmailUser"], $_POST["id_prodotto"], $_POST["id_fornitore"], $qta);
                echo $dbh->getUserCartInfo($_SESSION["EmailUser"])[0]["Totale"];
            }
            return;
        case "Conferma acquisto":
            if (!isUserLoggedIn()) {
                echo "Errore login";
                return;
            }
            if(empty(getTmpOrder())){
                echo "Errore ordine";
                return;
            }

            $importoSenzaSconto = 0;
            $importoConSconto= 0;
            foreach (getTmpOrder() as $value) {
                $res=$dbh->getProductById($value["CodProdotto"],$value["CodFornitore"])[0];
            
                $importoSenzaSconto += $res["PrezzoUnitario"] * $value["Qta"];
                $importoConSconto += $res["Prezzo"] * $value["Qta"];
            }
            $codiceOrdine = $dbh->createOrder(getTmpOrder(), $_SESSION["EmailUser"], $importoSenzaSconto, $importoSenzaSconto - $importoConSconto);
            if(empty($codiceOrdine)){
                echo "Errore ordine";
                return;
            }
            deleteTmpOrder();
            echo $codiceOrdine;
            return;
           
    }
}



?>