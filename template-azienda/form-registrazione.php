<div class="row registration" id="registrazione-azienda">
    <h1 class="col-6">REGISTRATI ORA!</h1>
    <form action="./area-aziende/processa-modifiche.php?action=ins-new-azienda" method="POST" class="col-10 col-md-9 inputs needs-validation" novalidate>
        <?php if(isset($_GET["err-msg"]) && $_GET["err-msg"]):?>
            <div class="col-10 err-msg d-flex justify-content-center">
            <p class="m-0 p-0" tabindex="-1"><?php echo $_GET["err-msg"];?></p>
        </div>
        <?php endif;?>
        <div class="row fields">
            <div class="row">
                <div class="row">
                    <label for="validationCompanyName" class="col-12 col-form-label form-label align-self-center">Nome Compagnia</label>
                    <div class="col-12 input">
                        <input type="text" class="form-control" id="validationCompanyName" name="NomeCompagnia" required aria-describedby="invalid-feedback-company_name">
                        <div class="invalid-feedback" id="invalid-feedback-company_name">
                            <span aria-hidden="true">**</span>Completare il campo
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label for="validationIVANum" class="col-12 col-form-label form-label align-self-center">Partita IVA</label>
                    <div class="col-12 input">
                        <input type="tel" class="form-control" id="validationIVANum" name="PartitaIVA" required pattern="\d{7}[\s-]?\d{1}[\s-]?\d{3}" aria-describedby="invalid-feedback-IVA_num">
                        <div class="invalid-feedback" id="invalid-feedback-IVA_num">
                            <span aria-hidden="true">**</span>Il numero della partita iva deve contentere 11 numeri, può essere suddiviso in gruppi da 7-1-3 cifre separate da 'spazio' o '-'
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label for="validationPhoneNum" class="col-12 col-form-label form-label align-self-center">Numero di telefono</label>
                    <div class="col-12 input">
                        <input type="tel" class="form-control" id="validationPhoneNum" name="NumeroTelefono" required pattern="\d{3}[\s-]?\d{3}[\s-]?\d{4}" aria-describedby="invalid-feedback-phone_num">
                        <div class="invalid-feedback" id="invalid-feedback-phone_num">
                            <span aria-hidden="true">**</span>Il numero di telefono deve contenere 10 numeri, può essere suddifivo in gruppi da 3-3-4 cifre separati da 'spazio' o '-'
                        </div>
                    </div>
                </div>
                <div class="row addr-form">
                    <div class="row">
                        <label for="validationAddr" class="col-12 col-form-label form-label">Indirizzo sede</label>
                        <div class="col-12 input">
                            <input type="text" class="form-control justify-self-center" id="validationAddr" placeholder="Via dell'Università 50" name="Ind_Via" required pattern="((V|v)ia|(V|v)iale|(C|c)orso|(P|p)iazza|(P|p)iazzale)\s[a-zA-Z\s'\.àì]+\s\d{1,3}[a-z]?" aria-describedby="invalid-feedback-addr">
                            <div class="invalid-feedback" id="invalid-feedback-addr">
                                <span aria-hidden="true">**</span>Utilizzare 'spazio' per separare i campi; non sono ammessi caratteri speciali a parte l'apice semplice e il punto
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div>
                            <label for="validationCity" class="col-form-label form-label">Città Provincia CAP</label>
                            <div class="input">
                                <input type="text" class="form-control" id="validationCity" placeholder="Cesena Forlì-Cesena  47521" name="Ind_Citta" required pattern="[a-zA-Z\-ì]+\s[a-zA-Z\-ì]+\s\d{5}" aria-describedby="invalid-feedback-city">
                                <div class="invalid-feedback" id="invalid-feedback-city">
                                    <span aria-hidden="true">**</span>Il nome della citta e quello della provincia possono essere solo lettere, nel caso di nomi composti utilizzare il carattere '-' come separatore, mentre il CAP contiene solo 5 numeri
                                </div>
                            </div>
                        </div>
                        <div>
                            <label for="validationCountry" class="col-form-label form-label">Paese</label>
                            <div class="input">
                                <input type="text" class="form-control" id="validationCountry" placeholder="Italia" name="Ind_Paese" required pattern="[a-zA-Z\s]+" aria-describedby="invalid-feedback-country">
                                <div class="invalid-feedback" id="invalid-feedback-country">
                                    <span aria-hidden="true">**</span>Il nome del paese deve contenere solo lettere, nel caso di nome composto utilizzare 'spazio' per separare
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="row">
                    <label for="validationEmail" class="col-12 col-form-label form-label">Email</label>
                    <div class="col-12 input">
                        <input type="email" class="form-control" id="validationEmail" placeholder="esempio@gmail.com" name="Email" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" aria-describedby="invalid-feedback-email">
                        <div class="invalid-feedback" id="invalid-feedback-email">
                            <span aria-hidden="true">**</span>L'indirizzo email deve seguire l'ordine: caratteri@caratteri.dominio; il dominio deve contenere almeno 2 lettere dalla 'a' alla 'z'
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label for="validationPassword" class="col-12 col-form-label form-label">Password</label>
                    <div class="col-12 input">
                        <input class="form-control" type="password" id="validationPassword" name="Password" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" aria-describedby="invalid-feedback-password">
                        <div class="invalid-feedback" id="invalid-feedback-password">
                            <span aria-hidden="true">**</span>La password deve contenere almeno un numero, una lettera maiuscola, una lettera minuscola, un carattere speciale, e deve essere almeno lunga 8 caratteri
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-4 col-lg-3">
            <button class="col-12 btn primary" type="submit">Continue</button>
        </div>
    </form>
</div>