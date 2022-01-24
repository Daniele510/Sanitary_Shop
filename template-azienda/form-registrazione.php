<div class="row registration">
    <h1 class="col-6">REGISTRATI ORA!</h1>
    <form action="./area-aziende/processa-modifiche.php?action=ins-new-azienda" method="POST" class="col-10 col-md-9 needs-validation inputs" novalidate>
        <div class="col-10 d-none err-msg">
            <p class="m-0 p-0" tabindex="-1">I campi evidenziati in rosso devono contenere valori validi</p>
        </div>
        <?php if($_GET["err-msg"]):?>
            <div class="col-10 err-msg d-flex justify-content-center">
            <p class="m-0 p-0" tabindex="-1"><?php echo $_GET["err-msg"];?></p>
        </div>
        <?php endif;?>
        <div class="row fields">
            <div class="row">
                <div class="row">
                    <label for="validationCompanyName" class="col-12 col-form-label form-label align-self-center">Nome Compagnia</label>
                    <div class="col-12 input">
                        <input type="text" class="form-control" id="validationCompanyName" name="NomeCompagnia" required>
                    </div>
                </div>
                <div class="row">
                    <label for="validationIVANum" class="col-12 col-form-label form-label">Partita IVA</label>
                    <div class="col-12 input">
                        <input type="text" class="form-control" id="validationIVANum" name="PartitaIVA" required>
                    </div>
                </div>
                <div class="row">
                    <label for="validationPhoneNum" class="col-12 col-form-label form-label">Numero di telefono</label>
                    <div class="col-12 input">
                        <input type="text" class="form-control" id="validationPhoneNum" name="NumeroTelefono" required>
                    </div>
                </div>
                <div class="row addr-form">
                    <div class="row">
                        <label for="validationDAddr" class="col-12 col-form-label form-label">Indirizzo sede</label>
                        <div class="col-12 input">
                            <input type="text" class="form-control justify-self-center" id="validationDAddr" placeholder="Via dell'Università 50" name="Ind_Via" required>
                        </div>
                    </div>
                    <div class="row">
                        <div>
                            <label for="validationCity" class="col-form-label form-label">Città Provincia CAP</label>
                            <div class="input">
                                <input type="text" class="form-control" id="validationCity" placeholder="Cesena Forlì-Cesena  47521" name="Ind_Citta" required>
                            </div>
                        </div>
                        <div>
                            <label for="validationCountry" class="col-form-label form-label">Paese</label>
                            <div class="input">
                                <input type="text" class="form-control" id="validationCountry" placeholder="Italia" name="Ind_Paese" required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
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
        </div>
        <div class="col-4 col-lg-3">
            <button class="col-12 btn primary" type="submit">Continue</button>
        </div>
    </form>
</div>