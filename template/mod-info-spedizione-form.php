<div class="row modify">
    <h1 class="col-10">Modifica Dati Spedizione</h1>
    <form action="processa-modifiche.php?action=mod-info-spedizione" method="POST" class="col-10 col-md-9 needs-validation inputs" novalidate>
        <div class="col-10 err-msg d-none">
            <p class="m-0 p-0" tabindex="-1">I campi evidenziati in rosso devono contenere valori validi</p>
        </div>
        <div class="row fields">
            <div class="row">
                <div class="row">
                    <label for="validationFullName" class="col-12 col-form-label form-label">Nome Cognome</label>
                    <div class="col-12 input">
                        <input type="text" class="form-control" id="validationFullName" value="<?php echo $templateParams["info-utente"]["NomeCompleto"]; ?>" name="NomeCompleto" required pattern="[a-zA-z\s]+"required aria-describedby="invalid-feedback-name">
                        <div class="invalid-feedback" id="invalid-feedback-name">
                            <span aria-hidden="true">**</span>Completare il campo
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label for="validationPhoneNum" class="col-12 col-form-label form-label align-self-center">Numero di telefono</label>
                    <div class="col-12 input">
                        <input type="tel" class="form-control" id="validationPhoneNum" name="NumeroTelefono" value="<?php if (!empty($templateParams["info-utente"]["NumeroTelefono"])) {                                                                                   echo $templateParams["info-utente"]["NumeroTelefono"];
                        } ?>" required pattern="\d{3}[\s-]?\d{3}[\s-]?\d{4}" aria-describedby="invalid-feedback-phone_num">
                        <div class="invalid-feedback" id="invalid-feedback-phone_num">
                            <span aria-hidden="true">**</span>Il numero di telefono deve contenere 10 numeri, può essere suddifivo in gruppi da 3-3-4 cifre separati da 'spazio' o '-'
                        </div>
                    </div>
                </div>
            </div>

            <div class="row addr-form">
            <div class="row">
                    <label for="validationDAddr" class="col-12 col-form-label form-label">Indirizzo di spedizione</label>
                    <div class="col-12 input">
                        <input type="text" class="form-control justify-self-center" id="validationDAddr" value="<?php echo $templateParams["info-utente"]["Ind_Via"]; ?>" name="Ind_Via" required pattern="((V|v)ia|(V|v)iale|(C|c)orso|(P|p)iazza|(P|p)iazzale)\s[a-zA-Z\s'\.]+\s\d{1,3}[a-z]?" aria-describedby="invalid-feedback-addr">
                        <div class="invalid-feedback" id="invalid-feedback-addr">
                            <span aria-hidden="true">**</span>Utilizzare 'spazio' per separare i campi; non sono ammessi caratteri speciali a parte l'apice semplice e il punto
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