<div class="row  d-flex justify-content-center">
    <div class="col-12 text-center" style="margin-top: 46px;">
        <h1 class="m-0" style="text-transform: capitalize;">modifica dati della carta</h1>
    </div>
    <form action="#" method="POST" class="col-10 col-md-9 needs-validation d-flex flex-column inputs" style="margin-top: 1.875rem;  padding-bottom: 2rem; padding-top: 1rem; border-radius: 10px; background: white; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);" novalidate>
        <div class="col-10 align-self-center d-none err-msg" style="margin: 2.75rem 0;">
            <p class="m-0 p-0" style="font-weight: lighter; font-style: italic; color: #C80000; font-size: small;" tabindex="-1">I campi evidenziati in rosso devono contenere valori validi</p>
        </div>
        <div class="row fields">
            <div class="row" style="gap: 21px;">
                <div class="row">
                    <label for="validationCodCarta" class="col-12 col-form-label form-label">Codice Carta</label>
                    <div class="col-12 input">
                        <input type="text" class="form-control" id="validationCodCarta" name="CodCarta" required>
                    </div>
                </div>
                <div class="row">
                    <label for="validationFullName" class="col-12 col-form-label form-label align-self-center">Nome Completo Intestatario</label>
                    <div class="col-12 input">
                        <input type="text" class="form-control" id="validationFullName" name="NomeIntestatarioCarta" required>
                    </div>
                </div>
                <div class="row">
                    <label for="validationDataScadenza" class="col-12 col-form-label form-label">Data Scadenza</label>
                    <div class="col-12 input">
                        <input type="date" class="form-control" id="validationDataScadenza" name="DataScadenza" required>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 d-flex justify-content-between" style="margin-top: 55px;">
            <a href="#" class="col-5">
                <button class="col-12 btn" style="background-color: white; border-radius: 10px; border: 3px solid #06ACB8; color: #06ACB8;">Annulla</button>
            </a>
            <button class="col-5 btn" type="submit" style="background-color: #06ACB8; border-radius: 10px; color: white;">Modifica</button>
        </div>
    </form>
</div>