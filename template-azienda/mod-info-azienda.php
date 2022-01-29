<div class="row  d-flex justify-content-center">
    <div class="col-12 text-center">
        <h1 class="m-0">modifica info compagnia</h1>
    </div>
    <form action="./processa-modifiche.php" method="POST" class="col-10 col-md-9 needs-validation inputs" novalidate>
    <div class="col-10 err-msg d-none">
            <p class="m-0 p-0" tabindex="-1">I campi evidenziati in rosso devono contenere valori validi</p>
        </div>
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
                        <input type="text" class="form-control" id="validationCompanyName" value="<?php echo $templateParams["info-azienda"]["NomeCompagnia"]; ?>" name="NomeCompagnia" required>
                        <div class="invalid-feedback">
                            **Completare il campo
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label for="validationPhoneNum" class="col-12 col-form-label form-label align-self-center">Numero di telefono</label>
                    <div class="col-12 input">
                        <input type="text" class="form-control" id="validationPhoneNum" name="NumeroTelefono" value="<?php echo $templateParams["info-azienda"]["NumeroTelefono"]; ?>" pattern="\d{3}[\s-]?\d{3}[\s-]?\d{4}" required>
                        <div class="invalid-feedback">
                            **Il numero di telefono deve contenere 10 numeri, può essere suddifivo in gruppi da 3-3-4 cifre separati da 'spazio' o '-'
                        </div>
                    </div>
                </div>
            </div>
            <div class="row addr-form">
                <div class="row">
                    <label for="validationDAddr" class="col-12 col-form-label form-label">Indirizzo sede</label>
                    <div class="col-12 input">
                        <input type="text" class="form-control justify-self-center" id="validationDAddr" value="<?php echo $templateParams["info-azienda"]["Ind_Via"]; ?>" name="Ind_Via" pattern="((V|v)ia|(V|v)iale|(C|c)orso|(P|p)iazza|(P|p)iazzale)\s[a-zA-Z\s'\.]+\s\d{1,3}[a-z]?" required>
                        <div class="invalid-feedback">
                            **Utilizzare 'spazio' per separare i campi; non sono ammessi caratteri speciali a parte l'apice semplice e il punto
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div>
                        <label for="validationCity" class="col-form-label form-label">Città Provincia CAP</label>
                        <div class="input">
                            <input type="text" class="form-control" id="validationCity" value="<?php echo $templateParams["info-azienda"]["Ind_Citta"]; ?>" name="Ind_Citta" pattern="[a-zA-Z\-ì]+\s[a-zA-Z\-ì]+\s\d{5}" required>
                            <div class="invalid-feedback">
                                **Il nome della citta e quello della provincia possono essere solo lettere, nel caso di nomi composti utilizzare il carattere '-' come separatore, mentre il CAP contiene solo 5 numeri
                            </div>
                        </div>
                    </div>
                    <div>
                        <label for="validationCountry" class="col-form-label form-label">Paese</label>
                        <div class="input">
                            <input type="text" class="form-control" id="validationCountry" value="<?php echo $templateParams["info-azienda"]["Ind_Paese"]; ?>" name="Ind_Paese" pattern="[a-zA-Z\s]+" required>
                            <div class="invalid-feedback">
                                **Il nome del paese deve contenere solo lettere, nel caso di nome composto utilizzare il 'spazio' per separare
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <a href="login.php" class="col-5 btn outline_secondary">Annulla</a>
            <button class="col-5 btn primary" type="submit" name="submit-mod-info-azienda">Modifica</button>
        </div>
    </form>
</div>