<section class="row modify gap-3">
    <header class="col-10 text-center p-0">
        <h1 class="m-0">Modifica Dati Spedizione</h1>
    </header>
    <form action="processa-modifiche.php?action=mod-info-spedizione" method="POST" class="col-10 col-md-9 needs-validation needs-confermation white-column-container px-3 inputs" novalidate>
        <?php if (isset($_GET["err-msg"])) : ?>
            <div class="col-10 err-msg">
                <p class="m-0 p-0 text-center" tabindex="-1"><?php echo $_GET["err-msg"]; ?></p>
            </div>
        <?php endif; ?>
        <div class="col-12 vstack fields p-0">
            <fieldset class="col-12 vstack">
                <div class="col-12">
                    <label for="validationFullName" class="col-form-label form-label">Nome Cognome <span class="text-danger" aria-hidden="true">*</span></label>
                    <div class="input">
                        <input type="text" class="form-control" id="validationFullName" value="<?php echo $templateParams["info-utente"]["NomeCompleto"]; ?>" name="NomeCompleto" required aria-describedby="invalid-feedback-name">
                        <div class="invalid-feedback" id="invalid-feedback-name">
                            Completare il campo
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <label for="validationPhoneNum" class="col-form-label form-label">Numero di telefono</label>
                    <div class="input">
                        <input type="tel" class="form-control" id="validationPhoneNum" name="NumeroTelefono" value="<?php if (!empty($templateParams["info-utente"]["NumeroTelefono"])) {
                            echo $templateParams["info-utente"]["NumeroTelefono"];
                        } ?>" pattern="\d{3}[\s-]?\d{3}[\s-]?\d{4}" aria-describedby="invalid-feedback-phone_num">
                        <div class="invalid-feedback" id="invalid-feedback-phone_num">
                            Il numero di telefono deve contenere 10 numeri, può essere suddifivo in gruppi da 3-3-4 cifre separati da 'spazio' o '-'
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <label for="validationDAddr" class="col-form-label form-label">Indirizzo di spedizione <span class="text-danger" aria-hidden="true">*</span></label>
                    <div class="input">
                        <input class="form-control" type="text" id="validationDAddr" name="Ind_Via" value="<?php echo $templateParams["info-utente"]["IndirizzoSpedizione"]; ?>" readonly>
                    </div>
                </div>
            </fieldset>

        </div>
        <div class="text-danger text-center mt-4" aria-hidden="true">i campi evidenziati sono obbligatori</div>
        <div class="col-12 mt-4 d-flex justify-content-between gap-3 text-center">
            <a href="login.php" class="col-5 btn btn-outline-secondary">Annulla</a>
            <button class="col-5 btn btn-primary" type="submit">Modifica</button>
        </div>
    </form>
    <?php require "conferma-form-modal.php"; ?>
</section>