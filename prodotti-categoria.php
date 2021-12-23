<?php 

require_once 'connection.php';

$templateParams["home"] = "categoria.php";
// $idcategoria = -1;
// if(isset($_GET["id"])){
//     $idcategoria = $_GET["id"];
// }
// TODO: presa degli elementi dal database
// TODO: spostare il controllo degli elementi prima di visualizzarli in template
// $nomecategoria=$dbh->getCategoryByID($idcategoria);
// if(count($nomecategoria)>0){
//     $templateParams["titolo_pagina"] = "Prodotti della categoria".$nomecategoria["0"]["nomecategoria"];
//     $templateParams["prodotti"] = $dbh->getProductByCategory($idcategoria);
// }
// else{
    $templateParams["titolo_pagina"] = "Categoria assente";
    $templateParams["prodotti"] = array();
// }

require 'template/baseUser.php';

?>