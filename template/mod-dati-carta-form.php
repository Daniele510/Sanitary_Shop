<section class="row modify gap-3">
    <header class="col-10 text-center p-0">
        <h1 class="m-0">Modifica Dati Della Carta</h1>
    </header>
    <form action="processa-modifiche.php?action=mod-info-carta" method="POST" class="col-10 col-md-8 col-lg-6 needs-validation needs-confermation white-column-container px-3 inputs" novalidate>
        <?php if (isset($_GET["err-msg"])) : ?>
            <div class="col-10 err-msg">
                <p class="m-0 p-0 text-center" tabindex="-1"><?php echo $_GET["err-msg"]; ?></p>
            </div>
        <?php endif; ?>
        <div class="col-12 vstack fields p-0">
            <fieldset class="col-12 vstack">
                <div class="col-12">
                    <label for="validationCodCarta" class="col-form-label form-label">Codice Carta <span class="text-danger" aria-hidden="true">*</span></label>
                    <div class="input">
                        <input type="text" class="form-control" id="validationCodCarta" name="CodCarta" value="<?php echo $templateParams["info-utente"]["CodCarta"]; ?>" pattern="\d{13,16}" required aria-describedby="invalid-feedback-name">
                        <div class="invalid-feedback" id="invalid-feedback-codCarta">
                            Inserire codice numerico composto dalle 13 alle 16 cifre
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <label for="validationFullName" class="col-form-label form-label align-self-center">Nome Completo Intestatario <span class="text-danger" aria-hidden="true">*</span></label>
                    <div class="input">
                        <input type="text" class="form-control" id="validationFullName" name="NomeIntestatarioCarta" value="<?php echo $templateParams["info-utente"]["NomeCompletoIntestatario"]; ?>" required pattern="[a-zA-z\s]+" aria-describedby="invalid-feedback-name">
                        <div class="invalid-feedback" id="invalid-feedback-name">
                            Completare il campo
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <label for="validationDataScadenza" class="col-form-label form-label">Data Scadenza <span class="text-danger" aria-hidden="true">*</span></label>
                    <div class="input">
                        <input type="tel" class="form-control" id="validationDataScadenza" name="DataScadenza" value="<?php echo $templateParams["info-utente"]["MeseScadenza"]; ?> <?php echo $templateParams["info-utente"]["AnnoScadenza"]; ?>" required pattern="\d{2}\s\d{4}" aria-describedby="invalid-feedback-date">
                        <div class="invalid-feedback" id="invalid-feedback-date">
                            Inserire prima il numero del mese e poi quello dell'anno; per separare mese e anno utilizzare spazio
                        </div>
                    </div>
                </div>
            </fieldset>
        </div>
        <p class="text-danger text-center mt-4" aria-hidden="true">i campi evidenziati sono obbligatori</p>
        <div class="col-12 mt-4 d-flex justify-content-between gap-3 flex-wrap text-center">
            <a href="login.php" class="col-5 btn btn-outline-secondary">Annulla</a>
            <button class="col-5 btn btn-primary" type="submit">Modifica</button>
        </div>
    </form>
    <?php require "conferma-form-modal.php"; ?>
</section>