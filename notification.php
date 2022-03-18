<?php 

require_once 'connection.php';

if (isset($_POST["action"])) {
    switch ($_POST["action"]) {
        case 'get-info':
            if (isUserLoggedIn()) {
                $res = $dbh->getUserInfo($_SESSION["EmailUser"])[0];

                $info_addr = $res["NomeCompleto"] . '<br/> '. $res["IndirizzoSpedizione"] . '<br/> '.(!empty($res["NumeroTelefono"]) ? 'Numero di telefono: '. $res["NumeroTelefono"] : '');

                $info_carta = '****' . substr($res["CodCarta"], -4) . '<br/> ' . $res["NomeCompletoIntestatario"] . '<br/> Data Scadenza: ' . $res["MeseScadenza"] . '-' . $res["AnnoScadenza"];

                $notifiche = [];
                foreach ($res["Notifiche"] as $value) {
                array_push($notifiche,
                    '<li> 
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
                    </li>');
                }
                echo json_encode(array("info_addr" => $info_addr, "info_carta" => $info_carta, "notifiche" => implode(" ", $notifiche)));
            } elseif (isCompanyLoggedIn()) {
                $res = $dbh->$dbh->getCompanyNotification($_SESSION["EmailCompany"]);
            }
            
            break;
        case 'get-count-notifiche':
            if (isUserLoggedIn()) {
                $res = $dbh->getUserNotificationCount($_SESSION["EmailUser"])[0];
            } elseif (isCompanyLoggedIn()) {
                $res = $dbh->$dbh->getCompanyNotificationCount($_SESSION["EmailCompany"])[0];
            }
            echo $res["NumeroNotifiche"];
            break;
        default:
            break;
    }
}


?>