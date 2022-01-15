<div class="row modify">
    <h1 class="col-10">Modifica Dati Spedizione</h1>
    <form action="processa-modifiche.php" method="POST" class="col-10 col-md-9 needs-validation inputs" novalidate>
        <div class="col-10 err-msg">
            <p class="m-0 p-0" tabindex="-1">I campi evidenziati in rosso devono contenere valori validi</p>
        </div>
        <div class="row fields">
            <div class="row">
                <div class="row">
                    <label for="validationFullName" class="col-12 col-form-label form-label">Nome Cognome</label>
                    <div class="col-12 input">
                        <input type="text" class="form-control" id="validationFullName" value="<?php echo $templateParams["info-utente"]["NomeCompleto"]; ?>" name="NomeCompleto" required>
                    </div>
                </div>
                <div class="row">
                    <label for="validationPhoneNum" class="col-12 col-form-label form-label align-self-center">Numero di telefono</label>
                    <div class="col-12 input">
                        <input type="text" class="form-control" id="validationPhoneNum" name="NumeroTelefono" value="<?php
                                                                                                                        if (!empty($templateParams["info-utente"]["NumeroTelefono"])) {
                                                                                                                            echo $templateParams["info-utente"]["NumeroTelefono"];
                                                                                                                        } ?>">
                    </div>
                </div>
            </div>

            <div class="row addr-form">
            <div class="row">
                    <label for="validationDAddr" class="col-12 col-form-label form-label">Indirizzo di spedizione</label>
                    <div class="col-12 input">
                        <input type="text" class="form-control justify-self-center" id="validationDAddr" value="<?php echo $templateParams["info-utente"]["Ind_Via"]; ?>" name="Ind_Via" required>
                    </div>
                </div>
                <div class="row">
                    <div>
                        <label for="validationCity" class="col-form-label form-label">Città Provincia CAP</label>
                        <div class="input">
                            <input type="text" class="form-control" id="validationCity" value="<?php echo $templateParams["info-utente"]["Ind_Citta"]; ?>" name="Ind_Citta" required>
                        </div>
                    </div>
                    <div>
                        <label for="validationCountry" class="col-form-label form-label">Paese</label>
                        <div class="input">
                            <input type="text" class="form-control" id="validationCountry" value="<?php echo $templateParams["info-utente"]["Ind_Paese"]; ?>" name="Ind_Paese" required>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="row">
            <a href="login.php?action=gohome" class="col-5 btn outline_secondary">Annulla</a>
            <button class="col-5 btn primary" type="submit" name="submit-mod-info-spedizione">Modifica</button>
        </div>
    </form>
</div>