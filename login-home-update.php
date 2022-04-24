<?php 

require_once 'connection.php';

if (isset($_POST["action"])) {
    $result;
    switch ($_POST["action"]) {
        case 'get-info':
            if (isUserLoggedIn()) {
                $res = $dbh->getUserInfo($_SESSION["EmailUser"])[0];

                $info_addr = $res["NomeCompleto"] . '<br/> '. $res["IndirizzoSpedizione"] . '<br/> ' . (!empty($res["NumeroTelefono"]) ? 'Numero di telefono: '. $res["NumeroTelefono"] : '');

                $info_carta = '****' . substr($res["CodCarta"], -4) . '<br/> ' . $res["NomeCompletoIntestatario"] . '<br/> Data Scadenza: ' . $res["MeseScadenza"] . '-' . $res["AnnoScadenza"];

                $notifiche = [];
                $res = $dbh->getUserNotification($_SESSION["EmailUser"]);
                foreach ($res as $value) {
                    array_push($notifiche,
                        '<li class="list-group-item"> 
                            <div class="card col-12">
                                <div class="row">
                                    <div class="col-5">
                                        <!-- <img src="upload/categoryImgs/Bagno.png" alt="" /> -->
                                    </div>
                                    <div class="col-7 card-body">
                                        <h5 class="card-title m-0">' . $value["TitoloNotifica"] . '</h5>
                                        <p class="card-text m-0">' . $value["Data"] . '</p>
                                    </div>
                                </div>
                            </div>
                        </li>'
                    );
                }
                $result = array("info_addr" => $info_addr, "info_carta" => $info_carta, "notifiche" => implode(" ", $notifiche));
                
            } elseif (isCompanyLoggedIn()) {
                $res = $dbh->getCompanyInfo($_SESSION["EmailCompany"])[0];

                $info_azienda = 'P.IVA: ' . $res["CodVenditore"] . '<br/>' . $res["NomeCompagnia"] . '<br/> ' . $res["Ind_Via"] . '<br/> ' . $res["Ind_Citta"] . '<br/> ' . $res["Ind_Paese"] .'<br/> Numero di telefono: ' . $res["NumeroTelefono"] . '<br/>' . $res["Email"];

                $notifiche = [];
                $res = $dbh->getCompanyNotification($_SESSION["EmailCompany"]);
                foreach ($res as $value) {
                    array_push($notifiche,
                        '<li class="list-group-item"> 
                            <div class="card col-12">
                                <div class="row">
                                    <div class="col-5">' .
                                        (isset($value["ImgNotifica"]) ? '<img src="' . UPLOAD_DIR . $value["ImgNotifica"] . '" alt="" />' : '') .
                                    '</div>
                                    <div class="col-7 card-body">
                                        <h5 class="card-title m-0">' . $value["TitoloNotifica"] . '</h5>
                                        <p class="card-text m-0">' . $value["Data"] . '</p>
                                    </div>
                                </div>
                            </div>
                        </li>'
                    );
                }
                $result = array("info_addr" => $info_azienda, "notifiche" => implode(" ", $notifiche));
            }
            break;

        case 'get-count-notifiche':
            if (isUserLoggedIn()) {
                $res = $dbh->getUserNotificationCount($_SESSION["EmailUser"])[0];
                $result = array("title" => "User", "numero_notifiche" => $res["NumeroNotifiche"]);
            } elseif (isCompanyLoggedIn()) {
                $res = $dbh->getCompanyNotificationCount($_SESSION["EmailCompany"])[0];
                $result = array("title" => "Company", "numero_notifiche" => $res["NumeroNotifiche"]);
            }
            break;

        default:
            break;
    }
    echo (isset($result) ? json_encode($result) : json_encode([]));
}


?>