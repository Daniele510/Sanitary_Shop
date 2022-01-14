<?php

function isActive($pagename)
{
    if (basename($_SERVER['PHP_SELF']) == $pagename) {
        echo " active ";
    }
}

function isUserLoggedIn()
{
    return !empty($_SESSION['EmailUser']);
}

function isCompanyLoggedIn()
{
    return !empty($_SESSION['EmailCompany']);
}

function registerLoggedUser($user)
{
    $_SESSION["EmailUser"] = $user["Email"];
}

function registerLoggedCompany($company)
{
    $_SESSION["EmailCompany"] = $company["Email"];
}

function setLoginHome($section)
{
    $_SESSION["login-home"] = $section;
}

function setDefaultLoginHome()
{
    $_SESSION["login-home"] = "login-home.php";
}
