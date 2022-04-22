<section class="row modify gap-3">
    <header class="col-12 text-center p-0">
        <h1 class="m-0">modifica info compagnia</h1>
    </header>
    <form action="processa-modifiche.php?action=mod-info-azienda" method="POST" class="col-10 col-md-8 col-lg-6 needs-validation needs-confermation white-column-container px-3 inputs" novalidate>
        <?php if (isset($_GET["err-msg"])) : ?>
            <div class="col-10 err-msg">
                <p class="m-0 p-0 text-center" tabindex="-1"><?php echo $_GET["err-msg"]; ?></p>
            </div>
        <?php endif; ?>
        <div class="col-12 vstack fields p-0">
            <fieldset class="col-12 vstack">
                <div class="col-12">
                    <label for="validationCompanyName" class="col-form-label form-label align-self-center">Nome Compangia <span class="text-danger" aria-hidden="true">*</span></label>
                    <div class="input">
                        <input type="text" class="form-control" id="validationCompanyName" value="<?php echo $templateParams["info-azienda"]["NomeCompagnia"]; ?>" name="NomeCompagnia" aria-describedby="invalid-feedback-company_name" required>
                        <div class="invalid-feedback" id="invalid-feedback-company_name">
                            Completare il campo
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <label for="validationPhoneNum" class="col-form-label form-label align-self-center">Numero di telefono <span class="text-danger" aria-hidden="true">*</span></label>
                    <div class="input">
                        <input type="text" class="form-control" id="validationPhoneNum" name="NumeroTelefono" value="<?php echo $templateParams["info-azienda"]["NumeroTelefono"]; ?>" required pattern="\d{3}[\s-]?\d{3}[\s-]?\d{4}" aria-describedby="invalid-feedback-phone_num">
                        <div class="invalid-feedback" id="invalid-feedback-phone_num">
                            Il numero di telefono deve contenere 10 numeri, può essere suddifivo in gruppi da 3-3-4 cifre separati da 'spazio' o '-'
                        </div>
                    </div>
                </div>
            </fieldset>
            <fieldset class="col-12 vstack addr-form">
                <div class="col-12">
                    <label for="validationAddr" class="col-form-label form-label">Indirizzo sede <span class="text-danger" aria-hidden="true">*</span></label>
                    <div class="input">
                        <input type="text" class="form-control justify-self-center" id="validationDAddr" value="<?php echo $templateParams["info-azienda"]["Ind_Via"]; ?>" name="Ind_Via" required pattern="((V|v)ia|(V|v)iale|(C|c)orso|(P|p)iazza|(P|p)iazzale)\s[a-zA-Z\s'àì\.]+\s\d{1,3}[a-z]?" aria-describedby="invalid-feedback-addr">
                        <div class="invalid-feedback" id="invalid-feedback-addr">
                            Utilizzare 'spazio' per separare i campi; non sono ammessi caratteri speciali a parte l'apice semplice e il punto
                        </div>
                    </div>
                </div>
                <div class="col-12 d-flex flex-wrap">
                    <div class="flex-grow-1 w-50">
                        <label for="validationCity" class="col-form-label form-label">Città Provincia CAP <span class="text-danger" aria-hidden="true">*</span></label>
                        <div class="input">
                            <input type="text" class="form-control" id="validationCity" value="<?php echo $templateParams["info-azienda"]["Ind_Citta"]; ?>" name="Ind_Citta" required pattern="[a-zA-Z\-aì]+\s[a-zA-Z\-aì]+\s\d{5}" aria-describedby="invalid-feedback-city">
                            <div class="invalid-feedback" id="invalid-feedback-city">
                                Il nome della citta e quello della provincia possono essere solo lettere, nel caso di nomi composti utilizzare il carattere '-' come separatore, mentre il CAP contiene solo 5 numeri
                            </div>
                        </div>
                    </div>
                    <div class="flex-grow-1">
                        <label for="validationCountry" class="col-form-label form-label">Paese <span class="text-danger" aria-hidden="true">*</span></label>
                        <div class="input">
                            <input type="text" class="form-control" id="validationCountry" value="<?php echo $templateParams["info-azienda"]["Ind_Paese"]; ?>" name="Ind_Paese" required pattern="[a-zA-Z\s]+" aria-describedby="invalid-feedback-country">
                            <div class="invalid-feedback" id="invalid-feedback-country">
                                Il nome del paese deve contenere solo lettere, nel caso di nome composto utilizzare 'spazio' per separare
                            </div>
                        </div>
                    </div>
                </div>
            </fieldset>
        </div>
        <div class="text-danger text-center mt-5" aria-hidden="true">i campi evidenziati sono obbligatori</div>
        <div class="col-12 mt-4 d-flex justify-content-between gap-3 flex-wrap text-center">
            <a href="login.php" class="col-5 btn btn-outline-secondary">Annulla</a>
            <button class="col-5 btn btn-primary" type="submit">Modifica</button>
        </div>
    </form>
    <?php require "../template/conferma-form-modal.php"; ?>
</section>