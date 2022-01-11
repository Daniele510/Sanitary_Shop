<div class="row  d-flex justify-content-center">
    <div class="col-12 text-center" style="margin: 45px 0;">
        <h1 class="m-0" style="text-transform: capitalize;">modifica dati spedizione</h1>
    </div>
    <form action="processa-modifiche.php" method="POST" class="col-10 col-md-9 needs-validation d-flex flex-column inputs" novalidate>
        <div class="col-10 align-self-center d-none err-msg" style="margin: 2.75rem 0;">
            <p class="m-0 p-0" style="font-weight: lighter; font-style: italic; color: #C80000; font-size: small;" tabindex="-1">I campi evidenziati in rosso devono contenere valori validi</p>
        </div>
        <div class="row fields" style="gap: 55px;">
            <div class="row">
                <div class="row">
                    <label for="validationFullName" class="col-12 col-form-label form-label">Nome Cognome</label>
                    <div class="col-12 input">
                        <input type="text" class="form-control" id="validationFullName" value="<?php echo $templateParams["info-sped"][0]["NomeCompleto"]; ?>" name="NomeCompleto" required>
                    </div>
                </div>
                <div class="row">
                    <label for="validationPhoneNum" class="col-12 col-form-label form-label align-self-center">Numero di telefono</label>
                    <div class="col-12 input">
                        <input type="text" class="form-control" id="validationPhoneNum" name="NumeroTelefono" value="<?php
                                                                                                                        if (!empty($templateParams["info-sped"][0]["NumeroTelefono"])) {
                                                                                                                            echo $templateParams["info-sped"][0]["NumeroTelefono"];
                                                                                                                        } ?>">
                    </div>
                </div>
            </div>
            <div class="row addr-form">
                <div class="row">
                    <label for="validationDAddr" class="col-12 col-form-label form-label">Indirizzo di spedizione</label>
                    <div class="col-12 input">
                        <input type="text" class="form-control justify-self-center" id="validationDAddr" value="<?php echo $templateParams["info-sped"][0]["Ind_Via"]; ?>" name="Ind_Via" required>
                    </div>
                </div>
                <div class="row" style="display: flex; gap: 21px; flex-wrap: wrap;">
                    <div style="width: auto; flex-grow: 1;">
                        <label for="validationCity" class="col-form-label form-label">Città Provincia CAP</label>
                        <div class="input">
                            <input type="text" class="form-control" id="validationCity" value="<?php echo $templateParams["info-sped"][0]["Ind_Citta"]; ?>" name="Ind_Citta" required>
                        </div>
                    </div>
                    <div style="flex-grow: 1;">
                        <label for="validationCountry" class="col-form-label form-label">Paese</label>
                        <div class="input">
                            <input type="text" class="form-control" id="validationCountry" value="<?php echo $templateParams["info-sped"][0]["Ind_Paese"]; ?>" name="Ind_Paese" required>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 d-flex justify-content-between" style="margin-top: 55px;">
            <a href="user-login.php" class="col-5 btn outline_secondary">
                Annulla
            </a>
            <button class="col-5 btn primary" type="submit" name="submit-mod-info-spedizione">Modifica</button>
        </div>
    </form>
</div>