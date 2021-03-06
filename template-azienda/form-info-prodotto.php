<?php
$prodotto = isset($templateParams["prodotto"]) ? $templateParams["prodotto"] : NULL;
$action = $templateParams["action"];
?>

<section class="row modify gap-3">
    <header class="col-12 text-center p-0">
        <h1 class="m-0">Nuovo Prodotto</h1>
    </header>
    <form action="./processa-modifiche.php?action=<?php echo $action; ?>" method="POST" enctype="multipart/form-data" class="col-10 px-3 col-md-8 col-lg-6 needs-validation needs-confermation white-column-container inputs" novalidate>
        <?php if (isset($_GET["err-msg"])) : ?>
            <div class="col-10 err-msg">
                <p class="m-0 p-0 text-center" tabindex="-1"><?php echo $_GET["err-msg"]; ?></p>
            </div>
        <?php endif; ?>
        <div class="col-12 vstack fields p-0">
            <fieldset class="col-12 vstack">
                <div class="col-12">
                    <label for="validationCodeProduct" class="col-form-label form-label">Codice Prodotto <span class="text-danger" aria-hidden="true">*</span></label>
                    <div>
                        <input type="tel" class="form-control" id="validationCodeProduct" name="CodProdotto" <?php echo (isset($prodotto) ? 'value="' . $prodotto["CodProdotto"] . '"' : ""); ?> pattern="\d{1,10}[\s-]?" required aria-labelledby="invalid-feedback-cod_podotto" <?php echo ($action == "mod-info-prod" ? "readonly" : ""); ?>>
                        <div class="invalid-feedback" id="invalid-feedback-cod_podotto">
                            Il codice del prodotto ammette solo 10 valori numerici, è possibile suddividerlo usando 'spazio' o '-'
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <label for="validationProductName" class="col-form-label form-label">Nome Prodotto <span class="text-danger" aria-hidden="true">*</span></label>
                    <div>
                        <input type="text" class="form-control" id="validationProductName" name="NomeProdotto" <?php echo (isset($prodotto) ? 'value="' . $prodotto["NomeProdotto"] . '"' : ""); ?> pattern="\S+.*" required aria-labelledby="invalid-feedback-name" <?php echo ($action == "mod-info-prod" ? "readonly" : ""); ?>>
                        <div class="invalid-feedback" id="invalid-feedback-name">
                            Completa il campo
                        </div>
                    </div>
                </div>
                <div class="col-12 form-group">
                    <label for="validationDescriprion" class="col-form-label form-label align-self-center">Descrizione <span class="text-danger" aria-hidden="true">*</span></label>
                    <div>
                        <textarea class="form-control" id="validationDescriprion" rows="3" name="Descrizione" required aria-labelledby="invalid-feedback-descr"><?php echo (isset($prodotto) ? $prodotto["Descrizione"] : ""); ?></textarea>
                        <div class="invalid-feedback" id="invalid-feedback-descr">
                            Completa il campo
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <label for="formFile" class="form-label">Immagine <?php echo (!isset($prodotto) ? '<span class="text-danger" aria-hidden="true">*</span>' : ""); ?></label>
                    <div>
                        <input class="form-control" type="file" accept="image/*" id="formFile" name="Immagine" <?php echo (!isset($prodotto) ? 'required' : ""); ?> aria-labelledby="invalid-feedback-img">
                        <div class="invalid-feedback" id="invalid-feedback-img">
                            Inserire un'immagine
                        </div>
                    </div>
                </div>
                <div class="col-12 d-flex flex-wrap justify-content-between price">
                    <div class="col-6 col-md-12">
                        <label for="validationPrice" class="col-form-label form-label">Prezzo <span class="text-danger" aria-hidden="true">*</span></label>
                        <div>
                            <input type="number" class="form-control" id="validationPrice" name="Prezzo" <?php echo (isset($prodotto) ? 'value="' . $prodotto["PrezzoUnitario"] . '"' : ""); ?> step="0.01" min="1" max="9999.99" required aria-labelledby="invalid-feedback-price">
                            <div class="invalid-feedback" id="invalid-feedback-price">
                                Inserire un numero positivo
                            </div>
                        </div>
                    </div>
                    <div class="col-5 col-md-12">
                        <label for="validationDiscount" class="col-form-label form-label">Sconto</label>
                        <div>
                            <input type="number" class="form-control" id="validationDiscount" name="Sconto" <?php echo (isset($prodotto) ? 'value="' . $prodotto["Sconto"] . '"' : ""); ?> min="0" max="100" aria-labelledby="invalid-feedback-discount">
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
                            <?php if (isset($templateParams["categorie"])) :
                                foreach ($templateParams["categorie"] as $categoria) : ?>
                                    <option <?php echo (isset($prodotto) && $categoria["CodCategoria"] == $prodotto["CodCategoria"] ? "selected" : ""); ?>><?php echo $categoria["CodCategoria"]; ?></option>
                            <?php endforeach;
                            endif; ?>
                        </select>
                    </div>
                </div>
                <div class="col-12">
                    <label for="validationMaxQta" class="col-form-label form-label">Massima Quantità In Magazzino <span class="text-danger" aria-hidden="true">*</span></label>
                    <div>
                        <input type="number" class="form-control" id="validationMaxQta" name="MaxQta" <?php echo (isset($prodotto) ? 'value="' . $prodotto["QtaInMagazzino"] . '"' : ""); ?> min="1" required aria-labelledby="invalid-feedback-max_qta">
                        <div class="invalid-feedback" id="invalid-feedback-max_qta">
                            Inserire un numero positivo
                        </div>
                    </div>
                </div>
                <div class="col-12 d-flex form-switch align-items-center">
                    <input class="form-check-input me-3" type="checkbox" role="switch" id="flexSwitchCheckChecked" name="InVendita" <?php echo (isset($prodotto) && $prodotto["InVendita"] == 0) ? "" : "checked"; ?>>
                    <label class="col-8 form-check-label" for="flexSwitchCheckChecked">Inserimento nel catalogo vendita</label>
                </div>
            </fieldset>
        </div>
        <p class="text-danger m-0 mt-4 text-center w-100" aria-hidden="true">i campi evidenziati sono obbligatori</p>
        <?php if ($action == "ins-new-prod") : ?>
            <button class="col-4 col-lg-3 mt-4 btn btn-primary align-self-center" type="submit">Continue</button>
        <?php else : ?>
            <div class="col-12 mt-4 d-flex justify-content-between gap-3 flex-wrap text-center">
                <a href="prodotto.php?id=<?php echo $prodotto["CodProdotto"]; ?>" class="col-5 btn btn-outline-secondary">Annulla</a>
                <button class="col-5 btn btn-primary" type="submit">Modifica</button>
            </div>
        <?php endif; ?>
    </form>
    <?php require "../template/conferma-form-modal.php"; ?>
</section>