<div class="row">
    <!-- dropdown -->
    <div class="d-flex justify-content-end">
        <button class="btn" type="button" id="dropdownMenuClickable" data-bs-toggle="dropdown" data-bs-auto-close="false" aria-expanded="false">
            <img class="img-fluid" src="<?php echo UPLOAD_DIR . "settings.svg"; ?>" alt="impostazioni ricerca" width="20" height="20" />
        </button>
        <ul class="dropdown-menu col-10 col-md-6" aria-labelledby="dropdownMenuClickable" style="overflow-y:auto; max-height:50vh">
            <li>
                <h3>filtri</h3>
                <ul style="list-style: none;">
                    <li>
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            Default checkbox
                        </label>
                    </li>
                    <li>
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            Default checkbox
                        </label>
                    </li>
                    <li>
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            Default checkbox
                        </label>
                    </li>
                    <li>
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            Default checkbox
                        </label>
                    </li>
                    <li>
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            Default checkbox
                        </label>
                    </li>
                </ul>
            </li>

            <li>
                <hr class="dropdown-divider">
            </li>

            <li>
                <h3>ordina per</h3>
                <ul style="list-style: none;">
                    <li>
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                        <label class="form-check-label" for="flexRadioDefault1">
                            Default radio
                        </label>
                    </li>
                    <li>
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                        <label class="form-check-label" for="flexRadioDefault1">
                            Default radio
                        </label>
                    </li>
                    <li>
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                        <label class="form-check-label" for="flexRadioDefault1">
                            Default radio
                        </label>
                    </li>

                </ul>
            </li>
        </ul>
    </div>
    <?php if (count($templateParams["prodotti"]) > 0) : ?>
        <?php foreach ($templateParams["prodotti"] as $prodotto) : ?>
            <div class="card d-inline col-12">
                <div class="row g-0 align-items-center">
                    <div class="col-4">
                        <!--TODO: inserire dati presi da database -->
                        <img src="<?php echo $prodotto["img"]; ?>" class="img-fluid rounded-start" alt="" />
                    </div>
                    <div class="col-8">
                        <div class="card-body overflow-hidden">
                            <!--  -->
                            <h5 class="card-title"><?php echo $prodotto["NomeProdotto"]; ?></h5>
                            <p class="card-text"><?php echo $prodotto["BreveDescrizione"]; ?></p>
                            <div class="row d-flex align-items-center">
                                <p class="card-text col-6 m-0"><?php echo $prodotto["prezzo"]; ?></p>
                                <a class="card-text col-6 d-flex justify-content-end" href="#"><img class="img-fluid" src="<?php echo UPLOAD_DIR . "carbon_shopping-cart-plus.svg"; ?>" alt="aggungi al carrello" /></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        endforeach;
    else : ?>
        <h2>Non sono stati trovati prodotti con questo nome</h2>
    <?php
    endif;
    ?>
</div>