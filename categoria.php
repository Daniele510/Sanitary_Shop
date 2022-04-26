<?php

require_once 'connection.php';

$templateParams["home"] = "prod-categoria.php";
$templateParams["header"] = "header.php";
$templateParams["bg_color_white"] = true;

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
        $templateParams["titolo_pagina"] = "Prodotti assenti";
        $templateParams["prodotti"] = array();
    }
} else {
    $templateParams["titolo_pagina"] = "Categoria assente";
    $templateParams["prodotti"] = array();
}

require 'template/base.php';
