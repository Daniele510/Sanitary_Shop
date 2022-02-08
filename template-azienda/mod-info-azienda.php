<div class="row modify">
    <h1 class="col-10">modifica info compagnia</h1>
    <form action="processa-modifiche.php?action=mod-info-azienda" method="POST" class="col-10 col-md-9 needs-validation inputs" novalidate>
        <?php if (isset($_GET["err-msg"])) : ?>
            <div class="col-10 err-msg">
                <p class="m-0 p-0 text-center" tabindex="-1"><?php echo $_GET["err-msg"]; ?></p>
            </div>
        <?php endif; ?>
        <div class="row fields">
            <div class="row">
                <div class="row">
                    <label for="validationCompanyName" class="col-12 col-form-label form-label align-self-center">Nome Compangia</label>
                    <div class="col-12 input">
                        <input type="text" class="form-control" id="validationCompanyName" value="<?php echo $templateParams["info-azienda"]["NomeCompagnia"]; ?>" name="NomeCompagnia" aria-describedby="invalid-feedback-company_name" required>
                        <div class="invalid-feedback" id="invalid-feedback-company_name">
                            <span aria-hidden="true">**</span>Completare il campo
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label for="validationPhoneNum" class="col-12 col-form-label form-label align-self-center">Numero di telefono</label>
                    <div class="col-12 input">
                        <input type="text" class="form-control" id="validationPhoneNum" name="NumeroTelefono" value="<?php echo $templateParams["info-azienda"]["NumeroTelefono"]; ?>" required pattern="\d{3}[\s-]?\d{3}[\s-]?\d{4}" aria-describedby="invalid-feedback-phone_num">
                        <div class="invalid-feedback" id="invalid-feedback-phone_num">
                            <span aria-hidden="true">**</span>Il numero di telefono deve contenere 10 numeri, può essere suddifivo in gruppi da 3-3-4 cifre separati da 'spazio' o '-'
                        </div>
                    </div>
                </div>
            </div>
            <div class="row addr-form">
                <div class="row">
                    <label for="validationAddr" class="col-12 col-form-label form-label">Indirizzo sede</label>
                    <div class="col-12 input">
                        <input type="text" class="form-control justify-self-center" id="validationDAddr" value="<?php echo $templateParams["info-azienda"]["Ind_Via"]; ?>" name="Ind_Via" required pattern="((V|v)ia|(V|v)iale|(C|c)orso|(P|p)iazza|(P|p)iazzale)\s[a-zA-Z\s'àì\.]+\s\d{1,3}[a-z]?" aria-describedby="invalid-feedback-addr">
                        <div class="invalid-feedback" id="invalid-feedback-addr">
                            <span aria-hidden="true">**</span>Utilizzare 'spazio' per separare i campi; non sono ammessi caratteri speciali a parte l'apice semplice e il punto
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div>
                        <label for="validationCity" class="col-form-label form-label">Città Provincia CAP</label>
                        <div class="input">
                            <input type="text" class="form-control" id="validationCity" value="<?php echo $templateParams["info-azienda"]["Ind_Citta"]; ?>" name="Ind_Citta" required pattern="[a-zA-Z\-ì]+\s[a-zA-Z\-ì]+\s\d{5}" aria-describedby="invalid-feedback-city">
                            <div class="invalid-feedback" id="invalid-feedback-city">
                                <span aria-hidden="true">**</span>Il nome della citta e quello della provincia possono essere solo lettere, nel caso di nomi composti utilizzare il carattere '-' come separatore, mentre il CAP contiene solo 5 numeri
                            </div>
                        </div>
                    </div>
                    <div>
                        <label for="validationCountry" class="col-form-label form-label">Paese</label>
                        <div class="input">
                            <input type="text" class="form-control" id="validationCountry" value="<?php echo $templateParams["info-azienda"]["Ind_Paese"]; ?>" name="Ind_Paese" required pattern="[a-zA-Z\s]+" aria-describedby="invalid-feedback-country">
                            <div class="invalid-feedback" id="invalid-feedback-country">
                                <span aria-hidden="true">**</span>Il nome del paese deve contenere solo lettere, nel caso di nome composto utilizzare 'spazio' per separare
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <a href="login.php" class="col-5 btn outline_secondary">Annulla</a>
            <button class="col-5 btn primary" type="submit">Modifica</button>
        </div>
    </form>
</div>