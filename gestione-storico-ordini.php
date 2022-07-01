<?php

require_once 'connection.php';

if(!empty($_GET["act"]) && isUserLoggedIn()){
    switch ($_GET["act"]) {
        case 'get-product':
            $data = "";

            if(isset($_GET["CodOrdine"], $_GET["CodProdotto"], $_GET["CodFornitore"]) && is_numeric($_GET["CodOrdine"]) &&  is_numeric($_GET["CodProdotto"]) && is_numeric($_GET["CodFornitore"])){

                $res = $dbh->getProductAndStatesInOrderByID($_GET["CodProdotto"], $_GET["CodFornitore"], $_GET["CodOrdine"]);

                if(!empty($res) && !empty($res["prodotto"])){
                    $data = '
                    <div class="d-flex justify-content-between gap-5">
                        <div class="col-6">
                            <p class="m-0">' . $res["prodotto"][0]["Fornitore"] . '</p>
                            <h1 class="m-0">' . $res["prodotto"][0]["NomeProdotto"] . '</h1>
                            <p class="fw-lighter m-0">' . $res["prodotto"][0]["NomeCategoria"] . '</p>
                        </div>
                        <div id="immagine-ordine" class="bg-white col-12 col-md-4 col-lg-4 d-flex align-items-center justify-content-center p-3">
                            <img class="card-image-center w-100 h-100" src="'.UPLOAD_DIR . $res["prodotto"][0]["ImgPath"] .'" alt="" />
                        </div>
                    </div>
                    <ul class="col-12 d-flex flex-column gap-4">';
                    
                    foreach($res["stati"] as $stato){
                        $data .= '
                        <li>
                            <span>
                            Data: ' . $stato["Data"] . '
                            </span>
                            <span class="ms-4">' . $stato["NomeStato"] . '</span>
                        </li>';
                    }
                    $data .= '</ul>';
                }
            }
            echo json_encode($data);
            return;
        
        case 'get-order-details':
            $data = [];

            if(isset($_GET["CodOrdine"]) && is_numeric($_GET["CodOrdine"])){
            
                $res = $dbh->getOrderDetails($_GET["CodOrdine"]);
                if(!empty($res) && !empty($res["lista-prodotti"]) && !empty($res["dettagli-ordine"])){
                    $res["num-articoli"] = count($res["lista-prodotti"]);
            
                    $res["dettagli-ordine"]["ImportoTotale"] = $res["dettagli-ordine"]["ImportoFinale"] + $res["dettagli-ordine"]["ScontoTotale"];
                    
                    $data["dettagli-ordine"] = 
                        '<section class="white-container">
                            <div class="m-0 d-flex fw-light">
                                Data dell\'ordine: <span class="ms-auto">' . $res["dettagli-ordine"]["DataOrdine"] . '</span>
                            </div>
                            <div class="m-0 d-flex fw-light">
                                Numero ordine: <span class="ms-auto">' . $_GET["CodOrdine"]. '</span>
                            </div>
                            <div class="m-0 d-flex fw-bold">
                                Totale:<span class="ms-auto">EUR ' . $res["dettagli-ordine"]["ImportoFinale"] . '</span>' . "<span class='fw-normal'> (" . $res["num-articoli"] . ($res["num-articoli"] == 1 ? " arcicolo" : " articoli") . ")" . '</span>
                            </div>
                        </section>
            
                        <section>
                            <h3>Indirizzo di spedizione</h3>
                            <div class="white-container">
                                <p class="mb-0">
                                    ' . $res["dettagli-ordine"]["NomeCompletoIntestatario"] . '<br />
                                    ' . $res["dettagli-ordine"]["IndirizzoConsegna"] . '<br />
                                </p>
                            </div>
                        </section>
            
                        <section>
                            <h3>Informazioni di pagamento</h3>
                            <div class="white-container">
                            <p class="mb-0">
                                ****' . substr($res["dettagli-ordine"]["CodCarta"], -4) . '<br />
                                ' . $res["dettagli-ordine"]["NomeCompletoIntestatario"] . '<br />
                                Data Scadenza: ' . $res["dettagli-ordine"]["MeseScadenza"] . ' / ' . $res["dettagli-ordine"]["AnnoScadenza"] . '
                            </p>
                            </div>
                        </section>
            
                        <section class="white-container">
                            <div class="m-0 d-flex fw-light">
                                Articoli: <span class="ms-auto">' . $res["dettagli-ordine"]["ImportoTotale"] . ' €</span>
                            </div>
                            <div class="m-0 d-flex fw-light">
                                Sconto applicato: <span class="ms-auto">' . $res["dettagli-ordine"]["ScontoTotale"] . ' €</span>
                            </div>
                            <div class="m-0 d-flex fw-bold">
                                Totale: <span class="ms-auto">' . $res["dettagli-ordine"]["ImportoFinale"] . ' €</span>
                            </div>
                        </section>';
                    
                    $data["lista-prodotti"] = "";
                    foreach ($res["lista-prodotti"] as $prodotto){
                        $data["lista-prodotti"] .= 
                            '<li class="col-12 list-group-item">
                                <div class="card col-12 p-2">
                                    <div class="row g-0 p-0 m-0 justify-content-between justify-content-xl-start gap-xl-4 justify-content-xxs-start">
                                        <div class="col-4 align-self-center d-xxs-none">
                                            <img src="' . UPLOAD_DIR . $prodotto["ImgPath"] . '" alt="" />
                                        </div>
                                        <div class="col-7 col-lg-6 p-0 m-0 flex-grow-xxs-1 flex-grow-xl-1">
                                            <div class="card-body d-flex flex-wrap">
                                                <p class="card-text col-12 mb-4"><span class="visually-hidden">nome prodotto</span>' . $prodotto["NomeProdotto"] . '</p>
                                                <p class="card-text m-0 mt-2 col-12 fw-bold">
                                                    <span class="visually-hidden">prezzo</span>
                                                    ' . round($prodotto["PrezzoVendita"], 2) . '€
                                                </p>
                                                <p class="card-text m-0 mt-3 col-12">Quantità: ' . $prodotto["Qta"] . '</p>
                                                <input type="hidden" value="' . $prodotto["CodProdotto"] . '" name="CodProdotto">
                                                <input type="hidden" value="' . $prodotto["CodFornitore"] . '" name="CodFornitore">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>';
                    }
                }

            }
            echo json_encode($data);
            return;

        case 'get-new-orders-preview':
            if(isset($_GET["time"]) && is_numeric($_GET["time"])){
                $res = $dbh->getPreviewUserOrders($_SESSION["EmailUser"], $_GET["time"]/1000);
                foreach($res as $ordine){
                    echo '
                        <li class="list-group-item d-flex align-items-start flex-wrap justify-content-between">
                            <div class="card border-0 col-12 text-decoration-none text-body p-2">
                                <div class="row g-0 p-0 m-0 gap-3 gap-lg-5">
                                    <div class="col-12 p-0 m-0">
                                        <div class="card-body justify-content-between h-100 p-0">
                                            <h5 class="card-title">ordine n° ' . $ordine["CodOrdine"] . '</h5>
                                            <p class="card-text fw-lighter me-3"><small>' .$ordine["DataOrdine"] . '</small></p>
                                            <input type="hidden" value="' . $ordine["CodOrdine"] . '" name="CodOrdine">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>';
                }
            }
            return;
        
        default:
            break;
    }
}

?>