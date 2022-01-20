<?php
require_once '../connection.php';

if (isset($_POST["submit-ins-new-azienda"])) {
    $nome = $_POST["NomeCompagnia"];
    $partitaIVA = $_POST["PartitaIVA"];
    $num_telefono = $_POST["NumeroTelefono"];
    $ind_via = $_POST["Ind_Via"];
    $info_citta = explode(" ", $_POST["Ind_Citta"]);
    $ind_citta = $info_citta[0];
    $ind_provincia = $info_citta[1];
    $ind_CAP = $info_citta[2];
    $ind_paese = $_POST["Ind_Paese"];
    $email = $_POST["Email"];
    $password = password_hash($_POST["Password"], PASSWORD_DEFAULT);
    $dbh->insertNewCompany($nome, $partitaIVA, $num_telefono, $ind_via, $ind_citta, $ind_provincia, $ind_CAP, $ind_paese, $email, $password);
    header("location:login.php");
    return;
}

if (!isCompanyLoggedIn()) {
    header("location: ../login.php?action=login-azienda");
    return;
}

if (isset($_POST["NomeCompagnia"]) && !empty($_POST["NumeroTelefono"]) && isset($_POST["Ind_Via"]) && isset($_POST["Ind_Citta"]) && !empty($_POST["Ind_Paese"])) {
    $nome = $_POST["NomeCompagnia"];
    $num_telefono = $_POST["NumeroTelefono"];
    $ind_via = $_POST["Ind_Via"];
    $info_citta = explode(" ", $_POST["Ind_Citta"]);
    if (count($info_citta) >= 3) {
        $ind_citta = $info_citta[0];
        $ind_provincia = $info_citta[1];
        $ind_CAP = $info_citta[2];
        $ind_paese = $_POST["Ind_Paese"];
        $email = $_SESSION["EmailCompany"];
        $res = $dbh->updateCompanyInfo($email, $nome, $num_telefono, $ind_via, $ind_citta, $ind_provincia, $ind_CAP, $ind_paese);
        if ($res) {
            header("location:login.php");
            return;
        }
    }
}

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
            return;
        }
        $msg = "codice prodotto già presente";
        removeImg($fullPath);
    } else {
        $msg = $resmsg;
    }
    $location = "login.php";
    $action = "ins-new-prod";
}
header("location:" . (isset($location) ? $location : "login.php") . "?action=" . (isset($action) ? $action : "") . "&err-msg=" . (isset($msg) ? $msg : "dati inseriti non validi"));
