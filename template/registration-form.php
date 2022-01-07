<div class="row d-flex justify-content-center">
    <div class="row d-flex justify-content-center">
        <h1 class="col-6" style="margin: 40px 0 0 0; text-align: center;">Welcome!</h1>
    </div>
    <form class="col-10 col-md-9 needs-validation d-flex flex-column" style="margin-top: 1.875rem; gap: 55px; padding-bottom: 2rem; padding-top: 1rem; background: white; border-radius: 10px; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);" novalidate>
        <div class="row d-flex flex-column" style="gap: 21px;">
            <div class="row">
                <label for="validationFullName" class="col-sm-2 col-form-label form-label pt-0">Nome Completo</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control justify-self-center" id="validationFullName" placeholder="Mario Rossi" required>
                    <div class="invalid-feedback">
                        Please fill full-name's field
                    </div>
                </div>
            </div>
            <div class="row">
                <label for="validationNumTelefono" class="col-sm-2 col-form-label form-label pt-0">Numero di telefono</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="validationNumTelefono">
                </div>
            </div>
            <div class="row">
                <label for="validationEmail" class="col-sm-2 col-form-label form-label pt-0">Email</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" id="validationEmail" placeholder="esempio@gmail.com" required>
                    <div class="invalid-feedback">
                        Please insert a valid email address
                    </div>
                </div>
            </div>
            <div class="row">
                <label for="validationPassword" class="col-sm-2 col-form-label form-label pt-0">Password</label>
                <div class="col-sm-10">
                    <input class="form-control" type="password" id="validationPassword" required>
                    <div class="invalid-feedback">
                        Please fill the password's field
                    </div>
                </div>
            </div>
        </div>

        <div class="row d-flex flex-column" style="gap: 21px;">
            <div class="row">
                <label for="validationDAddr" class="col-sm-2 col-form-label form-label pt-0">Indirizzo di spedizione</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control justify-self-center" id="validationDAddr" placeholder="Via dell'Università 50" required>
                    <div class="invalid-feedback">
                        Please fill delivery-address's field
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-9">
                    <label for="validationCity" class="col-12 col-form-label form-label pt-0">Città Provincia CAP</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="validationCity" placeholder="Cesena Forlì-Cesena  47521" required>
                        <div class="invalid-feedback">
                            Please fill city's field
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <label for="validationCountry" class="col-12 col-form-label form-label pt-0">Paese</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="validationCountry" placeholder="IT" required style="text-transform: uppercase;" required>
                        <div class="invalid-feedback">
                            Please insert a valid country
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row d-flex flex-column" style="gap: 21px;">
            <div class="row">
                <label for="validationCard" class="col-sm-2 col-form-label form-label pt-0">Codice carta</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control justify-self-center" id="validationCard" required>
                    <div class="invalid-feedback">
                        Please fill card's field
                    </div>
                </div>
            </div>
            <div class="row">
                <label for="validationHolder" class="col-sm-2 col-form-label form-label pt-0">Nome titolare carta</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="validationHolder" placeholder="Mario Rossi" required>
                    <div class="invalid-feedback">
                        Please fill holder-name's field
                    </div>
                </div>
            </div>
            <div class="row">
                <label for="validationDate" class="col-sm-2 col-form-label form-label pt-0">Data di scatenza carta</label>
                <div class="col-sm-10">
                    <input type="date" class="form-control" id="validationDate" required>
                    <div class="invalid-feedback">
                        Please insert a valid date
                    </div>
                </div>
            </div>
        </div>

        <div class="col-4 col-lg-3 align-self-center">
            <button class="col-12 btn" type="submit" style="background-color: #06ACB8; border-radius: 10px; color: white;">Continue</button>
        </div>
    </form>
</div>