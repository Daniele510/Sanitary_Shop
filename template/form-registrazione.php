<div class="row registration" id="registrazione-utente">
    <h1 class="col-6">REGISTRATI ORA!</h1>
    <form action="processa-modifiche.php?action=ins-new-utente" method="POST" class="col-10 col-md-9 needs-validation inputs" novalidate>
        <?php if(isset($_GET["err-msg"]) && $_GET["err-msg"]):?>
            <div class="col-10 err-msg d-flex justify-content-center">
            <p class="m-0 p-0" tabindex="-1"><?php echo $_GET["err-msg"];?></p>
        </div>
        <?php endif;?>
        <div class="row fields">
            <div class="row">
                <div class="row">
                    <label for="validationFullName" class="col-12 col-form-label form-label">Nome Completo</label>
                    <div class="col-12 input">
                        <input type="text" class="form-control" id="validationFullName" placeholder="Mario Rossi" name="NomeCompleto" required aria-describedby="invalid-feedback-name">
                        <div class="invalid-feedback" id="invalid-feedback-name">
                            <span aria-hidden="true">**</span>Completare il campo
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label for="validationPhoneNum" class="col-12 col-form-label form-label">Numero di telefono</label>
                    <div class="col-12 input">
                        <input type="tel" class="form-control" id="validationPhoneNum" name="NumeroTelefono" pattern="\d{3}[\s-]?\d{3}[\s-]?\d{4}" aria-describedby="invalid-feedback-phone_num">
                        <div class="invalid-feedback" id="invalid-feedback-phone_num">
                            <span aria-hidden="true">**</span>Il numero di telefono deve contenere 10 numeri, può essere suddifivo in gruppi da 3-3-4 cifre separati da 'spazio' o '-'
                        </div>
                    </div>
                </div>
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

            <div class="row addr-form">
                <div class="row">
                    <label for="validationDAddr" class="col-12 col-form-label form-label">Indirizzo di spedizione</label>
                    <div class="col-12 input">
                        <input class="form-control" type="text" name="Ind_Via" value="Via dell'Università 50 Cesena" readonly>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="row">
                    <label for="validationCard" class="col-12 col-form-label form-label">Codice carta</label>
                    <div class="col-12 input">
                        <input type="text" class="form-control" id="validationCard" name="CodCarta" pattern="\d{13,16}" required aria-describedby="invalid-feedback-cod_carta">
                        <div class="invalid-feedback" id="invalid-feedback-cod_carta">
                            <span aria-hidden="true">**</span>Inserire codice numerico composto dalle 13 alle 16 cifre
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label for="validationHolder" class="col-12 col-form-label form-label">Nome titolare carta</label>
                    <div class="col-12 input">
                        <input type="text" class="form-control" id="validationHolder" placeholder="Mario Rossi" name="NomeIntestatarioCarta" required pattern="[a-zA-z\s]+" aria-describedby="invalid-feedback-name">
                        <div class="invalid-feedback" id="invalid-feedback-name">
                            <span aria-hidden="true">**</span>Completare il campo
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label for="validationDate" class="col-12 col-form-label form-label">Data di scadenza carta</label>
                    <div class="col-12 input">
                        <input type="tel" class="form-control" id="validationDate" name="DataScadenza" required pattern="\d{2}\s\d{4}" aria-describedby="invalid-feedback-date">
                        <div class="invalid-feedback" id="invalid-feedback-date">
                            <span aria-hidden="true">**</span>Inserire prima il numero del mese e poi quello dell'anno; per separare mese e anno utilizzare spazio
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