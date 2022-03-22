<div class="row p-0 m-0 justify-content-center">
    <div class="col-10 p-0 col-md-11 flex-container">
        <div class="col-md-5 p-0 d-flex aside">
            <div class="col-12 d-flex justify-content-between">
                <a class="btn outline_secondary d-flex align-items-center justify-content-between" href="prodotti-compagnia.php?action=ins-new-prod">
                    <div class="text-center col-7">aggiungi nuovo prodotto</div>
                    <img src="<?php echo ICON_DIR . "add-icon.svg"; ?>" alt=""/>
                </a>
                <!-- filtri ricerca -->
                <?php if (isset($templateParams["prodotti"]) && count($templateParams["prodotti"]) > 0) : ?>
                    <div class="filter-container transform">
                        <button class="btn btn-settings">
                            <img src="<?php echo ICON_DIR . "settings.svg"; ?>" alt="impostazioni ricerca"/>
                        </button>
                        <ul>
                            <li>
                                <h3>Filtra per</h3>
                                <ul>
                                    <li>
                                        <h5>categoria</h5>
                                        <ul>
                                            <?php foreach ($templateParams["categorie"] as $categoria) : ?>
                                                <li>
                                                    <?php $res = isSelected("NomeCategoria[]",$prodotto["NomeCategoria"]); ?>
                                                    <input class="form-check-input <?php echo ($res ? "filter-active" : ""); ?>" type="checkbox" id="check_<?php echo $categoria; ?>" name="NomeCategoria[]" value="<?php echo $prodotto["NomeCategoria"]; ?>">
                                                    <label class="form-check-label" for="check_<?php echo $categoria; ?>">
                                                        <?php echo $categoria; ?>
                                                    </label>
                                                </li>
                                            <?php endforeach ?>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <h3>Ordina per</h3>
                                <ul>
                                    <li>
                                        <?php $res = isSelected("Order","Prezzo"); ?>
                                        <input class="form-check-input <?php echo ($res ? "filter-active " : "");?>" type="radio" name="Order" value="Prezzo" id="order_price_up" <?php echo ($res ? "cheched" : "");?>>
                                        <label class="form-check-label" for="order_price_up">
                                            prezzo crescente
                                        </label>
                                    </li>
                                    <li>
                                        <?php $res = isSelected("Order","Prezzo DESC"); ?>
                                        <input class="form-check-input <?php echo ($res ? "filter-active " : "");?>" type="radio" name="Order" value="Prezzo DESC" id="order_price_down" <?php echo ($res ? "cheched" : "");?>>
                                        <label class="form-check-label" for="order_price_down">
                                            prezzo decrescente
                                        </label>
                                    </li>
                                    <li>
                                        <?php $res = isSelected("Order","Sconto DESC"); ?>
                                        <input class="form-check-input <?php echo ($res ? "filter-active " : "");?>" type="radio" name="Order" value="Sconto DESC" id="order_discount" <?php echo ($res ? "cheched" : "");?>>
                                        <label class="form-check-label" for="order_discount">
                                            sconto
                                        </label>
                                    </li>
                                    <li>
                                        <?php $res = isSelected("Order","NomeProdotto"); ?>
                                        <input class="form-check-input <?php echo ($res ? "filter-active " : "");?>" type="radio" name="Order" value="NomeProdotto" id="order_name" <?php echo ($res ? "cheched" : "");?>>
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
                    </div>
                <?php else: ?>
                    <div class="filter-container transform">
                        <button class="btn btn-settings" disabled>
                            <img src="<?php echo ICON_DIR . "settings.svg"; ?>" alt="impostazioni ricerca"/>
                        </button>
                        <ul>
                            <li>
                                <h3>Filtra per</h3>
                            </li>
                            <li>
                                <h3>Ordina per</h3>
                                <ul>
                                    <li>
                                        <?php $res = isSelected("Order","Prezzo"); ?>
                                        <input class="form-check-input <?php echo ($res ? "filter-active " : "");?>" type="radio" name="Order" value="Prezzo" id="order_price_up" <?php echo ($res ? "cheched" : "");?> disabled>
                                        <label class="form-check-label" for="order_price_up">
                                            prezzo crescente
                                        </label>
                                    </li>
                                    <li>
                                        <?php $res = isSelected("Order","Prezzo DESC"); ?>
                                        <input class="form-check-input <?php echo ($res ? "filter-active " : "");?>" type="radio" name="Order" value="Prezzo DESC" id="order_price_down" <?php echo ($res ? "cheched" : "");?> disabled>
                                        <label class="form-check-label" for="order_price_down">
                                            prezzo decrescente
                                        </label>
                                    </li>
                                    <li>
                                        <?php $res = isSelected("Order","Sconto DESC"); ?>
                                        <input class="form-check-input <?php echo ($res ? "filter-active " : "");?>" type="radio" name="Order" value="Sconto DESC" id="order_discount" <?php echo ($res ? "cheched" : "");?> disabled>
                                        <label class="form-check-label" for="order_discount">
                                            sconto
                                        </label>
                                    </li>
                                    <li>
                                        <?php $res = isSelected("Order","NomeProdotto"); ?>
                                        <input class="form-check-input <?php echo ($res ? "filter-active " : "");?>" type="radio" name="Order" value="NomeProdotto" id="order_name" <?php echo ($res ? "cheched" : "");?> disabled>
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
                    </div>
                <?php endif; ?>
            </div>
        </div>
        
        <div id="risultato">
            <?php if (isset($templateParams["prodotti"]) && count($templateParams["prodotti"]) > 0) : ?>
                <ul class="list-container p-0 col-12">
                    <!-- elenco risultati se presenti -->
                    <?php foreach ($templateParams["prodotti"] as $prodotto) : ?>
                        <li class="col-12">
                            <div class="card col-12">
                                <div class="row g-0 p-0 m-0 align-items-center">
                                    <div class="col-4">
                                        <img src="<?php echo UPLOAD_DIR . $prodotto["ImgPath"]; ?>" alt="" />
                                    </div>
                                    <div class="col-8 p-0 m-0">
                                        <div class="card-body d-flex flex-wrap">
                                            <h5 class="card-title col-12"><span class="visually-hidden">nome prodotto</span><?php echo $prodotto["NomeProdotto"]; ?></h5>
                                            <p class="card-text m-0"><span class="visually-hidden">prezzo</span><?php echo round($prodotto["Prezzo"], 2); ?></p>
                                            <?php if($prodotto["QtaInMagazzino"]==0): ?>
                                                <span class="visually-hidden">prodotto esaurito</span><img class="ms-auto" src="<?php echo ICON_DIR . "warning-icon.svg"; ?>" alt=""/>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>
    </div>         
</div>
<div aria-hidden="true" id="background"></div>
