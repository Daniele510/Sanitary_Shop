<?php
require_once '../connection.php';

// FIXME: inserire i controlli sui tutti i valori di input per ogni tipologia di azione

if (isset($_GET["action"]) && $_GET["action"]=="ins-new-azienda" && !isCompanyLoggedIn()) {
    $msg;
    if(isset($_POST["NomeCompagnia"]) && (!empty($_POST["PartitaIVA"]) && is_numeric($_POST["PartitaIVA"])) && (!empty($_POST["NumeroTelefono"]) && is_numeric($_POST["NumeroTelefono"])) && isset($_POST["Ind_Via"]) && (isset($_POST["Ind_Citta"]) && count($info_citta = explode(" ", $_POST["Ind_Citta"]))>=3) && (isset($_POST["Ind_Paese"]) && !is_numeric($_POST["Ind_Paese"])) && isset($_POST["Email"]) && (isset($_POST["Password"]) && strlen($_POST["Password"])>=8)){
        $nome = $_POST["NomeCompagnia"];
        $partitaIVA = $_POST["PartitaIVA"];
        $num_telefono = $_POST["NumeroTelefono"];
        $ind_via = $_POST["Ind_Via"];
        $ind_citta = $info_citta[0];
        $ind_provincia = $info_citta[1];
        $ind_CAP = $info_citta[2];
        $ind_paese = $_POST["Ind_Paese"];
        $email = $_POST["Email"];
        //hash password
        $password = password_hash($_POST["Password"], PASSWORD_DEFAULT);
        $res = $dbh->insertNewCompany($nome, $partitaIVA, $num_telefono, $ind_via, $ind_citta, $ind_provincia, $ind_CAP, $ind_paese, $email, $password);
        if($res){
            header("location:../login.php?action=login-azienda");
            return;
        }
        $msg = "email o partita iva già presenti";
        return;
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
    switch ($_GET["action"]) {
        case 'mod-info-azienda':
            if (isset($_POST["NomeCompagnia"]) && (!empty($_POST["NumeroTelefono"]) && is_numeric($_POST["NumeroTelefono"])) && isset($_POST["Ind_Via"]) && (isset($_POST["Ind_Citta"]) && count($info_citta = explode(" ", $_POST["Ind_Citta"]))>=3) && (isset($_POST["Ind_Paese"]) && !is_numeric($_POST["Ind_Paese"]))) {
                $nome = $_POST["NomeCompagnia"];
                $partitaIVA = $_POST["PartitaIVA"];
                $num_telefono = $_POST["NumeroTelefono"];
                $ind_via = $_POST["Ind_Via"];
                $ind_citta = $info_citta[0];
                $ind_provincia = $info_citta[1];
                $ind_CAP = $info_citta[2];
                $ind_paese = $_POST["Ind_Paese"];
                $email = $_POST["Email"];
                $password = password_hash($_POST["Password"], PASSWORD_DEFAULT);
                $res =  $dbh->updateCompanyInfo($email, $nome, $num_telefono, $ind_via, $ind_citta, $ind_provincia, $ind_CAP, $ind_paese);
                if ($res) {
                    header("location:login.php");
                    break;
                }
                $location = "login.php";
                $action = "mod-info-azienda";
                $msg = "i dati inseriti non sono validi";
            }
            break;

        case 'ins-new-prod':
            //controllo validità degli attributi
            if (isset($_POST["CodProdotto"]) && !empty($_POST["NomeProdotto"]) && !empty($_POST["Descrizione"]) && !empty($_POST["Prezzo"]) && !empty($_POST["CodCategoria"]) && isset($_FILES["Immagine"]) && !empty($_POST["MaxQta"])) {
                $cod = $_POST["CodProdotto"];
                $nome = $_POST["NomeProdotto"];
                $desc = $_POST["Descrizione"];
                $img = $_FILES["Immagine"];
                list($result, $resmsg, $fullPath) = uploadImage("." . UPLOAD_DIR . "productsImg/", $img);
                $prezzo = $_POST["Prezzo"];
                $sconto = !empty($_POST["Sconto"]) ? $_POST["Sconto"] : 0;
                $maxQta = $_POST["MaxQta"];
                $codCategoria = $_POST["CodCategoria"];
                $inVendita = isset($_POST["InVendita"]) ? 1 : 0;
                $emailCompany = $_SESSION["EmailCompany"];
                if ($result != 0) {
                    $res = $dbh->insertNewProduct($cod, $nome, $desc, "productsImg/" . $img["name"], $prezzo, $sconto, $maxQta, $emailCompany, $codCategoria, $inVendita);
                    if ($res) {
                        header("location:index.php");
                        break;
                    }
                    $msg = "codice prodotto già presente";
                    removeImg($fullPath);
                } else {
                    $msg = $resmsg;
                }
                $location = "login.php";
                $action = "ins-new-prod";
                $msg = "i dati inseriti non sono validi";
            }
            break;

        default:
            break;
    }
    header("location:" . $location . (isset($action) ? "?action=" . $action : "") . (isset($msg) ? "&err-msg=" . $msg : ""));
}
