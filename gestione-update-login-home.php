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
                $res = $dbh->getPreviewUserNotification($_SESSION["EmailUser"]);
                foreach ($res as $value) {
                    array_push($notifiche,
                        '<li class="col-12 list-group-item">
                            <a href="storico-notifiche.php?CodNotifica=<' . $value["CodNotifica"] . '" class="card col-12 text-decoration-none text-body p-2">
                                <div class="row g-0 p-0 m-0 gap-3 gap-lg-5">
                                    <div class="w-auto align-self-center">
                                        <img src="' . UPLOAD_DIR . $value["ImgPath"] .'" alt="" />
                                    </div>
                                    <div class="col-7 p-0 m-0">
                                        <div class="card-body justify-content-between h-100">
                                            <p class="card-title fs-5 fw-bold">' . $value["TitoloNotifica"] . '</p>
                                            <p class="card-text fw-lighter me-3">' . $value["Data"] . '</p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>'
                    );
                }
                $result = array("info_addr" => $info_addr, "info_carta" => $info_carta, "notifiche" => implode(" ", $notifiche));
                
            } elseif (isCompanyLoggedIn()) {
                $res = $dbh->getCompanyInfo($_SESSION["EmailCompany"])[0];

                $info_azienda = 'P.IVA: ' . $res["CodVenditore"] . '<br/>' . $res["NomeCompagnia"] . '<br/> ' . $res["Ind_Via"] . '<br/> ' . $res["Ind_Citta"] . '<br/> ' . $res["Ind_Paese"] .'<br/> Numero di telefono: ' . $res["NumeroTelefono"] . '<br/>' . $res["Email"];

                $notifiche = [];
                $res = $dbh->getPreviewCompanyNotification($_SESSION["EmailCompany"]);
                foreach ($res as $value) {
                    array_push($notifiche,
                        '<li class="col-12 list-group-item">
                            <a href="storico-notifiche.php?CodNotifica=<' . $value["CodNotifica"] . '" class="card col-12 text-decoration-none text-body p-2">
                                <div class="row g-0 p-0 m-0 gap-3 gap-lg-5">
                                    <div class="w-auto align-self-center">
                                        <img src="' . UPLOAD_DIR . $value["ImgPath"] .'" alt="" />
                                    </div>
                                    <div class="col-7 p-0 m-0">
                                        <div class="card-body justify-content-between h-100">
                                            <p class="card-title fs-5 fw-bold">' . $value["TitoloNotifica"] . '</p>
                                            <p class="card-text fw-lighter me-3">' . $value["Data"] . '</p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>'
                    );
                }
                $result = array("info_addr" => $info_azienda, "notifiche" => implode(" ", $notifiche));
            }
            break;

        case 'get-count-notifiche':
            if (isUserLoggedIn()) {
                $res = $dbh->getUserNotificationCount($_SESSION["EmailUser"])[0];
                $result = array("title" => "area utente", "numero_notifiche" => $res["NumeroNotifiche"]);
            } elseif (isCompanyLoggedIn()) {
                $res = $dbh->getCompanyNotificationCount($_SESSION["EmailCompany"])[0];
                $result = array("title" => "area azienda", "numero_notifiche" => $res["NumeroNotifiche"]);
            }
            break;

        default:
            break;
    }
    echo (isset($result) ? json_encode($result) : json_encode([]));
}


?>