<section class="row p-0 m-0 justify-content-center">
    <div class="col-10 col-md-11 p-0 d-flex flex-column gap-4 flex-md-row-reverse justify-content-md-between gap-md-5">
        <aside class="col-md-4">
            <div class="d-flex justify-content-end flex-md-column align-items-md-end justify-content-md-start">
                <!-- filtri ricerca -->
                <div class="filter-container transform d-flex justify-content-end col-md-12 flex-md-column justify-content-md-start">
                    <?php if (!empty($templateParams["prodotti"])) : ?>
                        <button class="btn btn-settings d-md-none">
                            <img src="<?php echo ICON_DIR . "settings.svg"; ?>" alt="bottone da cliccare per aprire i filtri di ricerca" />
                        </button>
                        <ul class="d-md-flex flex-md-column pt-md-3 gap-3">
                            <li>
                                <h3>Filtra per</h3>
                                <ul class="ps-2 d-flex flex-column gap-2">
                                    <li>
                                        <h4>categoria</h4>
                                        <ul>
                                            <?php for ($i = 0; $i < count($templateParams["categorie"]); $i++) :
                                                $categoria = $templateParams["categorie"][$i]; ?>
                                                <li>
                                                    <?php $res = isSelected("NomeCategoria[]", $categoria); ?>
                                                    <input class="form-check-input <?php echo ($res ? "filter-active" : ""); ?>" type="checkbox" id="check_categoria_<?php echo $i; ?>" name="NomeCategoria[]" value="<?php echo $templateParams["categorie"][$i]; ?>">
                                                    <label class="form-check-label" for="check_categoria_<?php echo $i; ?>">
                                                        <?php echo $categoria; ?>
                                                    </label>
                                                </li>
                                            <?php endfor; ?>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <h3>Ordina per</h3>
                                <ul class="ps-2">
                                    <li>
                                        <?php $res = isSelected("Order", "Prezzo"); ?>
                                        <input class="form-check-input <?php echo ($res ? "filter-active " : ""); ?>" type="radio" name="Order" value="Prezzo" id="order_price_up" <?php echo ($res ? "cheched" : ""); ?>>
                                        <label class="form-check-label" for="order_price_up">
                                            prezzo crescente
                                        </label>
                                    </li>
                                    <li>
                                        <?php $res = isSelected("Order", "Prezzo DESC"); ?>
                                        <input class="form-check-input <?php echo ($res ? "filter-active " : ""); ?>" type="radio" name="Order" value="Prezzo DESC" id="order_price_down" <?php echo ($res ? "cheched" : ""); ?>>
                                        <label class="form-check-label" for="order_price_down">
                                            prezzo decrescente
                                        </label>
                                    </li>
                                    <li>
                                        <?php $res = isSelected("Order", "Sconto DESC"); ?>
                                        <input class="form-check-input <?php echo ($res ? "filter-active " : ""); ?>" type="radio" name="Order" value="Sconto DESC" id="order_discount" <?php echo ($res ? "cheched" : ""); ?>>
                                        <label class="form-check-label" for="order_discount">
                                            sconto
                                        </label>
                                    </li>
                                    <li>
                                        <?php $res = isSelected("Order", "NomeProdotto"); ?>
                                        <input class="form-check-input <?php echo ($res ? "filter-active " : ""); ?>" type="radio" name="Order" value="NomeProdotto" id="order_name" <?php echo ($res ? "cheched" : ""); ?>>
                                        <label class="form-check-label" for="order_name">
                                            nome prodotto
                                        </label>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <button type="button" class="btn btn-outline-danger">Salva modifiche</button>
                            </li>
                        </ul>
                    <?php else : ?>
                        <button class="btn btn-settings d-md-none" disabled>
                            <img src="<?php echo ICON_DIR . "settings.svg"; ?>" alt="impostazioni ricerca" />
                        </button>
                        <ul class="d-md-flex flex-column pt-md-3 gap-3">
                            <li>
                                <h3>Filtra per</h3>
                            </li>
                            <li>
                                <h3>Ordina per</h3>
                                <ul class="ps-2">
                                    <li>
                                        <?php $res = isSelected("Order", "Prezzo"); ?>
                                        <input class="form-check-input <?php echo ($res ? "filter-active " : ""); ?>" type="radio" name="Order" value="Prezzo" id="order_price_up" <?php echo ($res ? "cheched" : ""); ?> disabled>
                                        <label class="form-check-label" for="order_price_up">
                                            prezzo crescente
                                        </label>
                                    </li>
                                    <li>
                                        <?php $res = isSelected("Order", "Prezzo DESC"); ?>
                                        <input class="form-check-input <?php echo ($res ? "filter-active " : ""); ?>" type="radio" name="Order" value="Prezzo DESC" id="order_price_down" <?php echo ($res ? "cheched" : ""); ?> disabled>
                                        <label class="form-check-label" for="order_price_down">
                                            prezzo decrescente
                                        </label>
                                    </li>
                                    <li>
                                        <?php $res = isSelected("Order", "Sconto DESC"); ?>
                                        <input class="form-check-input <?php echo ($res ? "filter-active " : ""); ?>" type="radio" name="Order" value="Sconto DESC" id="order_discount" <?php echo ($res ? "cheched" : ""); ?> disabled>
                                        <label class="form-check-label" for="order_discount">
                                            sconto
                                        </label>
                                    </li>
                                    <li>
                                        <?php $res = isSelected("Order", "NomeProdotto"); ?>
                                        <input class="form-check-input <?php echo ($res ? "filter-active " : ""); ?>" type="radio" name="Order" value="NomeProdotto" id="order_name" <?php echo ($res ? "cheched" : ""); ?> disabled>
                                        <label class="form-check-label" for="order_name">
                                            nome prodotto
                                        </label>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <button type="button" class="btn btn-outline-danger" disabled>Salva modifiche</button>
                            </li>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>
        </aside>

        <div id="risultato" class="d-flex justify-content-center flex-grow-1">
            <ul class="list-group p-0 col-12 col-md-10 col-xl-9">
                <?php if (isset($templateParams["prodotti"]) && count($templateParams["prodotti"]) > 0) : ?>
                    <!-- elenco risultati se presenti -->
                    <?php foreach ($templateParams["prodotti"] as $prodotto) : ?>
                        <li class="col-12 list-group-item">
                            <a href="prodotto.php?id=<?php echo $prodotto["CodProdotto"]; ?>&idFornitore=<?php echo $prodotto["CodFornitore"]; ?>" class="card col-12 text-decoration-none text-body p-2">
                                <div class="row g-0 p-0 m-0 justify-content-between justify-content-xl-start gap-xl-4 justify-content-xxs-start">
                                    <div class="col-4 align-self-center d-xxs-none">
                                        <img src="<?php echo UPLOAD_DIR . $prodotto["ImgPath"]; ?>" alt="" />
                                    </div>
                                    <div class="col-7 col-lg-6 p-0 m-0 flex-grow-xxs-1 flex-grow-xl-1">
                                        <div class="card-body d-flex flex-wrap">
                                            <p class="card-text col-12 mb-4"><span class="visually-hidden">nome prodotto </span><?php echo $prodotto["NomeProdotto"]; ?></p>
                                            <?php if (round($prodotto["PrezzoUnitario"], 2) != round($prodotto["Prezzo"], 2)) : ?>
                                                <p class="card-text m-0 mt-2 col-12">
                                                    <span class="fw-lighter me-3 text-decoration-line-through " aria-hidden="true">
                                                        <?php echo round($prodotto["PrezzoUnitario"], 2); ?>€
                                                    </span>
                                                    <span class="visually-hidden">prezzo scontato</span>
                                                    <strong><?php echo round($prodotto["Prezzo"], 2); ?>€</strong>
                                                </p>
                                            <?php else : ?>
                                                <p class="card-text m-0 mt-2 col-12">
                                                    <span class="visually-hidden">prezzo</span>
                                                    <strong><?php echo round($prodotto["PrezzoUnitario"], 2); ?>€</strong>
                                                </p>
                                            <?php endif; ?>
                                            <?php if ($prodotto["QtaInMagazzino"] == 0) : ?>
                                                <div class="w-auto mt-3">
                                                    <img src="<?php echo ICON_DIR . "warning-icon.svg"; ?>" alt="prodotto esaurito" />
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                    <?php endforeach; ?>
                <?php else : ?>
                    <li class="col-12 list-group-item">
                        <img id="error_img" class="bg-white w-100 h-100" src="<?php echo PROD_IMG_DIR; ?>no-product.png" alt="nessun prodotto trovato" />
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</section>
<div aria-hidden="true" id="background"></div>