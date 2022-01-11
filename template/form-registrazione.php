<div class="row d-flex justify-content-center registration">
    <h1 class="col-6 mb-0 d-flex justify-content-center" style="margin: 40px 0 0 0; text-align: center;">REGISTRATI ORA!</h1>
    <form action="processa-modifiche.php" method="POST" class="col-10 col-md-9 needs-validation d-flex flex-column inputs" novalidate>
        <div class="col-10 align-self-center d-none err-msg" style="margin: 2.75rem 0;">
            <p class="m-0 p-0" style="font-weight: lighter; font-style: italic; color: #C80000; font-size: small;" tabindex="-1">I campi evidenziati in rosso devono contenere valori validi</p>
        </div>
        <div class="row fields">
            <div class="row">
                <div class="row">
                    <label for="validationFullName" class="col-12 col-form-label form-label align-self-center">Nome Completo</label>
                    <div class="col-12 input">
                        <input type="text" class="form-control" id="validationFullName" placeholder="Mario Rossi" name="NomeCompleto" required>
                    </div>
                </div>
                <div class="row">
                    <label for="validationPhoneNum" class="col-12 col-form-label form-label">Numero di telefono</label>
                    <div class="col-12 input">
                        <input type="text" class="form-control" id="validationPhoneNum" name="NumeroTelefono">
                    </div>
                </div>
                <div class="row">
                    <label for="validationEmail" class="col-12 col-form-label form-label">Email</label>
                    <div class="col-12 input">
                        <input type="email" class="form-control" id="validationEmail" placeholder="esempio@gmail.com" name="Email" required>
                    </div>
                </div>
                <div class="row">
                    <label for="validationPassword" class="col-12 col-form-label form-label">Password</label>
                    <div class="col-12 input">
                        <input class="form-control" type="password" id="validationPassword" name="Password" required>
                    </div>
                </div>
            </div>

            <div class="row addr-form">
                <div class="row">
                    <label for="validationDAddr" class="col-12 col-form-label form-label">Indirizzo di spedizione</label>
                    <div class="col-12 input">
                        <input type="text" class="form-control justify-self-center" id="validationDAddr" placeholder="Via dell'Università 50" name="Ind_Via" required>
                    </div>
                </div>
                <div class="row" style="display: flex; gap: 21px; flex-wrap: wrap;">
                    <div style="width: auto; flex-grow: 1;">
                        <label for="validationCity" class="col-form-label form-label">Città Provincia CAP</label>
                        <div class="input">
                            <input type="text" class="form-control" id="validationCity" placeholder="Cesena Forlì-Cesena  47521" name="Ind_Citta" required>
                        </div>
                    </div>
                    <div style="flex-grow: 1;">
                        <label for="validationCountry" class="col-form-label form-label">Paese</label>
                        <div class="input">
                            <input type="text" class="form-control" id="validationCountry" placeholder="IT" name="Ind_Paese" required>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="row">
                    <label for="validationCard" class="col-12 col-form-label form-label">Codice carta</label>
                    <div class="col-12 input">
                        <input type="text" class="form-control justify-self-center" id="validationCard" name="CodCarta" required>
                    </div>
                </div>
                <div class="row">
                    <label for="validationHolder" class="col-12 col-form-label form-label">Nome titolare carta</label>
                    <div class="col-12 input">
                        <input type="text" class="form-control" id="validationHolder" placeholder="Mario Rossi" name="NomeIntestatarioCarta" required>
                    </div>
                </div>
                <div class="row">
                    <label for="validationDate" class="col-12 col-form-label form-label">Data di scadenza carta</label>
                    <div class="col-12 input">
                        <input type="date" class="form-control" id="validationDate" name="DataScadenza" required>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-4 col-lg-3 align-self-center" style="margin-top: 55px;">
            <button class="col-12 btn primary" type="submit" name="submit-ins-new-utente">Continue</button>
        </div>
    </form>
</div>