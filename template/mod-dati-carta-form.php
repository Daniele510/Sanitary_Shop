<div class="row modify">
    <h1 class="col-10">Modifica Dati Della Carta</h1>
    <form action="processa-modifiche.php?action=mod-info-carta" method="POST" class="col-10 col-md-9 needs-validation inputs" novalidate>
        <?php if (isset($_GET["err-msg"])) : ?>
            <div class="col-10 err-msg">
                <p class="m-0 p-0 text-center" tabindex="-1"><?php echo $_GET["err-msg"]; ?></p>
            </div>
        <?php endif; ?>
        <div class="row fields">
            <div class="row">
                <div class="row">
                    <label for="validationCodCarta" class="col-12 col-form-label form-label">Codice Carta <span class="text-danger" aria-hidden="true">*</span></label>
                    <div class="col-12 input">
                        <input type="text" class="form-control" id="validationCodCarta" name="CodCarta" value="<?php echo $templateParams["info-utente"]["CodCarta"]; ?>" pattern="\d{13,16}" required aria-describedby="invalid-feedback-name">
                        <div class="invalid-feedback" id="invalid-feedback-codCarta">
                            Inserire codice numerico composto dalle 13 alle 16 cifre
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label for="validationFullName" class="col-12 col-form-label form-label align-self-center">Nome Completo Intestatario <span class="text-danger" aria-hidden="true">*</span></label>
                    <div class="col-12 input">
                        <input type="text" class="form-control" id="validationFullName" name="NomeIntestatarioCarta" value="<?php echo $templateParams["info-utente"]["NomeCompletoIntestatario"]; ?>" required pattern="[a-zA-z\s]+" aria-describedby="invalid-feedback-name">
                        <div class="invalid-feedback" id="invalid-feedback-name">
                            Completare il campo
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label for="validationDataScadenza" class="col-12 col-form-label form-label">Data Scadenza <span class="text-danger" aria-hidden="true">*</span></label>
                    <div class="col-12 input">
                        <input type="tel" class="form-control" id="validationDataScadenza" name="DataScadenza" value="<?php echo $templateParams["info-utente"]["MeseScadenza"]; ?> <?php echo $templateParams["info-utente"]["AnnoScadenza"]; ?>" required pattern="\d{2}\s\d{4}" aria-describedby="invalid-feedback-date">
                        <div class="invalid-feedback" id="invalid-feedback-date">
                            Inserire prima il numero del mese e poi quello dell'anno; per separare mese e anno utilizzare spazio
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-danger text-center mt-5" aria-hidden="true">i campi evidenziati sono obbligatori</div>
        <div class="row">
            <a href="login.php" class="col-5 btn outline_secondary">Annulla</a>
            <button class="col-5 btn primary" type="submit">Modifica</button>
        </div>
    </form>
    <?php require "conferma-form-modal.php"; ?>
</div>