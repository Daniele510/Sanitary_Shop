<?php

require_once 'connection.php';




$msg = "";
$location = "";
$action = "";
if (isset($_POST["action"])) {
    switch ($_POST["action"]) {
        case "Aggiungi al carrello":
            if(isset($_POST["id_prodotto"],$_POST["id_fornitore"],$_POST["quantità"]) && is_numeric($_POST["id_prodotto"]) && is_numeric($_POST["id_fornitore"])) {
                $id_prodotto = $_POST["id_prodotto"];
                $id_fornitore = $_POST["id_fornitore"];
                $qta = !empty($_POST["quantità"]) && is_numeric($_POST["quantità"]) ? $_POST["quantità"] : 1;

                $prodotto = $dbh->getProductById($id_prodotto, $id_fornitore);
                
                if(!empty($prodotto)){
                    if (!isUserLoggedIn()) {
                        return;
                    }
                        $res = $dbh->updateCartUserInfo($email = $_SESSION["EmailUser"], $id_prod = $id_prodotto, $id_forn = $id_fornitore, $quantità = $qta);
                        echo $res;
                        return;
                    }
                }

        case "Acquista ora":
            if (!isUserLoggedIn()) {
               header("location: login.php");
               return;
            }
            if(isset($_POST["id_prodotto"],$_POST["id_fornitore"])) {
                $qta = 1;
                if(isset($_POST["quantità"]) && $_POST["quantità"] > 1){
                    $qta = $_POST["quantità"];
                }
                $res=$dbh->getProductById($_POST["id_prodotto"],$_POST["id_fornitore"]);
                if(empty($res)){
                    header("location: index.php");
                    return;
                }else if($res[0]["QtaInMagazzino"] >= $qta && !empty($res[0]["InVendita"])){
                    $prodotto_ordine = [['CodProdotto' => $_POST["id_prodotto"], 'CodFornitore' => $_POST["id_fornitore"], 'Qta' => $qta, 'Prezzo' => $res[0]["Prezzo"]]];

                    setTmpOrder($prodotto_ordine, 600);
                    setcookie('from', NULL, -1);
                    header("location: acquisto.php");
                    return;
                }else{
                    header("location: prodotto.php?id=".$_POST['id_prodotto']."&idFornitore=".$_POST['id_fornitore']);
                    return;
                }
            }
            header("location: index.php");
            return;

        case "Vai alla cassa":
            if (!isUserLoggedIn()) {
                echo "Utente non loggato";
                return;
            }

            $templateParams["prodotti_carrello"] = $dbh->getProductsFromUserCart($_SESSION["EmailUser"]);
            $prodotti_ordine = [];
            foreach ($templateParams["prodotti_carrello"]  as $value) {
                if(!empty($res=$dbh->getProductById($value["CodProdotto"],$value["CodFornitore"])) && $res[0]["QtaInMagazzino"] >= $value["Qta"] && !empty($res[0]["InVendita"])){
                    array_push($prodotti_ordine,array('CodProdotto' => $value["CodProdotto"], 'CodFornitore' => $value["CodFornitore"], 'Qta' => $value["Qta"], 'Prezzo' => $value["Prezzo"]));
                }

            }
            if(empty($prodotti_ordine)){
                echo "Prodotti richiesti non esistenti o quantità richiesta maggiore della quantità in magazzino";
                return;
            }
            setTmpOrder($prodotti_ordine, 600);
            setcookie('from', "carrello", time() + 600);
            return;

        case "Annulla acquisto":
            deleteTmpOrder();
            setcookie('from', NULL, -1);
            return;
        
        case "Aggiorna quantità":
            if(isset($_POST["id_prodotto"],$_POST["id_fornitore"]) && isUserLoggedIn()) {
                $qta = 1;
                if(isset($_POST["quantità"]) && $_POST["quantità"] > 1){
                    $qta = $_POST["quantità"];
                }
                $dbh->updateProductQuantity($_SESSION["EmailUser"], $_POST["id_prodotto"], $_POST["id_fornitore"], $qta);
                echo $dbh->getUserCartInfo($_SESSION["EmailUser"])[0]["Totale"];
            }
            return;
        case "Conferma acquisto":
            if (!isUserLoggedIn()) {
                echo "Errore login";
                return;
            }
            if(empty(getTmpOrder())){
                echo "Errore ordine";
                return;
            }

            $importoSenzaSconto = 0;
            $importoConSconto= 0;
            foreach (getTmpOrder() as $value) {
                $res=$dbh->getProductById($value["CodProdotto"],$value["CodFornitore"])[0];
            
                $importoSenzaSconto += $res["PrezzoUnitario"] * $value["Qta"];
                $importoConSconto += $res["Prezzo"] * $value["Qta"];
            }
            $codiceOrdine = $dbh->createOrder(getTmpOrder(), $_SESSION["EmailUser"], $importoSenzaSconto, $importoSenzaSconto - $importoConSconto);
            if(empty($codiceOrdine)){
                echo "Errore ordine";
                return;
            }
            deleteTmpOrder();
            if(isset($_COOKIE["from"]) && $_COOKIE["from"] =="carrello"){
               $dbh-> deleteAllProductsFromCart($_SESSION["EmailUser"]);
               setcookie('from', NULL, -1);
            }
            echo $codiceOrdine;
            return;

        case "Elimina prodotto":
            if (!isUserLoggedIn()) {
                header("location: login.php");
                return;
            }
            if(isset($_POST["id_prodotto"],$_POST["id_fornitore"])) {
                $res=$dbh->deleteProductFromCart($_SESSION["EmailUser"], $_POST["id_prodotto"], $_POST["id_fornitore"]);
                if($res){
                    $prod = $dbh->getProductsFromUserCart($_SESSION["EmailUser"]);
                    $arr=[];
                    for($i=0;$i<count($prod);$i++){
                        $prodotto = $prod[$i];
                        array_push($arr,convertLiToCart($prodotto,$i));
                    }
                    $stats=$dbh->getUserCartInfo($_SESSION["EmailUser"])[0];
                    $totale = $stats["Totale"];
                    $textButton = "Vai alla cassa (". $stats["NumArticoli"];
                    if($stats["NumArticoli"]==1){
                        $textButton .=" articolo)";
                    }else{
                        $textButton .=" articoli)";
                    }
                    if(empty($arr)){
                        array_push($arr,'<li class="list-unstyled">
                                            <h2 class="text-center">Il tuo carrello è vuoto</h2>
                                        </li>');
                        $totale = 0;
                    }
                    echo json_encode(["lista-prodotti"=>implode(" ",$arr), "totale"=>$totale, "num-articoli"=>$textButton]);
                }
            }else{
                echo json_encode([]);
            }
            return;
    }
}
function convertLiToCart($values,$i){
    return '<li class="col-12 list-group-item bg-transparent d-flex flex-column gap-1">
                <a href="prodotto.php?id=' . $values["CodProdotto"]  .'&idFornitore=' . $values["CodFornitore"]  .'" class="card col-12 text-decoration-none text-body p-2 ">
                    <div class="row g-0 p-0 m-0 justify-content-between justify-content-xl-start gap-xl-4 justify-content-xxs-start">
                        <div class="col-5">
                            <img src="' . UPLOAD_DIR . $values["ImgPath"]  .'" class="img-fluid rounded-start" alt=""/>
                        </div>
                        <div class="col-7 col-lg-6">
                            <div class="card-body overflow-hidden d-flex flex-column h-100">
                                <h5 class="card-title m-0">' . $values["NomeProdotto"]  .'</h5>
                                <div class="my-auto row d-flex align-items-center justify-content-between">
                                    <p class="card-text col-8 m-0">' . round($values["Prezzo"],2)  .'</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                <div class="d-flex align-items-center flex-wrap">
                    <div class="col-5 d-flex gap-1 align-items-center flex-wrap">
                        <label class="fw-bold col-form-label form-label me-3" for="' . "qta-".$i.'">Quantità</label>
                        <input class="card-text col-9 m-0 form-control w-50" name="Qta" id="' . "qta-".$i.'" type="number" min="0" max="' . $values["MaxQtaMagazzino"].'" value="' . $values["Qta"]  .'">
                    </div>
                    <input type="hidden" name="id_prodotto" value="' . $values['CodProdotto'].'">
                    <input type="hidden" name="id_fornitore" value="' . $values['CodFornitore'].'">
                    <button class="w-auto btn delete"><img src="' . ICON_DIR . "cart-bin.svg"  .'" alt="rimuovi dal carrello" /></button>
                </div>
            </li>';
}



?>