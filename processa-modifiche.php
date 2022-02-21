<?php
require_once 'connection.php';

if(isCompanyLoggedIn()){
    header("location:login.php");
    return;
}

if (isset($_GET["action"]) && $_GET["action"]=="ins-new-utente" && !isUserLoggedIn()) {
    $msg;
    //Controllo validità dei valori di input prima di inviarli al database
    if(isset($_POST["NomeCompleto"]) && !is_numeric($_POST["NomeCompleto"]) && isset($_POST["Ind_Via"]) && isset($_POST["Ind_Citta"]) && count($info_citta = explode(" ", $_POST["Ind_Citta"]))>=3 && isset($_POST["Ind_Paese"]) && !is_numeric($_POST["Ind_Paese"]) && isset($_POST["Email"]) && isset($_POST["Password"]) && strlen($_POST["Password"])>=8 && isset($_POST["NomeIntestatarioCarta"]) && !is_numeric($_POST["NomeIntestatarioCarta"]) && isset($_POST["CodCarta"]) && is_numeric($_POST["CodCarta"]) && isset($_POST["DataScadenza"]) && is_numeric(str_replace(" ", "", $_POST["DataScadenza"]))){
        $nome = $_POST["NomeCompleto"];
        if (!empty($_POST["NumeroTelefono"]) && is_numeric(str_replace(array(" ","-"), "", $_POST["NumeroTelefono"]))) {
            $num_telefono = str_replace(array(" ","-"), "", $_POST["NumeroTelefono"]);
        } else {
            $num_telefono = null;
        }
        $ind_via = $_POST["Ind_Via"];
        $ind_citta = $info_citta[0];
        $ind_provincia = $info_citta[1];
        $ind_CAP = $info_citta[2];
        $ind_paese = $_POST["Ind_Paese"];
        $email = $_POST["Email"];
        $password = password_hash($_POST["Password"], PASSWORD_DEFAULT);
        $nome_intestatario = $_POST["NomeIntestatarioCarta"];
        $codCarta = $_POST["CodCarta"];
        $data_scadenza = $_POST["DataScadenza"];
        $mese_scadenza = explode(" ", $data_scadenza)[0];
        $anno_scadenza = explode(" ", $data_scadenza)[1];
        if($mese_scadenza<=12 && $mese_scadenza>0 && $anno_scadenza>0){
            $data_scadenza = "01-" . $mese_scadenza . "-" . $anno_scadenza;
            $res = $dbh->insertNewUser($nome, $num_telefono, $ind_via, $ind_citta, $ind_provincia, $ind_CAP, $ind_paese, $email, $password, $codCarta, $nome_intestatario, date("Y-m-d", strtotime($data_scadenza)));
            if($res){
                header("location:./login.php");
                return;
            }
            $msg = "email già presente";
        }
    }
    header("location:./login.php?action=registrazione-utente&err-msg=" . (isset($msg) ? $msg : "dati inseriti non validi"));
    return;
}

if (!isUserLoggedIn()) {
    header("location:login.php");
} else {
    $msg = "";
    $location = "login.php";
    $action = "";
    switch ($_GET["action"]) {
        case 'mod-info-spedizione':
            //Controllo validità dei valori di input prima di inviarli al database
            if(isset($_POST["NomeCompleto"]) && !is_numeric($_POST["NomeCompleto"]) && isset($_POST["Ind_Via"]) && count($info_citta = explode(" ", $_POST["Ind_Citta"]))>=3 && isset($_POST["Ind_Paese"]) && !is_numeric($_POST["Ind_Paese"])){
                $nome = $_POST["NomeCompleto"];
                if (!empty($_POST["NumeroTelefono"]) && is_numeric(str_replace(array(" ","-"), "", $_POST["NumeroTelefono"]))) {
                    $num_telefono = str_replace(array(" ","-"), "", $_POST["NumeroTelefono"]);
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
                $res=$dbh->updateUserDeliveryInfo($email, $nome, $num_telefono, $ind_via, $ind_citta, $ind_provincia, $ind_CAP, $ind_paese);
                if ($res) {
                    header("location:login.php");
                    break;
                }
                $location = "login.php";
                $action = "mod-info-spedizine";
                $msg = "dati inseriti non sono validi";
            }
            break;
        case 'mod-info-carta':
            //Controllo validità dei valori di input prima di inviarli al database
            if(isset($_POST["NomeIntestatarioCarta"]) && !is_numeric($_POST["NomeIntestatarioCarta"]) && isset($_POST["CodCarta"]) && is_numeric($_POST["CodCarta"]) && isset($_POST["DataScadenza"]) && is_numeric(str_replace(" ", "", $_POST["dataScadenza"]))){
                $nome = $_POST["NomeIntestatarioCarta"];
                $codCarta = $_POST["CodCarta"];
                $data_scadenza = $_POST["DataScadenza"];
                $mese_scadenza = explode(" ", $data_scadenza)[0];
                $anno_scadenza = explode(" ", $data_scadenza)[1];
                $email = $_SESSION["EmailUser"];
                if($mese_scadenza<=12 && $mese_scadenza>0 && $anno_scadenza>0){
                    $res = $dbh->updateUserCartInfo($email, $codCarta, $nome, date("Y-m-d", strtotime($data_scadenza)));
                    if ($res) {
                        header("location:login.php");
                        break;
                    }
                }
                $location = "login.php";                        
                $action = "mod-info-carta";
                $msg = "dati inseriti non sono validi";
            }
            break;
        
        default:
            break;
    }
}
header("location:" . $location . (isset($action) ? "?action=" . $action : "") . (isset($msg) ? "&err-msg=" . $msg : ""));
