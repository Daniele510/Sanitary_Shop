<?php

require_once 'connection.php';

if (!empty($_GET["act"])) {
  switch ($_GET["act"]) {
    case 'get-notification':
      $data = "";
      if (isset($_GET["CodNotifica"])) {
        if (isUserLoggedIn()) {
          if (!empty($res = $dbh->getUserNotificationByID($_GET["CodNotifica"], $_SESSION["EmailUser"]))) {
            $data = '<h2>' . $res[0]["TitoloNotifica"] . '</h2>
                    <p class="mb-5"><small>' . $res[0]["Data"] . '</small></p>
                    <p>' . $res[0]["DescrizioneNotifica"] . '</p>
                    <p class="mt-4 mb-0">Per maggiori informazioni sul prodotto <a href="prodotto.php?id=' . $res[0]["CodProdotto"] . '&idFornitore=' . $res[0]["CodFornitore"] . '" class="text-primary text-decoration-none">clicca qui</a></p>';
          }
        } elseif (isCompanyLoggedIn()) {
          if (!empty($res = $dbh->getCompanyNotificationByID($_GET["CodNotifica"], $_SESSION["EmailCompany"]))) {
            $data = '<h2>' . $res[0]["TitoloNotifica"] . '</h2>
                    <p class="mb-5"><small>' . $res[0]["Data"] . '</small></p>
                    <p>' . $res[0]["DescrizioneNotifica"] . '</p>
                    <p class="mt-4 mb-0">Per maggiori informazioni sul prodotto <a class="text-primary text-decoration-none" href="prodotto.php?id=' . $res[0]["CodProdotto"] . '" class="text-reset text-decoration-none">clicca qui</a></p>';
          }
        }
      }
      echo $data;
      return;

    case 'get-new-notifications-preview':
      if (isset($_GET["time"]) && is_numeric($_GET["time"])) {
        if (isUserLoggedIn()) {
          $res = $dbh->getPreviewUserNotification($_SESSION["EmailUser"], null, $_GET["time"] / 1000);
        } elseif (isCompanyLoggedIn()) {
          $res = $dbh->getPreviewCompanyNotification($_SESSION["EmailCompany"], null, $_GET["time"] / 1000);
        }
        foreach ($res as $notifica) {
          echo '
                <li class="list-group-item d-flex align-items-start flex-wrap justify-content-between ">
                  <div class="card border-0 col-12 text-decoration-none text-body p-2">
                    <div class="row g-0 p-0 m-0 gap-3 gap-lg-5">
                      <div class="col-2 align-self-center">
                        <img src="' . UPLOAD_DIR . $notifica["ImgPath"] . '" alt="" />
                      </div>
                      <div class="col-7 p-0 m-0">
                        <div class="card-body justify-content-between h-100 p-0">
                          <h5 class="card-title">' . $notifica["TitoloNotifica"] . '</h5>
                          <p class="card-text fw-lighter me-3"><small>' . $notifica["Data"] . '</small></p>
                          <input type="hidden" name="CodNotifica" value="' . $notifica["CodNotifica"] . '">
                        </div>
                      </div>
                    </div>
                  </div>
                </li>';
        }
      }
      return;
  }
}
