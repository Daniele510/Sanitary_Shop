<div class="row d-flex justify-content-center p-0 m-0">
    <div class="col-11 grid-container" id="user-home">
        <div class="d-flex" id="ordini">
            <!-- TODO: implementare la schermata ordini -->
            <a href="#" class="col-6 btn outline_primary">ORDINI</a>
        </div>
        <div id="notifiche">
            <!-- TODO: implementare la schermata notifiche -->
            <a href="#">
                <img src="<?php if (!empty($templateParams["info-utente"]["Notifiche"]) && count($templateParams["info-utente"]["Notifiche"]) > 0) {
                                echo UPLOAD_DIR . "iconImgs/active-bell.svg";
                            } else {
                                echo UPLOAD_DIR . "iconImgs/bell.svg";
                            } ?>" alt="notifiche">
            </a>
            <div class="col-12">
                <div class="row">
                    <div class="col-5 p-0 d-flex">
                        <h3 class="p-0 m-0">Notifiche</h3>
                    </div>
                </div>
                <?php if (!empty($templateParams["info-utente"]["Notifiche"])) :
                    foreach ($templateParams["info-utente"]["Notifiche"] as $notifica) : ?>
                        <div class="card col-12">
                            <div class="row">
                                <div class="col-5">
                                    <img src="upload/categoryImgs/Bagno.png" class="img-fluid" alt="" />
                                </div>
                                <div class="col-7 card-body">
                                    <h5 class="card-title m-0"><?php echo $notifica["TitoloNotifica"]; ?></h5>
                                    <p class="card-text m-0"><?php echo $notifica["Data"]; ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach;
                else : ?>
                    <p class="text-center m-0">non hai notifiche</p>
                <?php endif; ?>
            </div>
        </div>
        <div class="d-flex" id="titolo">
            <h1 class="m-0 p-0">Informazioni personali</h1>
        </div>
        <div class="row" id="info-addr">
            <div class="col-12 container">
                <h3 class="mb-0">Dati spedizione</h3>
                <p class="mb-0">
                    <?php echo $templateParams["info-utente"]["NomeCompleto"]; ?><br />
                    <?php echo $templateParams["info-utente"]["Ind_Via"]; ?><br />
                    <?php echo $templateParams["info-utente"]["Ind_Citta"]; ?><br />
                    <?php echo $templateParams["info-utente"]["Ind_Paese"]; ?><br />
                    <?php if (!empty($templateParams["info-utente"]["NumeroTelefono"])) : ?>
                        Numero di telefono: <?php echo $templateParams["info-utente"]["NumeroTelefono"]; ?>
                    <?php endif; ?>
                </p>
                <a class="col-7 col-sm-5 btn primary" href="login.php?action=mod-info-spedizione">Modifica</a>
            </div>
        </div>
        <div class="row" id="info-carta">
            <div class="col-12 container">
                <h3 class="mb-0">Modalità di pagamento</h3>
                <p class="mb-0">
                    ****<?php echo substr($templateParams["info-utente"]["CodCarta"], -4); ?><br />
                    <?php echo $templateParams["info-utente"]["NomeCompletoIntestatario"]; ?><br />
                    Data Scadenza: <?php echo $templateParams["info-utente"]["MeseScadenza"]; ?>-<?php echo $templateParams["info-utente"]["AnnoScadenza"]; ?>
                </p>
                <a class="col-7 col-sm-5 btn primary" href="login.php?action=mod-info-carta">Modifica</a>
            </div>
        </div>
        <div id="logout">
            <a href="login.php?action=logout" class="col-7 btn btn-danger">Logout</a>
        </div>
    </div>
</div>