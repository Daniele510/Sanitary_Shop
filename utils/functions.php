<?php

function isActive($pagename)
{
    if (basename($_SERVER['PHP_SELF']) == $pagename) {
        echo " active ";
    }
}

function isUserLoggedIn()
{
    return !empty($_SESSION['Email']);
}

function registerLoggedUser($user)
{
    $_SESSION["Email"] = $user["Email"];
}

function setLoginHome($section)
{
    $_SESSION["login-home"] = $section;
}

function setDefaultLoginHome()
{
    $_SESSION["login-home"] = "login-home.php";
}
