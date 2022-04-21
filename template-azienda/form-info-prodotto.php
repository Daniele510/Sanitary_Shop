<?php 
    $prodotto = $templateParams["prodotto"];
    $action = $templateParams["action"];
?>

<section class="row modify gap-3">
    <header class="col-12 text-center p-0">
        <h1 class="m-0">Nuovo Prodotto</h1>
    </header>
    <form action="./processa-modifiche.php?action=<?php echo $action; ?>" method="POST" enctype="multipart/form-data" class="col-10 px-3 col-md-9 needs-validation white-column-container inputs" novalidate>
        <?php if (isset($_GET["err-msg"])) : ?>
            <div class="col-10 err-msg">
                <p class="m-0 p-0 text-center" tabindex="-1"><?php echo $_GET["err-msg"]; ?></p>
            </div>
        <?php endif; ?>
        <div class="col-12 vstack fields p-0">
            <fieldset class="col-12 vstack">
                <div class="col-12">
                    <label for="validationCodeProduct" class="col-form-label form-label">Codice Prodotto <span class="text-danger" aria-hidden="true">*</span></label>
                    <div class="input">
                        <input type="tel" class="form-control" id="validationCodeProduct" name="CodProdotto" value="<?php echo (isset($prodotto) ? $prodotto["CodProdotto"] : ""); ?>"  pattern="\d{1,10}[\s-]?" required aria-labelledby="invalid-feedback-cod_podotto" <?php echo ($action == "mod-info-prod" ? "readonly" : ""); ?>>
                        <div class="invalid-feedback" id="invalid-feedback-cod_podotto">
                            Il codice del prodotto ammette solo 10 valori numerici, con la possibiltà di suddividerlo usando 'spazio' o '-' per separare i possibili sottogruppi gruppi
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <label for="validationProductName" class="col-form-label form-label">Nome Prodotto <span class="text-danger" aria-hidden="true">*</span></label>
                    <div class="input">
                        <input type="text" class="form-control" id="validationProductName" name="NomeProdotto" value="<?php echo (isset($prodotto) ? $prodotto["NomeProdotto"] : ""); ?>" required aria-labelledby="invalid-feedback-name" <?php echo ($action == "mod-info-prod" ? "readonly" : ""); ?>>
                        <div class="invalid-feedback" id="invalid-feedback-name">
                            Completa il campo
                        </div>
                    </div>
                </div>
                <div class="col-12 form-group">
                    <label for="validationDescriprion" class="col-form-label form-label align-self-center">Descrizione <span class="text-danger" aria-hidden="true">*</span></label>
                    <div class="input">
                        <textarea class="form-control" id="validationDescriprion" rows="3" name="Descrizione" value="<?php echo (isset($prodotto) ? $prodotto["Descrizione"] : ""); ?>" required aria-labelledby="invalid-feedback-descr"></textarea>
                        <div class="invalid-feedback" id="invalid-feedback-descr">
                            Completa il campo
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <label for="formFile" class="form-label">Immagine <span class="text-danger" aria-hidden="true">*</span></label>
                    <div>
                        <input class="form-control" type="file" accept="image/*" id="formFile" name="Immagine" value="<?php echo (isset($prodotto) ? implode("/", $prodotto["ImgPath"])[1] : ""); ?>" required aria-labelledby="invalid-feedback-img">
                        <div class="invalid-feedback" id="invalid-feedback-img">
                            Inserire un'immagine
                        </div>
                    </div>
                </div>
                <div class="col-12 d-flex flex-wrap justify-content-between price">
                    <div class="col-6 col-md-12">
                        <label for="validationPrice" class="col-form-label form-label">Prezzo <span class="text-danger" aria-hidden="true">*</span></label>
                        <div class="input">
                            <input type="number" class="form-control" id="validationPrice" name="Prezzo" value="<?php echo (isset($prodotto) ? $prodotto["PrezzoUnitario"] : ""); ?>" step="0.01" min="1" max="9999.99" required aria-labelledby="invalid-feedback-price">
                            <div class="invalid-feedback" id="invalid-feedback-price">
                                Inserire un numero positivo
                            </div>
                        </div>
                    </div>
                    <div class="col-5 col-md-12">
                        <label for="validationDiscount" class="col-form-label form-label">Sconto</label>
                        <div class="input">
                            <input type="number" class="form-control" id="validationDiscount" name="Sconto" value="<?php echo (isset($prodotto) ? $prodotto["Sconto"] : ""); ?>" min="0" max="100" aria-labelledby="invalid-feedback-discount">
                            <div class="invalid-feedback" id="invalid-feedback-discount">
                                Inserire un numero positivo oppure lasciare il campo vuoto
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <label for="exampleDataList" class="form-label">Codice Categoria <span class="text-danger" aria-hidden="true">*</span></label>
                    <div>
                        <select class="form-select" aria-label="Default select example" id="exampleDataList" name="CodCategoria">
                            <?php foreach ($templateParams["categorie"] as $categoria) : ?>
                                <option <?php echo (isset($prodotto) && $categoria["CodCategoria"] == $prodotto["CodCategoria"] ? "selected" : ""); ?>><?php echo $categoria["CodCategoria"]; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-12">
                    <label for="validationMaxQta" class="col-form-label form-label">Massima Quantità In Magazzino <span class="text-danger" aria-hidden="true">*</span></label>
                    <div class="input">
                        <input type="number" class="form-control" id="validationMaxQta" name="MaxQta" value="<?php echo (isset($prodotto) ? $prodotto["QtaInMagazzino"] : ""); ?>" min="1" required aria-labelledby="invalid-feedback-max_qta">
                        <div class="invalid-feedback" id="invalid-feedback-max_qta">
                            Inserire un numero positivo
                        </div>
                    </div>
                </div>
                <div class="col-12 d-flex form-switch align-items-center">
                    <input class="form-check-input me-3" type="checkbox" role="switch" id="flexSwitchCheckChecked" name="InVendita" <?php echo ($templateParams["InVendita"]==0) ? "" : "checked"; ?>>
                    <label class="col-8 form-check-label" for="flexSwitchCheckChecked">Inserimento nel catalogo vendita</label>
                </div>
            </fieldset>
        </div>
        <div class="text-danger text-center mt-5">i campi evidenziati sono obbligatori</div>
        <button class="col-4 col-lg-3 mt-4 btn btn-primary align-self-center" type="submit">Continue</button>
    </form>
    <?php require "../template/conferma-form-modal.php"; ?>
</section>