<div class="row d-flex justify-content-center p-0 m-0">
    <div class="col-11 grid-container">
        <div class="d-flex">
            <a href="#" class="col-6 btn outline_primary">ORDINI</a>
        </div>
        <div id="notifiche">
            <a href="#"><img src="<?php echo UPLOAD_DIR . "iconImgs/bell.svg"; ?>" alt="notifiche"></a>
            <div class="col-12">
                <div class="row">
                    <div class="col-5 p-0 d-flex">
                        <h3 class="p-0 m-0">Notifiche</h3>
                    </div>
                </div>
                <?php if (!empty($templateParams["info-user"][0]["Notifiche"])) :
                    foreach ($templateParams["info-user"][0]["Notifiche"] as $notifica) : ?>
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
        <div class="d-flex">
            <h1 class="m-0 p-0">Informazioni personali</h1>
        </div>
        <div class="row">
            <div class="col-12 container">
                <h3 class="mb-0">Dati spedizione</h3>
                <p class="mb-0">
                    <?php echo $templateParams["info-utente"][0]["NomeCompleto"]; ?><br />
                    <?php echo $templateParams["info-utente"][0]["Ind_Via"]; ?><br />
                    <?php echo $templateParams["info-utente"][0]["Ind_Citta"]; ?><br />
                    <?php echo $templateParams["info-utente"][0]["Ind_Paese"]; ?><br />
                    <?php if (!empty($templateParams["info-utente"][0]["NumeroTelefono"])) : ?>
                        Numero di telefono: <?php echo $templateParams["info-utente"][0]["NumeroTelefono"]; ?>
                    <?php endif; ?>
                </p>
                <a class="col-7 col-sm-5 btn primary" href="login.php?action=mod-info-spedizione">Modifica</a>
            </div>
        </div>
        <div class="row">
            <div class="col-12 container">
                <h3 class="mb-0">Modalità di pagamento</h3>
                <p class="mb-0">
                    ****<?php echo $templateParams["info-utente"][0]["CodCarta"]; ?><br />
                    <?php echo $templateParams["info-utente"][0]["NomeCompletoIntestatario"]; ?><br />
                    Data Scadenza: <?php echo $templateParams["info-utente"][0]["DataScadenza"]; ?>
                </p>
                <a class="col-7 col-sm-5 btn primary" href="login.php?action=mod-info-carta">Modifica</a>
            </div>
        </div>
        <div id="logout">
            <a href="login.php?action=logout" class="col-12 btn btn-danger">Logout</a>
        </div>
    </div>
</div>