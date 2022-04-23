<?php

require_once 'connection.php';

if(isCompanyLoggedIn()){
    header("location:login.php");
    return;
}

if (isset($_GET["action"]) && $_GET["action"]=="ins-new-utente" && !isUserLoggedIn()) {
    $msg;
    //Controllo validità dei valori di input prima di inviarli al database
    if(isset($_POST["NomeCompleto"]) && isset($_POST["Ind_Via"]) && isset($_POST["Email"]) && isset($_POST["Password"]) && strlen($_POST["Password"])>=8 && isset($_POST["NomeIntestatarioCarta"]) && !is_numeric($_POST["NomeIntestatarioCarta"]) && isset($_POST["CodCarta"]) && is_numeric($_POST["CodCarta"]) && isset($_POST["DataScadenza"]) && is_numeric(str_replace(" ", "", $_POST["DataScadenza"]))){
        $nome = $_POST["NomeCompleto"];
        if (!empty($_POST["NumeroTelefono"]) && is_numeric(str_replace(array(" ","-"), "", $_POST["NumeroTelefono"]))) {
            $num_telefono = str_replace(array(" ","-"), "", $_POST["NumeroTelefono"]);
        } else {
            $num_telefono = null;
        }
        $ind_via = $_POST["Ind_Via"];
        $email = $_POST["Email"];
        $password = password_hash($_POST["Password"], PASSWORD_DEFAULT);
        $nome_intestatario = $_POST["NomeIntestatarioCarta"];
        $codCarta = $_POST["CodCarta"];
        $data_scadenza = $_POST["DataScadenza"];
        $mese_scadenza = explode(" ", $data_scadenza)[0];
        $anno_scadenza = explode(" ", $data_scadenza)[1];
        if($mese_scadenza<=12 && $mese_scadenza>0 && $anno_scadenza>0){
            $data_scadenza = "01-" . $mese_scadenza . "-" . $anno_scadenza;
            $res = $dbh->insertNewUser($nome, $num_telefono, $ind_via, $email, $password, $codCarta, $nome_intestatario, date("Y-m-d", strtotime($data_scadenza)));
            if($res){
                header("location:./login.php");
                return;
            }
            $msg = "indirizzo email già presente";
        } else{
            $msg = "mese o anno non valido";
        }
    }
    header("location:./login.php?action=registrazione-utente&err-msg=" . (isset($msg) ? $msg : "dati inseriti non validi"));
    return;
}

if (!isUserLoggedIn()) {
    header("location:login.php");
} else {
    $msg;
    $location = "login.php";
    $action;
    if(isset($_GET["action"])){
        switch ($_GET["action"]) {
            case 'mod-info-spedizione':
                //Controllo validità dei valori di input prima di inviarli al database
                if(isset($_POST["NomeCompleto"]) && isset($_POST["Ind_Via"])){
                    $nome = $_POST["NomeCompleto"];
                    if (!empty($_POST["NumeroTelefono"]) && is_numeric(str_replace(array(" ","-"), "", $_POST["NumeroTelefono"]))) {
                        $num_telefono = str_replace(array(" ","-"), "", $_POST["NumeroTelefono"]);
                    } else {
                        $num_telefono = null;
                    }
                    $ind_via = $_POST["Ind_Via"];
                    $email = $_SESSION["EmailUser"];
                    $res = $dbh->updateUserDeliveryInfo($email, $nome, $num_telefono, $ind_via);
                    if ($res) {
                        header("location:login.php");
                        return;
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
                        $data_scadenza = "01-" . $mese_scadenza . "-" . $anno_scadenza;
                        $res = $dbh->updateUserCardInfo($email, $codCarta, $nome, date("Y-m-d", strtotime($data_scadenza)));
                        if ($res) {
                            header("location:login.php");
                            return;
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
}
