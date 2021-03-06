<?php

require_once '../connection.php';

if (isUserLoggedIn()) {
    header("location:../login.php");
    return;
}

if (isset($_GET["action"]) && $_GET["action"]=="ins-new-azienda" && !isCompanyLoggedIn()) {
    $msg;
    // Controllo sui valori di input prima di inviare al database i dati
    if(isset($_POST["NomeCompagnia"]) && !empty($_POST["PartitaIVA"]) && is_numeric($partitaIVA = str_replace(array(" ","-"), "", $_POST["PartitaIVA"])) && !empty($_POST["NumeroTelefono"]) && is_numeric($num_telefono = str_replace(array(" ","-"), "", $_POST["NumeroTelefono"])) && isset($_POST["Ind_Via"]) && isset($_POST["Ind_Citta"]) && count($info_citta = explode(" ", $_POST["Ind_Citta"]))>=3 && isset($_POST["Ind_Paese"]) && !is_numeric($_POST["Ind_Paese"]) && isset($_POST["Email"]) && isset($_POST["Password"]) && strlen($_POST["Password"])>=8){
        $nome = $_POST["NomeCompagnia"];
        $ind_via = $_POST["Ind_Via"];
        $ind_citta = $info_citta[0];
        $ind_provincia = $info_citta[1];
        $ind_CAP = $info_citta[2];
        $ind_paese = $_POST["Ind_Paese"];
        $email = $_POST["Email"];
        // hash password
        $password = password_hash($_POST["Password"], PASSWORD_DEFAULT);
        $res = $dbh->insertNewCompany($nome, $partitaIVA, $num_telefono, $ind_via, $ind_citta, $ind_provincia, $ind_CAP, $ind_paese, $email, $password);
        // controllo che l'inserimento dei dati sia andato a buon fine
        if($res){
            header("location:../login.php?action=login-azienda");
            return;
        }
        $msg = "email o partita iva già presenti";
    }
    header("location: ../login.php?action=registrazione-azienda&err-msg=" . (isset($msg) ? $msg : "dati inseriti non validi"));
    return;
}

