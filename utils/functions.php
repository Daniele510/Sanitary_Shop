<?php 

function isActive($pagename){
    if(basename($_SERVER['PHP_SELF'])==$pagename){
        echo " active ";
    }
}

function isUserLoggedIn(){
    return !empty($_SESSION['Email']);
}

function registerLoggedUser($user){
    $_SESSION["Email"] = $user["Email"];
    $_SESSION["NomeCompleto"] = $user["NomeCompleto"];
}

?>