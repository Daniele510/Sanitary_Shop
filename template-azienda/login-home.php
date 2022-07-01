<section class="row justify-content-center user_home">
  <div class="col-10 d-flex gap-4 p-0 flex-wrap align-items-center justify-content-between col-md-11">
    <div class="col-12 d-flex gap-3 justify-content-evenly flex-wrap justify-content-md-start gap-md-4 my-3" id="stat_container">
      <div class="white-column-container text-center col-3 gap-0">
        <div class="fw-bold"><?php echo empty($templateParams["stat-venditore"]["TotGuadagno"]) ? 0 : $templateParams["stat-venditore"]["TotGuadagno"][0]; ?>&euro;</div>
        <div class="fw-light">Ricavo totale</div>
      </div>
      <div class="white-column-container text-center col-3 gap-0">
        <div class="fw-bold"><?php echo empty($templateParams["stat-venditore"]["TotUnita"]) ? 0 : $templateParams["stat-venditore"]["TotUnita"][0]; ?></div>
        <div class="fw-light">Unità vendute</div>
      </div>
      <div class="white-column-container text-center col-3 gap-0">
        <div class="fw-bold"><?php echo empty($templateParams["stat-venditore"]["TotOrdini"]) ? 0 : $templateParams["stat-venditore"]["TotOrdini"][0]; ?></div>
        <div class="fw-light">Ordini totali</div>
      </div>
    </div>

    <div class="d-flex">
      <h1 class="m-0 p-0">Informazioni venditore</h1>
    </div>

    <div class="d-flex d-md-none">
      <a href="#" class="d-md-none text-decoration-none" id="icona_notifiche">
        <img src="<?php echo (!empty($templateParams["info-azienda"]["Notifiche"]) && count($templateParams["info-azienda"]["Notifiche"]) > 0 ? ICON_DIR . "active-bell.svg" : ICON_DIR . "bell.svg"); ?>" alt="link da cliccare per accedere allo storico delle notifiche">
      </a>
    </div>

    <div class="col-12 d-md-flex justify-content-md-between align-items-stretch">
      <section class="col-12 col-md-5 align-self-start" id="info-addr">
        <div class="white-column-container">
          <h3 class="mb-0">Dati spedizione</h3>
          <p class="mb-0">
            P.IVA: <?php echo $templateParams["info-azienda"]["CodVenditore"]; ?><br/>
            <?php echo $templateParams["info-azienda"]["NomeCompagnia"]; ?><br />
            <?php echo $templateParams["info-azienda"]["Ind_Via"]; ?><br/>
            <?php echo $templateParams["info-azienda"]["Ind_Citta"]; ?><br/>
            <?php echo $templateParams["info-azienda"]["Ind_Paese"]; ?><br/>
            Numero di telefono: <?php echo $templateParams["info-azienda"]["NumeroTelefono"]; ?><br />
            <?php echo $templateParams["info-azienda"]["Email"]; ?>
          </p>
          <a class="col-7 col-sm-5 btn btn-primary d-md-flex justify-content-md-center align-items-md-center flex-md-grow-1" href="login.php?action=mod-info-azienda">
            Modifica
          </a>
        </div>
      </section>
      <section class="d-none d-md-block col-md-6">
        <div class="col-12 white-column-container">
          <div class="col-12">
            <div class="col-12 p-0 d-flex align-items-center justify-content-between">
              <h3 class="p-0 m-0">Notifiche</h3>
              <a href="#"><img src="<?php echo ICON_DIR . "bell.svg"?>" alt="link da cliccare per accedere allo storico delle notifiche"></a>
            </div>
          </div>
          <ul class="list-group gap-3" id="box-notifiche">
            <?php if (isset($templateParams["info-azienda"]["Notifiche"]) && count($templateParams["info-azienda"]["Notifiche"]) > 0) :
              foreach ($templateParams["info-azienda"]["Notifiche"] as $notifica) : ?>
                <li class="list-group-item">
                  <div class="card col-12">
                    <div class="row">
                      <div class="col-5">
                        <img src="<?php echo UPLOAD_DIR . $notifica["ImgPath"]; ?>" alt="" />
                      </div>
                      <div class="col-7 card-body">
                        <p class="card-title m-0 fs-5 fw-bold"><?php echo $notifica["TitoloNotifica"]; ?></p>
                        <p class="card-text m-0"><?php echo $notifica["Data"]; ?></p>
                      </div>
                    </div>
                  </div>
                </li>
              <?php endforeach;
            else : ?>
              <li class="alert alert-info text-center mb-0" role="alert">
                Non hai notifiche
              </li>
            <?php endif; ?>
          </ul>
        </div>
      </section>
    </div>

    <div class="col-12 col-md-3 col-lg-3 ms-md-auto d-flex justify-content-center">
      <a href="login.php?action=logout" class="col-6 col-md-12 btn btn-danger">Logout</a>
    </div>
  </div>
</section>