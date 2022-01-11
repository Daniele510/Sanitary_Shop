<div class="row  d-flex justify-content-center">
    <div class="col-12 text-center" style="margin: 45px 0;">
        <h1 class="m-0" style="text-transform: capitalize;">modifica dati della carta</h1>
    </div>
    <form action="processa-modifiche.php" method="POST" enctype="multipart/form-data" class="col-10 col-md-9 needs-validation d-flex flex-column inputs" novalidate>
        <div class="col-10 align-self-center d-none err-msg" style="margin: 2.75rem 0;">
            <p class="m-0 p-0" style="font-weight: lighter; font-style: italic; color: #C80000; font-size: small;" tabindex="-1">I campi evidenziati in rosso devono contenere valori validi</p>
        </div>
        <div class="row fields">
            <div class="row">
                <div class="row">
                    <label for="validationCodCarta" class="col-12 col-form-label form-label">Codice Carta</label>
                    <div class="col-12 input">
                        <input type="text" class="form-control" id="validationCodCarta" name="CodCarta" value="<?php echo $templateParams["info-cart"][0]["CodCarta"]; ?>" required>
                    </div>
                </div>
                <div class="row">
                    <label for="validationFullName" class="col-12 col-form-label form-label align-self-center">Nome Completo Intestatario</label>
                    <div class="col-12 input">
                        <input type="text" class="form-control" id="validationFullName" name="NomeIntestatarioCarta" value="<?php echo $templateParams["info-cart"][0]["NomeIntestatario"]; ?>" required>
                    </div>
                </div>
                <div class="row">
                    <label for="validationDataScadenza" class="col-12 col-form-label form-label">Data Scadenza</label>
                    <div class="col-12 input">
                        <input type="date" class="form-control" id="validationDataScadenza" name="DataScadenza" value="<?php echo $templateParams["info-cart"][0]["DataScadenza"]; ?>" required>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 d-flex justify-content-between" style="margin-top: 55px;">
            <a href="user-login.php" class="col-5 btn outline_secondary">
                Annulla
            </a>
            <button class="col-5 btn primary" type="submit" name="submit-mod-info-carta">Modifica</button>
        </div>
    </form>
</div>