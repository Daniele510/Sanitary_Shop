<?php

require_once 'connection.php';

if(isCompanyLoggedIn()){
    header("location:area-aziende/index.php");
}

$templateParams["home"] = "prod-categoria.php";
$templateParams["titolo"] = "header.php";
$templateParams["bg_color"] = "white";

$idcategoria = -1;
if (isset($_GET["id"])) {
    $idcategoria = $_GET["id"];
}

$nomecategoria = $dbh->getCategoryByID($idcategoria);
if (count($nomecategoria) > 0) {
    $prodotti_categoria = $dbh->getProductByCategory($idcategoria);
    $templateParams["ColoreCategoria"] = $nomecategoria[0]["ColoreCategoria"];
    if (count($prodotti_categoria) > 0) {
        $templateParams["titolo_pagina"] = $nomecategoria[0]["NomeCategoria"];
        $templateParams["prodotti"] = $prodotti_categoria;
    } else {
        $templateParams["titolo_pagina"] = "Categoria assente";
        $templateParams["prodotti"] = array();
    }
} else {
    $templateParams["titolo_pagina"] = "Categoria assente";
    $templateParams["prodotti"] = array();
}

require 'template/base.php';
