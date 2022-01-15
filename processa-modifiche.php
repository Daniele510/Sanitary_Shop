<?php
require_once 'connection.php';

if (isset($_POST["submit-ins-new-utente"])) {
    $nome = $_POST["NomeCompleto"];
    if (!empty($_POST["NumeroTelefono"])) {
        $num_telefono = $_POST["NumeroTelefono"];
    } else {
        $num_telefono = null;
    }
    $ind_via = $_POST["Ind_Via"];
    $info_citta = explode(" ", $_POST["Ind_Citta"]);
    $ind_citta = $info_citta[0];
    $ind_provincia = $info_citta[1];
    $ind_CAP = $info_citta[2];
    $ind_paese = $_POST["Ind_Paese"];
    $email = $_POST["Email"];
    $password = password_hash($_POST["Password"], PASSWORD_DEFAULT);
    $nome_intestatario = $_POST["NomeIntestatarioCarta"];
    $codCarta = $_POST["CodCarta"];
    $data_scadenza = $_POST["DataScadenza"];
    $dbh->insertNewUser($nome, $num_telefono, $ind_via, $ind_citta, $ind_provincia, $ind_CAP, $ind_paese, $email, $password, $codCarta, $nome_intestatario, $data_scadenza);
} elseif (!isUserLoggedIn()) {
    header("location:login.php");
} elseif (isset($_POST["submit-mod-info-spedizione"])) {
    $nome = $_POST["NomeCompleto"];
    if (!empty($_POST["NumeroTelefono"])) {
        $num_telefono = $_POST["NumeroTelefono"];
    } else {
        $num_telefono = null;
    }
    $ind_via = $_POST["Ind_Via"];
    $info_citta = explode(" ", $_POST["Ind_Citta"]);
    $ind_citta = $info_citta[0];
    $ind_provincia = $info_citta[1];
    $ind_CAP = $info_citta[2];
    $ind_paese = $_POST["Ind_Paese"];
    $email = $_SESSION["EmailUser"];
    $dbh->updateUserDeliveryInfo($email, $nome, $num_telefono, $ind_via, $ind_citta, $ind_provincia, $ind_CAP, $ind_paese);
} elseif (isset($_POST["submit-mod-info-carta"])) {
    $nome = $_POST["NomeIntestatarioCarta"];
    $codCarta = $_POST["CodCarta"];
    $data_scadenza = $_POST["DataScadenza"];
    $email = $_SESSION["EmailUser"];
    $dbh->updateUserCartInfo($email, $codCarta, $nome, $data_scadenza);
}
header("location:login.php");
