<div class="row modify">
    <h1 class="col-6">Nuovo Prodotto</h1>
    <form action="./processa-modifiche.php" method="POST" enctype="multipart/form-data" class="col-10 col-md-9 needs-validation d-flex flex-column inputs" novalidate>
        <div class="col-10 err-msg">
            <p class="m-0 p-0" tabindex="-1">I campi evidenziati in rosso devono contenere valori validi</p>
        </div>
        <div class="row fields">
            <div class="row">
                <div class="row">
                    <label for="validationCodeProduct" class="col-12 col-form-label form-label">Codice Prodotto</label>
                    <div class="col-12 input">
                        <input type="text" class="form-control" id="validationCodeProduct" name="CodProdotto" required>
                    </div>
                </div>
                <div class="row">
                    <label for="validationProductName" class="col-12 col-form-label form-label">Nome Prodotto</label>
                    <div class="col-12 input">
                        <input type="text" class="form-control" id="validationProductName" name="NomeProdotto" required>
                    </div>
                </div>
                <div class="row form-group">
                    <label for="validationDescriprion" class="col-12 col-form-label form-label align-self-center">Descrizione</label>
                    <div class="input">
                        <textarea class="form-control" id="validationDescriprion" rows="3" name="Descrizione" required></textarea>
                    </div>
                </div>
                <div class="row">
                    <label for="formFile" class="form-label">Immagine</label>
                    <div class="col-12">
                        <input class="form-control" type="file" id="formFile" name="Immagine" required>
                    </div>
                </div>
                <div class="row justify-content-between price">
                    <div class="col-6 col-md-12">
                        <label for="validationPrice" class="col-form-label form-label">Prezzo</label>
                        <div class="input">
                            <input type="text" class="form-control" id="validationPrice" name="Prezzo" required>
                        </div>
                    </div>
                    <div class="col-5 col-md-12">
                        <label for="validationDiscount" class="col-form-label form-label">Sconto</label>
                        <div class="input">
                            <input type="text" class="form-control" id="validationDiscount" name="Sconto">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label for="exampleDataList" class="form-label">Codice Categoria</label>
                    <div class="col-12">
                        <select class="form-select" list="datalistOptions" id="exampleDataList" name="CodCategoria">
                            <datalist id="datalistOptions">
                                <?php foreach ($templateParams["categorie"] as $categoria) : ?>
                                    <option><?php echo $categoria["CodCategoria"]; ?></option>
                                <?php endforeach; ?>
                            </datalist>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <label for="validationMaxQta" class="col-12 col-form-label form-label">Massima Quantità In Magazzino</label>
                    <div class="col-12 input">
                        <input type="text" class="form-control" id="validationMaxQta" name="MaxQta" required>
                    </div>
                </div>
                <div class="row form-switch align-items-center">
                    <input class="form-check-input me-3" type="checkbox" role="switch" id="flexSwitchCheckChecked" name="InVendita" checked>
                    <label class="col-8 form-check-label" for="flexSwitchCheckChecked">Inserimento nel catalogo vendita</label>
                </div>
            </div>
        </div>
        <button class="col-4 col-lg-3 btn primary" type="submit">Continue</button>
    </form>
</div>