if (!isCompanyLoggedIn()) {
    header("location:../login.php?action=login-azienda");
} else {
    $msg = "";
    $location = "login.php";
    $action = "";
    if (isset($_GET["action"])) {
        switch ($_GET["action"]) {
            case 'mod-info-azienda':
                $location = "login.php";
                $action = "mod-info-azienda";
                $msg = "dati inseriti non validi";
                
                // Controllo sui valori di input prima di inviare al database i dati
                if (isset($_POST["NomeCompagnia"]) && !empty($_POST["NumeroTelefono"]) && is_numeric($num_telefono = str_replace(array(" ","-"), "", $_POST["NumeroTelefono"])) && isset($_POST["Ind_Via"]) && isset($_POST["Ind_Citta"]) && count($info_citta = explode(" ", $_POST["Ind_Citta"]))>=3 && isset($_POST["Ind_Paese"]) && !is_numeric($_POST["Ind_Paese"])) {
                    $nome = $_POST["NomeCompagnia"];
                    $ind_via = $_POST["Ind_Via"];
                    $ind_citta = $info_citta[0];
                    $ind_provincia = $info_citta[1];
                    $ind_CAP = $info_citta[2];
                    $ind_paese = $_POST["Ind_Paese"];
                    $email = $_SESSION["EmailCompany"];
                    $res =  $dbh->updateCompanyInfo($email, $nome, $num_telefono, $ind_via, $ind_citta, $ind_provincia, $ind_CAP, $ind_paese);
                    if ($res) {
                        header("location:login.php");
                        return;
                    }
                }
                break;

            case 'ins-new-prod':
                // imposto il messaggio di un errore generico
                $location = "prodotti-compagnia.php";
                $action = "ins-new-prod";
                $msg = "dati inseriti non validi";

                // Controllo sui valori di input prima di inviare al database i dati
                if (isset($_POST["CodProdotto"]) && !empty($_POST["NomeProdotto"]) && !empty($_POST["Descrizione"]) && !empty($_POST["Prezzo"]) && is_numeric($_POST["Prezzo"]) && !empty($_POST["CodCategoria"]) && is_numeric($_POST["CodCategoria"]) && isset($_FILES["Immagine"]) && !empty($_POST["MaxQta"]) && is_numeric($_POST["MaxQta"])) {
                    $cod = $_POST["CodProdotto"];
                    $nome = $_POST["NomeProdotto"];
                    $desc = $_POST["Descrizione"];
                    $img = $_FILES["Immagine"];
                    list($result, $resmsg, $fullPath) = uploadImage(PROD_IMG_DIR, $img);
                    $prezzo = $_POST["Prezzo"];
                    $sconto = !empty($_POST["Sconto"]) ? ($_POST["Sconto"] <= 100 ? $_POST["Sconto"] : 100) : 0;
                    $maxQta = $_POST["MaxQta"];
                    $codCategoria = $_POST["CodCategoria"];
                    $inVendita = isset($_POST["InVendita"]) ? 1 : 0;
                    $emailCompany = $_SESSION["EmailCompany"];
                    if ($result != 0) {
                        $res = $dbh->insertNewProduct($cod, $nome, $desc, str_replace(UPLOAD_DIR, "", $fullPath), $prezzo, $sconto, $maxQta, $emailCompany, $codCategoria, $inVendita);
                        if ($res) {
                            header("location:lista-prodotti.php");
                            return;
                        }
                        $msg = "codice prodotto già presente";
                        removeImg($fullPath);
                    } else {
                        $msg = $resmsg;
                    }
                }
                break;
            
            case 'mod-info-prod':
                // imposto il messaggio di un errore generico
                $location = "prodotti-compagnia.php";
                $action = "ins-new-prod";
                $msg = "dati inseriti non validi";

                // Controllo sui valori di input prima di inviare al database i dati
                if (isset($_POST["CodProdotto"]) && !empty($_POST["NomeProdotto"]) && !empty($_POST["Descrizione"]) && !empty($_POST["Prezzo"]) && is_numeric($_POST["Prezzo"]) && $_POST["Prezzo"] >= 1 && !empty($_POST["CodCategoria"]) && is_numeric($_POST["CodCategoria"]) && !empty($_POST["MaxQta"]) && is_numeric($_POST["MaxQta"]) && $_POST["MaxQta"] >= 1) {

                    $cod = $_POST["CodProdotto"];

                    
                    $product = $dbh->getProductById($cod, null, $_SESSION["EmailCompany"]);
                    if (empty($product)){
                        // torno alla pagina dei prodotti nel caso non esista il prodotto
                        header("location:prodotti-compagnia.php");
                        return;
                    }
                    
                    
                    $desc = $_POST["Descrizione"];
                    $img = $_FILES["Immagine"];
                    
                    if (!empty($img["name"])) {
                        list($result, $resmsg, $fullPath) = uploadImage(PROD_IMG_DIR, $img);
                    } else {
                        $result = 1;
                        $fullPath = "";
                    }                    
                    $prezzo = $_POST["Prezzo"];
                    $sconto = !empty($_POST["Sconto"]) && $_POST["Sconto"] > 0 ? ($_POST["Sconto"] <= 100 ? $_POST["Sconto"] : 100) : 0;
                    $maxQta = $_POST["MaxQta"];
                    $codCategoria = $_POST["CodCategoria"];
                    $inVendita = isset($_POST["InVendita"]) ? 1 : 0;
                    $emailCompany = $_SESSION["EmailCompany"];
                    
                    if ($result != 0) {
                        
                        $res = $dbh->updateProductInfo($cod, $desc, str_replace(UPLOAD_DIR, "", $fullPath), $prezzo, $sconto, $maxQta, $emailCompany, $inVendita);

                        if ($res) {
                            if(!empty($fullPath)){
                                removeImg(UPLOAD_DIR . $product["ImgPath"]);
                            }
                            if($product["Sconto"] !== $sconto){
                                $val = $dbh->sendUserProductNotification($_POST["CodProdotto"], $_SESSION["EmailCompany"], "discount");
                            }
                            header("location:prodotto.php?id=".$_POST["CodProdotto"]);
                            return;
                        }
                        removeImg($fullPath);
                    } else {
                        $msg = $resmsg;
                    }
                }
                break;
            case "rifornimento" :
                if (isset($_GET["CodProdotto"])){
                    $cod = $_GET["CodProdotto"];

                    $qta = $dbh->getProductById($cod, null, $_SESSION["EmailCompany"])[0]["QtaInMagazzino"];
                    $dbh->refillProduct($cod, $_SESSION["EmailCompany"]);

                    if($qta <= 0){
                        $dbh->sendUserProductNotification($cod, $_SESSION["EmailCompany"], "refill");
                    }

                    $product = $dbh->getProductById($cod, null, $_SESSION["EmailCompany"])[0];
                    echo $product["QtaInMagazzino"];
                    return;
                }

            default:
                break;
        }
        header("location:" . $location . (isset($action) && strlen($action) > 0 ? "?action=" . $action : "") . (isset($msg) && strlen($msg) > 0 ? "&err-msg=" . $msg : ""));
    }
}
?>