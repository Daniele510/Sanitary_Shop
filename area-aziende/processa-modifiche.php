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
} elseif (!isCompanyLoggedIn()) {
    header("location: ../login.php?action=login-azienda");
} elseif (isset($_POST["submit-mod-info-azienda"])) {
    $nome = $_POST["NomeCompagnia"];
    $num_telefono = $_POST["NumeroTelefono"];
    $ind_via = $_POST["Ind_Via"];
    $info_citta = explode(" ", $_POST["Ind_Citta"]);
    $ind_citta = $info_citta[0];
    $ind_provincia = $info_citta[1];
    $ind_CAP = $info_citta[2];
    $ind_paese = $_POST["Ind_Paese"];
    $email = $_SESSION["EmailCompany"];
    $dbh->updateCompanyInfo($email, $nome, $num_telefono, $ind_via, $ind_citta, $ind_provincia, $ind_CAP, $ind_paese);
}
header("location:login.php");
