<?php

require_once 'connection.php';

$filtri = array();

$categoryColor = isset($_POST["categoryID"]) ? $dbh->getCategoryById(urldecode($_POST["categoryID"]))[0]["ColoreCategoria"] : "0000";
$categoryID = isset($_POST["categoryID"]) ? urldecode($_POST["categoryID"]) : -1;

$result = $dbh->getProductByCategory($categoryID);

if(count($result)>0){
    foreach ($result as $value) {
        echo
            '<li class="col-12 list-group-item">
                <a href="prodotto.php?id=' . $value["CodProdotto"] . '&idFornitore=' . $value["CodFornitore"] .'" class="card col-12 text-decoration-none text-body p-2" style="border: 2px solid #' . $categoryColor . '";">
                    <div class="row g-0 p-0 m-0 justify-content-between justify-content-xl-start gap-xl-4 justify-content-xxs-start">
                        <div class="col-4 align-self-center d-xxs-none">
                            <img src="' . UPLOAD_DIR . $value["ImgPath"] . '" alt="" />
                        </div>
                        <div class="col-7 col-lg-6 p-0 m-0 flex-grow-xxs-1 flex-grow-xl-1">
                            <div class="card-body d-flex flex-wrap">
                                <p class="card-text col-12 mb-4"><span class="visually-hidden">nome prodotto </span>' . $value["NomeProdotto"] . '</p>' .
                                (round($value["PrezzoUnitario"],2) != round($value["Prezzo"],2) ?
                                    '<p class="card-text m-0 mt-2 col-12 fw-bold">
                                        <span class="fw-lighter me-3 text-decoration-line-through " aria-hidden="true">
                                            ' . round($value["PrezzoUnitario"], 2) . '€
                                        </span>
                                        <span class="visually-hidden">prezzo scontato</span>' . round($value["Prezzo"], 2) . '€
                                    </p>'
                                : '<p class="card-text m-0 mt-2 col-12 fw-bold"><span class="visually-hidden">prezzo</span>' . round($value["PrezzoUnitario"], 2) . '€') . 
                                ($value["QtaInMagazzino"]==0 ?
                                    '<div class="w-auto mt-3">
                                        <span class="visually-hidden">prodotto esaurito</span><img src="' . ICON_DIR . "warning-icon.svg" . '" alt=""/>
                                    </div>' : '') . '
                            </div>
                        </div>
                    </div>
                </a>
            </li>';
    }
} else {
    echo 
    '<li class="col-12 list-group-item">
        <div class="visually-hidden">nessun prodotto trovato</div>
        <img class="bg-white h-100 w-100" id="error_img" src="' . PROD_IMG_DIR . 'no-product.png" alt="" />
    </li>';
}

?>