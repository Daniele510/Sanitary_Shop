<div class="row  d-flex justify-content-center">
    <div class="col-12 text-center" style="margin: 45px 0;">
        <h1 class="m-0" style="text-transform: capitalize;">modifica info compagnia</h1>
    </div>
    <form action="./processa-modifiche.php" method="POST" class="col-10 col-md-9 needs-validation d-flex flex-column inputs" novalidate>
    <div class="col-10 err-msg d-none">
            <p class="m-0 p-0" tabindex="-1">I campi evidenziati in rosso devono contenere valori validi</p>
        </div>
        <?php if (isset($_GET["err-msg"])) : ?>
            <div class="col-10 err-msg">
                <p class="m-0 p-0 text-center" tabindex="-1"><?php echo $_GET["err-msg"]; ?></p>
            </div>
        <?php endif; ?>
        <div class="row fields" style="gap: 55px;">
            <div class="row">
                <div class="row">
                    <label for="validationCompanyName" class="col-12 col-form-label form-label">Nome Compangia</label>
                    <div class="col-12 input">
                        <input type="text" class="form-control" id="validationCompanyName" value="<?php echo $templateParams["info-azienda"]["NomeCompagnia"]; ?>" name="NomeCompagnia" required>
                    </div>
                </div>
                <div class="row">
                    <label for="validationPhoneNum" class="col-12 col-form-label form-label align-self-center">Numero di telefono</label>
                    <div class="col-12 input">
                        <input type="text" class="form-control" id="validationPhoneNum" name="NumeroTelefono" value="<?php echo $templateParams["info-azienda"]["NumeroTelefono"]; ?>" required>
                    </div>
                </div>
            </div>
            <div class="row addr-form">
                <div class="row">
                    <label for="validationDAddr" class="col-12 col-form-label form-label">Indirizzo sede</label>
                    <div class="col-12 input">
                        <input type="text" class="form-control justify-self-center" id="validationDAddr" value="<?php echo $templateParams["info-azienda"]["Ind_Via"]; ?>" name="Ind_Via" required>
                    </div>
                </div>
                <div class="row" style="display: flex; gap: 21px; flex-wrap: wrap;">
                    <div style="width: auto; flex-grow: 1;">
                        <label for="validationCity" class="col-form-label form-label">Città Provincia CAP</label>
                        <div class="input">
                            <input type="text" class="form-control" id="validationCity" value="<?php echo $templateParams["info-azienda"]["Ind_Citta"]; ?>" name="Ind_Citta" required>
                        </div>
                    </div>
                    <div style="flex-grow: 1;">
                        <label for="validationCountry" class="col-form-label form-label">Paese</label>
                        <div class="input">
                            <input type="text" class="form-control" id="validationCountry" value="<?php echo $templateParams["info-azienda"]["Ind_Paese"]; ?>" name="Ind_Paese" required>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 d-flex justify-content-between" style="margin-top: 55px;">
            <a href="login.php?action=gohome" class="col-5 btn outline_secondary">Annulla</a>
            <button class="col-5 btn primary" type="submit" name="submit-mod-info-azienda">Modifica</button>
        </div>
    </form>
</div>