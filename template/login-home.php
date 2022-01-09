<div class="row d-flex justify-content-center p-0 m-0">
    <div class="col-11 d-flex flex-column align-items-center" style="row-gap: 2.375rem; margin-top: 2.375rem;">
        <div class="col-12 d-flex justify-content-between p-0">
            <div class="col-10">
                <button class="col-5 col-sm-3 btn" style="background: white; border: 3px solid #324B4B; border-radius: 10px;">ORDINI</button>
            </div>
            <div class="col-1">
                <a href="#"><img src="<?php echo UPLOAD_DIR . "iconImgs/bell.svg" ?>" alt="notifiche"></a>
            </div>
        </div>
        <div class="col-12 d-flex">
            <h1 class="m-0 p-0">Informazioni personali</h1>
        </div>
        <div class="col-12 d-flex flex-column p-0 m-0 info_container" style="gap: 2rem;">
            <div class="col d-flex flex-column" style="row-gap: 1.25rem; background-color: white; border-radius: 10px; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25); padding: 10px;">
                <h2 class="mb-0">Dati spedizione</h2>
                <p class="mb-0">
                    <?php echo $templateParams["info-utente"][0]["NomeCompleto"]; ?><br />
                    <?php echo $templateParams["info-utente"][0]["Ind_Via"]; ?><br />
                    <?php echo $templateParams["info-utente"][0]["Ind_Citta"]; ?><br />
                    <?php echo $templateParams["info-utente"][0]["Ind_Paese"]; ?><br />
                    <?php if (isset($templateParams["info-utente"][0]["NumeroTelefono"])) : ?>
                        Numero di telefono: <?php echo $templateParams["info-utente"][0]["NumeroTelefono"]; ?>
                    <?php endif; ?>
                </p>
                <a href="#">
                    <button class="col-5 col-sm-3 btn" style="background-color: #06ACB8; border-radius: 10px; color: white;">Modifica</button>
                </a>
            </div>
            <div class="col d-flex flex-column" style="row-gap: 1.25rem; background-color: white; border-radius: 10px; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25); padding: 10px;">
                <h2 class="mb-0">Dati spedizione</h2>
                <p class="mb-0">
                    ****<?php echo $templateParams["info-utente"][0]["CodCarta"]; ?><br />
                    <?php echo $templateParams["info-utente"][0]["NomeCompletoIntestatario"]; ?><br />
                    Data Scadenza: <?php echo $templateParams["info-utente"][0]["DataScadenza"]; ?>
                </p>
                <a href="#">
                    <button class="col-5 col-sm-3 btn" style="background-color: #06ACB8; border-radius: 10px; color: white;">Modifica</button>
                </a>
            </div>
        </div>
    </div>
</div>