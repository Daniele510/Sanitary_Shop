<div class="row p-0 m-0">
    <!-- filtri ricerca -->
    <?php if (isset($templateParams["prodotti"]) && count($templateParams["prodotti"]) > 0) : ?>
        <div class="row p-0 m-0 justify-content-center">
            <div class="col-10 mt-3 p-0 d-flex justify-content-end">
                <div class="filter-container transform">
                    <button class="btn btn-settings">
                        <img src="<?php echo UPLOAD_DIR . "settings.svg"; ?>" alt="impostazioni ricerca"/>
                    </button>
                    <ul>
                        <li>
                            <h3>Filtra per</h3>
                            <ul>
                                <?php foreach ($templateParams["prodotti"] as $prodotto) : ?>
                                    <li>
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            <?php echo $prodotto["NomeCompagnia"]; ?>
                                        </label>
                                    </li>
                                <?php endforeach ?>
                            </ul>
                        </li>
                        <li>
                            <h3>Ordina per</h3>
                            <ul>
                                <li>
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="check_price_up">
                                    <label class="form-check-label" for="check_price_up">
                                        prezzo crescente
                                    </label>
                                </li>
                                <li>
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="check_price_down">
                                    <label class="form-check-label" for="check_price_down">
                                        prezzo decrescente
                                    </label>
                                </li>
                                <li>
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="check_discount">
                                    <label class="form-check-label" for="check_discount">
                                        sconto decrescente
                                    </label>
                                </li>
                                <li>
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="check_name">
                                    <label class="form-check-label" for="check_name">
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

        <div class="row container-list mt-3">
            <!-- elenco risultati se presenti -->
                <?php foreach ($templateParams["prodotti"] as $prodotto) : ?>
                    <div class="card col-10">
                        <div class="row g-0 p-0 m-0 align-items-center">
                            <div class="col-4">
                                <img src="<?php echo UPLOAD_DIR . $prodotto["ImgPath"]; ?>" class="img-fluid" alt="" />
                            </div>
                            <div class="col-8 p-0 m-0">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $prodotto["NomeProdotto"]; ?></h5>
                                    <p class="card-text m-0"><?php echo round($prodotto["Prezzo"], 2); ?></p>
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
