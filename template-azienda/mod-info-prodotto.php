<div class="row modify">
    <h1 class="col-6">Nuovo Prodotto</h1>
    <form action="./processa-modifiche.php?action=ins-new-prod" method="POST" enctype="multipart/form-data" class="col-10 col-md-9 needs-validation d-flex flex-column inputs" novalidate>
        <?php if (isset($_GET["err-msg"])) : ?>
            <div class="col-10 err-msg">
                <p class="m-0 p-0 text-center" tabindex="-1"><?php echo $_GET["err-msg"]; ?></p>
            </div>
        <?php endif; ?>
        <div class="row fields">
            <div class="row">
                <div class="row">
                    <label for="validationCodeProduct" class="col-12 col-form-label form-label">Codice Prodotto <span class="text-danger" aria-hidden="true">*</span></label>
                    <div class="col-12 input">
                        <input type="tel" class="form-control" id="validationCodeProduct" name="CodProdotto" value="<?php echo $templateParams["CodProdotto"]; ?>"  pattern="\d{1,10}[\s-]?" aria-labelledby="invalid-feedback-cod_podotto" readonly>
                        <div class="invalid-feedback" id="invalid-feedback-cod_podotto">
                            Il codice del prodotto ammette solo 10 valori numerici, con la possibiltà di suddividerlo usando 'spazio' o '-' per separare i possibili sottogruppi gruppi
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label for="validationProductName" class="col-12 col-form-label form-label">Nome Prodotto <span class="text-danger" aria-hidden="true">*</span></label>
                    <div class="col-12 input">
                        <input type="text" class="form-control" id="validationProductName" name="NomeProdotto" value="<?php echo $templateParams["NomeProdotto"]; ?>" aria-labelledby="invalid-feedback-name" readonly>
                        <div class="invalid-feedback" id="invalid-feedback-name">
                            Completa il campo
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <label for="validationDescriprion" class="col-12 col-form-label form-label align-self-center">Descrizione <span class="text-danger" aria-hidden="true">*</span></label>
                    <div class="input">
                        <textarea class="form-control" id="validationDescriprion" rows="3" name="Descrizione" value="<?php echo $templateParams["Descrizione"]; ?>" required aria-labelledby="invalid-feedback-descr"></textarea>
                        <div class="invalid-feedback" id="invalid-feedback-descr">
                            Completa il campo
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label for="formFile" class="form-label">Immagine <span class="text-danger" aria-hidden="true">*</span></label>
                    <div class="col-12">
                        <input class="form-control" type="file" accept="image/*" id="formFile" name="Immagine" value="<?php echo explode("/",$templateParams["ImgPath"])[1]; ?>" required aria-labelledby="invalid-feedback-img">
                        <div class="invalid-feedback" id="invalid-feedback-img">
                            Inserire un'immagine
                        </div>
                    </div>
                </div>
                <div class="row justify-content-between price">
                    <div class="col-6 col-md-12">
                        <label for="validationPrice" class="col-form-label form-label">Prezzo <span class="text-danger" aria-hidden="true">*</span></label>
                        <div class="input">
                            <input type="number" class="form-control" id="validationPrice" name="Prezzo" value="<?php echo $templateParams["PrezzoUnitario"]; ?>" pattern="\d{1,6}" step="0.01" min="1" required aria-labelledby="invalid-feedback-price">
                            <div class="invalid-feedback" id="invalid-feedback-price">
                                Inserire un numero positivo
                            </div>
                        </div>
                    </div>
                    <div class="col-5 col-md-12">
                        <label for="validationDiscount" class="col-form-label form-label">Sconto</label>
                        <div class="input">
                            <input type="number" class="form-control" id="validationDiscount" name="Sconto" value="<?php echo $templateParams["Sconto"]; ?>" min="0" max="100" aria-labelledby="invalid-feedback-discount">
                            <div class="invalid-feedback" id="invalid-feedback-discount">
                                Inserire un numero positivo oppure lasciare il campo vuoto
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label for="exampleDataList" class="form-label">Codice Categoria <span class="text-danger" aria-hidden="true">*</span></label>
                    <div class="col-12">
                        <input class="form-control" id="exampleDataList" name="CodCategoria" value="<?php echo $templateParams["CodCategoria"]; ?>">
                    </div>
                </div>
                <div class="row">
                    <label for="validationMaxQta" class="col-12 col-form-label form-label">Massima Quantità In Magazzino <span class="text-danger" aria-hidden="true">*</span></label>
                    <div class="col-12 input">
                        <input type="number" class="form-control" id="validationMaxQta" name="MaxQta" value="<?php echo $templateParams["QtaInMagazzino"]; ?>" min="1" required aria-labelledby="invalid-feedback-max_qta">
                        <div class="invalid-feedback" id="invalid-feedback-max_qta">
                            Inserire un numero positivo
                        </div>
                    </div>
                </div>
                <div class="row form-switch align-items-center">
                    <input class="form-check-input me-3" type="checkbox" role="switch" id="flexSwitchCheckChecked" name="InVendita" <?php echo ($templateParams["InVendita"]==0) ? "" : "checked"; ?>>
                    <label class="col-8 form-check-label" for="flexSwitchCheckChecked">Inserimento nel catalogo vendita</label>
                </div>
            </div>
        </div>
        <div class="text-danger text-center mt-5">i campi evidenziati sono obbligatori</div>
        <button class="col-4 col-lg-3 btn primary" type="submit">Continue</button>
    </form>
    <?php require "../template/conferma-form-modal.php"; ?>
</div>