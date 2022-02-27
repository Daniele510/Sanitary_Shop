<div class="row p-0 m-0">
    <!-- filtri ricerca -->
    <?php if (isset($templateParams["prodotti"]) && count($templateParams["prodotti"]) > 0) : ?>
        <div class="row p-0 m-0 justify-content-center" id="filtri_ricerca">
            <div class="col-10 mt-3 p-0 d-flex justify-content-end">
                <div class="filter-container transform">
                    <button class="btn btn-settings">
                        <img src="<?php echo ICON_DIR . "settings.svg"; ?>" alt="impostazioni ricerca"/>
                    </button>
                    <ul>
                        <li>
                            <h3>Filtra per</h3>
                            <ul>
                                <?php foreach ($templateParams["produttori_distinti"] as $produttore) : ?>
                                    <li>
                                        <?php $res = isSelected("NomeCompagnia[]",$prodotto["NomeCompagnia"]); ?>
                                        <input class="form-check-input <?php echo ($res ? "filter-active" : ""); ?>" type="checkbox" id="check_<?php echo $produttore; ?>" name="NomeCompagnia[]" value="<?php echo $prodotto["NomeCompagnia"]; ?>">
                                        <label class="form-check-label" for="check_<?php echo $produttore; ?>">
                                            <?php echo $produttore; ?>
                                        </label>
                                    </li>
                                <?php endforeach ?>
                            </ul>
                        </li>
                        <li>
                            <h3>Ordina per</h3>
                            <ul>
                                <li>
                                    <?php $res = isSelected("Order","Prezzo"); ?>
                                    <input class="form-check-input <?php echo ($res ? "filter-active" : ""); ?>" type="radio" name="Order" value="Prezzo" id="order_price_up">
                                    <label class="form-check-label" for="order_price_up">
                                        prezzo crescente
                                    </label>
                                </li>
                                <li>
                                    <?php $res = isSelected("Order","Prezzo DESC"); ?>
                                    <input class="form-check-input <?php echo ($res ? "filter-active" : ""); ?>" type="radio" name="Order" value="Prezzo DESC" id="order_price_down">
                                    <label class="form-check-label" for="order_price_down">
                                        prezzo decrescente
                                    </label>
                                </li>
                                <li>
                                    <?php $res = isSelected("Order","Sconto DESC"); ?>
                                    <input class="form-check-input <?php echo ($res ? "filter-active" : ""); ?>" type="radio" name="Order" value="Sconto DESC" id="order_discount">
                                    <label class="form-check-label" for="order_discount">
                                        sconto
                                    </label>
                                </li>
                                <li>
                                    <?php $res = isSelected("Order","NomeProdotto"); ?>
                                    <input class="form-check-input <?php echo ($res ? "filter-active" : $res);?>" type="radio" name="Order" value="NomeProdotto" id="order_name">
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
            </div>
        </div>

        <div class="row container-list p-0" id="lista_risultato">
            <!-- elenco risultati se presenti -->
                <?php foreach ($templateParams["prodotti"] as $prodotto) : ?>
                    <div class="card col-10">
                        <div class="row g-0 p-0 m-0 align-items-center">
                            <div class="col-4">
                                <img src="<?php echo UPLOAD_DIR . $prodotto["ImgPath"]; ?>" class="img-fluid" alt="" />
                            </div>
                            <div class="col-8 p-0 m-0">
                                <div class="card-body d-flex flex-wrap">
                                    <h5 class="card-title col-12"><?php echo $prodotto["NomeProdotto"]; ?></h5>
                                    <p class="card-text align-self-center"><?php echo round($prodotto["Prezzo"], 2); ?></p>
                                    <?php if($prodotto["QtaInMagazzino"]==0): ?>
                                        <img class="ms-auto" src="<?php echo ICON_DIR . "warning-icon.svg"; ?>" alt=""/>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    <!-- TODO: inserire immagine errore nel caso non ci siano prodotti -->
</div>
<div aria-hidden="true" id="background"></div>
