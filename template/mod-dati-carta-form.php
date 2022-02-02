<div class="row modify">
    <h1 class="col-10">Modifica Dati Della Carta</h1>
    <form action="processa-modifiche.php" method="POST" class="col-10 col-md-9 needs-validation inputs" novalidate>
        <div class="col-10 err-msg d-none">
            <p class="m-0 p-0" tabindex="-1">I campi evidenziati in rosso devono contenere valori validi</p>
        </div>
        <div class="row fields">
            <div class="row">
                <div class="row">
                    <label for="validationCodCarta" class="col-12 col-form-label form-label">Codice Carta</label>
                    <div class="col-12 input">
                        <input type="text" class="form-control" id="validationCodCarta" name="CodCarta" value="<?php echo $templateParams["info-utente"]["CodCarta"]; ?>" pattern="\d{13,16}" required aria-describedby="invalid-feedback-name">
                        <div class="invalid-feedback" id="invalid-feedback-name">
                            <span aria-hidden="true">**</span>Inserire codice numerico composto dalle 13 alle 16 cifre
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label for="validationFullName" class="col-12 col-form-label form-label align-self-center">Nome Completo Intestatario</label>
                    <div class="col-12 input">
                        <input type="text" class="form-control" id="validationFullName" name="NomeIntestatarioCarta" value="<?php echo $templateParams["info-utente"]["NomeCompletoIntestatario"]; ?>" required pattern="[a-zA-z\s]+" aria-describedby="invalid-feedback-name">
                        <div class="invalid-feedback" id="invalid-feedback-name">
                            <span aria-hidden="true">**</span>Completare il campo
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label for="validationDataScadenza" class="col-12 col-form-label form-label">Data Scadenza</label>
                    <div class="col-12 input">
                        <input type="date" class="form-control" id="validationDataScadenza" name="DataScadenza" value="<?php echo $templateParams["info-utente"]["DataScadenza"]; ?>" required pattern="\d{2}[\s-:]?\d{4}[\s-:]" aria-describedby="invalid-feedback-date">
                        <div class="invalid-feedback" id="invalid-feedback-date">
                            <span aria-hidden="true">**</span>Completare il campo
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <a href="login.php" class="col-5 btn outline_secondary">Annulla</a>
            <button class="col-5 btn primary" type="submit" name="submit-mod-info-carta">Modifica</button>
        </div>
    </form>
</div>