<section class="row justify-content-center user_home">
  <div class="col-9 d-flex flex-column gap-4 p-0 col-md-10 flex-md-row flex-md-wrap align-items-md-center justify-content-md-between">
    <div class="d-flex justify-content-between gap-1 col-md-5 justify-content-md-end">
      <div class="col-5 col-md-6">
        <a href="#" class="col-12 btn btn-outline-primary">ORDINI</a>
      </div>
      <div class="d-flex d-md-none">
        <a href="#" class="d-md-none text-decoration-none" id="icona_notifiche">
          <img src="<?php echo (!empty($templateParams["info-azienda"]["Notifiche"]) && count($templateParams["info-azienda"]["Notifiche"]) > 0 ? ICON_DIR . "active-bell.svg" : ICON_DIR . "bell.svg"); ?>" alt="link da cliccare per accedere allo storico delle notifiche">
        </a>
      </div>
    </div>

    <div class="d-flex">
      <h1 class="m-0 p-0">Informazioni personali</h1>
    </div>

    <div class="col-12 d-md-flex justify-content-md-between align-items-stretch">
      <div class="col-12 col-md-5 d-flex align-self-start">
        <div class="col-12 vstack gap-4">
          <section class="col-12" id="info-addr">
            <div class="col-12 white-column-container">
              <h3 class="mb-0">Dati spedizione</h3>
              <p class="mb-0">
                <?php echo $templateParams["info-utente"]["NomeCompleto"]; ?><br />
                <?php echo $templateParams["info-utente"]["IndirizzoSpedizione"]; ?><br />
                <?php if (!empty($templateParams["info-utente"]["NumeroTelefono"])) : ?>
                  Numero di telefono: <?php echo $templateParams["info-utente"]["NumeroTelefono"]; ?>
                <?php endif; ?>
              </p>
              <a class="col-7 col-sm-5 btn btn-primary d-md-flex justify-content-md-center align-items-md-center flex-md-grow-1" href="login.php?action=mod-info-spedizione">
                Modifica
              </a>
            </div>
          </section>
          <section class="col-12" id="info-carta">
            <div class="col-12 white-column-container">
              <h3 class="mb-0">Modalità di pagamento</h3>
              <p class="mb-0">
                ****<?php echo substr($templateParams["info-utente"]["CodCarta"], -4); ?><br />
                <?php echo $templateParams["info-utente"]["NomeCompletoIntestatario"]; ?><br />
                Data Scadenza: <?php echo $templateParams["info-utente"]["MeseScadenza"]; ?>-<?php echo $templateParams["info-utente"]["AnnoScadenza"]; ?>
              </p>
              <a class="col-7 col-sm-5 btn btn-primary d-md-flex justify-content-md-center align-items-md-center flex-md-grow-1" href="login.php?action=mod-info-carta">
                Modifica
              </a>
            </div>
          </section>
        </div>
      </div>
      <section class="d-none d-md-block col-md-6">
        <div class="col-12 white-column-container pb-0">
          <div class="col-12">
            <div class="col-12 p-0 d-flex align-items-center justify-content-between">
              <h3 class="p-0 m-0">Notifiche</h3>
              <a href="#"><img src="<?php echo ICON_DIR . "bell.svg" ?>" alt="cliccare per accedere allo storico delle notifiche"></a>
            </div>
          </div>
          <ul class="list-group gap-3" id="box-notifiche">
            <?php if (count($templateParams["info-utente"]["Notifiche"]) > 0) :
              foreach ($templateParams["info-utente"]["Notifiche"] as $notifica) : ?>
                <li class="col-12 list-group-item">
                  <a href="#" class="card col-12 text-decoration-none text-body p-2">
                    <div class="row g-0 p-0 m-0 gap-3 gap-lg-5">
                      <div class="w-auto align-self-center">
                        <img src="<?php echo UPLOAD_DIR . $notifica["ImgPath"]; ?>" alt="" />
                      </div>
                      <div class="col-7 p-0 m-0">
                        <div class="card-body justify-content-between h-100">
                          <h5 class="card-title"><?php echo $notifica["TitoloNotifica"]; ?></h5>
                          <p class="card-text fw-lighter me-3"><?php echo $notifica["Data"]; ?></p>
                        </div>
                      </div>
                    </div>
                  </a>
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

    <div class="col-12 d-flex justify-content-center justify-content-md-end">
      <div class="col-6 d-flex justify-content-between gap-1 col-md-5 justify-content-md-end">
        <div class="col-12 col-md-6 ms-md-auto">
          <a href="login.php?action=logout" class="col-12 btn btn-danger">Logout</a>
        </div>
      </div>
    </div>
  </div>
</section>