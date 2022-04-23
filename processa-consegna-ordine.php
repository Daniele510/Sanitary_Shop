<?php 

require_once 'connection.php';

static $MAX_TIME_SLEEP = 120;
static $MIN_TIME_SLEEP = 20;

if (isset($_POST["orderID"])) {
    for ($i=0; $i < count($states = $dbh->getOrderStates()); $i++) { 
        sleep(rand($MIN_TIME_SLEEP, $MAX_TIME_SLEEP));
        // aggiorno lo stato dell'ordine e mando una notifica all'utente
        $res = $dbh->updateOrderStateAndSendNotificationToUser($_POST["orderID"], $states[$i]);
    }
}

?>