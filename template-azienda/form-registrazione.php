<section class="row registration gap-4 gap-md-5">
    <header class="col-10 col-md-8 col-lg-6 p-0 text-center">
        <h1 class="m-0">REGISTRATI ORA!</h1>
    </header>
    <form action="./area-aziende/processa-modifiche.php?action=ins-new-azienda" method="POST" class="col-10 col-md-8 col-lg-6 white-column-container px-3 inputs needs-validation" novalidate>
        <?php if (isset($_GET["err-msg"])) : ?>
            <div class="col-10 err-msg">
                <p class="m-0 p-0 text-center" tabindex="-1"><?php echo $_GET["err-msg"]; ?></p>
            </div>
        <?php endif; ?>
        <div class="col-12 vstack fields p-0">
            <fieldset class="col-12 vstack">
                <div class="col-12">
                    <label for="validationCompanyName" class="col-form-label form-label align-self-center">Nome Compagnia <span class="text-danger" aria-hidden="true">*</span></label>
                    <div>
                        <input type="text" class="form-control" id="validationCompanyName" name="NomeCompagnia" required aria-describedby="invalid-feedback-company_name">
                        <div class="invalid-feedback" id="invalid-feedback-company_name">
                            Completare il campo
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <label for="validationIVANum" class="col-form-label form-label align-self-center">Partita IVA <span class="text-danger" aria-hidden="true">*</span></label>
                    <div>
                        <input type="tel" class="form-control" id="validationIVANum" name="PartitaIVA" required pattern="\d{7}[\s-]?\d{1}[\s-]?\d{3}" aria-describedby="invalid-feedback-IVA_num">
                        <div class="invalid-feedback" id="invalid-feedback-IVA_num">
                            Il numero della partita iva deve contenere 11 numeri, può essere suddiviso in gruppi da 7-1-3 cifre separate da 'spazio' o '-'
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <label for="validationPhoneNum" class="col-form-label form-label align-self-center">Numero di telefono <span class="text-danger" aria-hidden="true">*</span></label>
                    <div>
                        <input type="tel" class="form-control" id="validationPhoneNum" name="NumeroTelefono" required pattern="\d{3}[\s-]?\d{3}[\s-]?\d{4}" aria-describedby="invalid-feedback-phone_num">
                        <div class="invalid-feedback" id="invalid-feedback-phone_num">
                            Il numero di telefono deve contenere 10 numeri, può essere suddifivo in gruppi da 3-3-4 cifre separati da 'spazio' o '-'
                        </div>
                    </div>
                </div>
                <div class="col-12 vstack addr-form">
                    <div class="col-12">
                        <label for="validationAddr" class="col-form-label form-label">Indirizzo sede <span class="text-danger" aria-hidden="true">*</span></label>
                        <div>
                            <input type="text" class="form-control justify-self-center" id="validationAddr" placeholder="Via dell'Università 50" name="Ind_Via" required pattern="((V|v)ia|(V|v)iale|(C|c)orso|(P|p)iazza|(P|p)iazzale)\s[a-zA-Z\s'\.àì]+\s\d{1,3}[a-z]?" aria-describedby="invalid-feedback-addr">
                            <div class="invalid-feedback" id="invalid-feedback-addr">
                                Utilizzare 'spazio' per separare i campi; non sono ammessi caratteri speciali a parte l'apice semplice e il punto
                            </div>
                        </div>
                    </div>
                    <div class="col-12 d-flex flex-wrap">
                        <div class="flex-grow-1 w-50">
                            <label for="validationCity" class="col-form-label form-label">Città Provincia CAP <span class="text-danger" aria-hidden="true">*</span></label>
                            <div>
                                <input type="text" class="form-control" id="validationCity" placeholder="Cesena Forlì-Cesena  47521" name="Ind_Citta" required pattern="[a-zA-Z\-ì]+\s[a-zA-Z\-ì]+\s\d{5}" aria-describedby="invalid-feedback-city">
                                <div class="invalid-feedback" id="invalid-feedback-city">
                                    Il nome della citta e quello della provincia possono essere solo lettere, nel caso di nomi composti utilizzare il carattere '-' come separatore, mentre il CAP contiene solo 5 numeri
                                </div>
                            </div>
                        </div>
                        <div class="flex-grow-1">
                            <label for="validationCountry" class="col-form-label form-label">Paese <span class="text-danger" aria-hidden="true">*</span></label>
                            <div>
                                <input type="text" class="form-control" id="validationCountry" placeholder="Italia" name="Ind_Paese" required pattern="[a-zA-Z\s]+" aria-describedby="invalid-feedback-country">
                                <div class="invalid-feedback" id="invalid-feedback-country">
                                    Il nome del paese deve contenere solo lettere, nel caso di nome composto utilizzare 'spazio' per separare
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </fieldset>

            <fieldset class="col-12 vstack">
                <div class="col-12">
                    <label for="validationEmail" class="col-form-label form-label">Email <span class="text-danger" aria-hidden="true">*</span></label>
                    <div>
                        <input type="email" class="form-control" id="validationEmail" placeholder="esempio@gmail.com" name="Email" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" aria-describedby="invalid-feedback-email">
                        <div class="invalid-feedback" id="invalid-feedback-email">
                            L'indirizzo email deve seguire l'ordine: caratteri@caratteri.dominio; il dominio deve contenere almeno 2 lettere dalla 'a' alla 'z'
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <label for="validationPassword" class="col-form-label form-label">Password <span class="text-danger" aria-hidden="true">*</span></label>
                    <div>
                        <input class="form-control" type="password" id="validationPassword" name="Password" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" aria-describedby="invalid-feedback-password">
                        <div class="invalid-feedback" id="invalid-feedback-password">
                            La password deve contenere almeno un numero, una lettera maiuscola, una lettera minuscola, un carattere speciale, e deve essere almeno lunga 8 caratteri
                        </div>
                    </div>
                </div>
            </fieldset>
        </div>
        <p class="text-danger text-center m-0 mt-4 w-100" aria-hidden="true">i campi evidenziati sono obbligatori</p>
        <button class="col-4 col-lg-3 mt-4 btn btn-primary align-self-center" type="submit">Continue</button>
    </form>
</section>