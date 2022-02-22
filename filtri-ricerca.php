<?php

require_once 'connection.php';

$filtri = array();

// conversione dei + in spazi ed inserimento dei valori dei filtri scelti dentro ad un vetotre
if(isset($_POST["NomeProdotto"])){
    $filtri["NomeProdotto"] = str_replace(array("+","%20"), " ", $_POST["NomeProdotto"]);
}
if(isset($_POST["NomeCompagnia"])){
    $filtri["NomeCompagnia"] = [];
    foreach ($_POST["NomeCompagnia"] as $value) {
        array_push($filtri["NomeCompagnia"], str_replace(array("+","%20"), " ", $value));
    }
}
if(isset($_POST["Order"])){
    $filtri["Ordine"] = str_replace(array("+","%20"), " ", $_POST["Order"]);
}

$result = $dbh->getProductByFilters($filtri);
if(count($result)>0){
    foreach ($result as $value) {
        echo 
            '<div class="card col-10">
                <div class="row g-0 p-0 m-0 align-items-center">
                    <div class="col-4">
                        <img src="' . UPLOAD_DIR . $value["ImgPath"] . '" class="img-fluid" alt="" />
                    </div>
                    <div class="col-8 p-0 m-0">
                        <div class="card-body">
                            <h5 class="card-title">' . $value["NomeProdotto"] . '</h5>
                            <p class="card-text m-0">' . round($value["Prezzo"], 2) . '</p>
                        </div>
                    </div>
                </div>
            </div>';
    }
}

?>