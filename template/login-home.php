<div class="row d-flex justify-content-center p-0 m-0">
    <div class="col-11 grid-container" style="margin-top: 2.375rem;">
        <div class="d-flex justify-content-start">
            <button class="col-6 btn outline_primary">ORDINI</button>
        </div>
        <div id="notifiche">
            <a href="#"><img src="<?php echo UPLOAD_DIR . "iconImgs/bell.svg"; ?>" alt="notifiche"></a>
            <div class="col">
                <?php for ($i = 0; $i < 5; $i++) : ?>
                    <div class="card col-12">
                        <div class="row d-flex align-items-stretch">
                            <div class="col-5">
                                <img src="upload/categoryImgs/Bagno.png" class="img-fluid" alt="" />
                            </div>
                            <div class="col-7">
                                <div class="card-body d-flex flex-column p-0">
                                    <h5 class="card-title m-0">Lorem ipsum dolor, sit amet</h5>
                                    <p class="card-text m-0">pippo</p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endfor; ?>
            </div>
        </div>
        <div class="d-flex">
            <h2 class="m-0 p-0">Informazioni personali</h2>
        </div>
        <div class="row container-dati">
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
                <a class="col-7 col-sm-5 btn primary d-flex justify-content-center" href="login.php?action=mod-info-spedizione">Modifica</a>
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
                <a class="col-7 col-sm-5 btn primary d-flex justify-content-center" href="login.php?action=mod-info-carta">Modifica</a>
            </div>
        </div>
    </div>
</div>