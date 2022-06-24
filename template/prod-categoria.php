<section class="row justify-content-center">
    <div class="col-10 p-0 d-flex flex-column gap-3 col-md-11 align-items-md-center">
        <header class="w-auto">
            <h3><?php echo $templateParams["titolo_pagina"]; ?></h3>
        </header>
        <div id="risultato" class="col-md-9 col-lg-7 col-xl-6">
        <?php if (count($templateParams["prodotti"]) > 0 && $templateParams["titolo_pagina"] !== 'Categoria assente') : ?>
            <ul class="list-group align-items-center m-md-0">
            <!-- elenco risultati se presenti -->
                <?php foreach ($templateParams["prodotti"] as $prodotto) : ?>
                    <li class="col-12 list-group-item">
                        <a href="prodotto.php?id=<?php echo $prodotto["CodProdotto"]; ?>&idFornitore=<?php echo $prodotto["CodFornitore"]; ?>" class="card col-12 text-decoration-none text-body p-2" style="<?php echo "border: 2px solid #" . $templateParams["ColoreCategoria"] . ";" ?>">
                            <div class="row g-0 p-0 m-0 justify-content-between justify-content-xl-start gap-xl-4 justify-content-xxs-start">
                                <div class="col-4 align-self-center d-xxs-none">
                                    <img src="<?php echo UPLOAD_DIR . $prodotto["ImgPath"]; ?>" alt="" />
                                </div>
                                <div class="col-7 col-lg-6 p-0 m-0 flex-grow-xxs-1 flex-grow-xl-1">
                                    <div class="card-body d-flex flex-wrap">
                                        <p class="card-text col-12 mb-4"><span class="visually-hidden">nome prodotto </span><?php echo $prodotto["NomeProdotto"]; ?></p>
                                        <?php if(round($prodotto["PrezzoUnitario"],2) != round($prodotto["Prezzo"],2)):?>
                                            <p class="card-text m-0 mt-2 col-12 fw-bold">
                                                <span class="fw-lighter me-3 text-decoration-line-through " aria-hidden="true">
                                                    <?php echo round($prodotto["PrezzoUnitario"], 2); ?>€
                                                </span>
                                                <span class="visually-hidden">prezzo scontato</span><?php echo round($prodotto["Prezzo"], 2); ?>€
                                            </p>
                                        <?php else: ?>
                                            <p class="card-text m-0 mt-2 col-12 fw-bold">
                                                <span class="visually-hidden">prezzo</span>
                                                <?php echo round($prodotto["PrezzoUnitario"], 2); ?>€
                                            </p>
                                        <?php endif; ?>
                                        <?php if($prodotto["QtaInMagazzino"]==0): ?>
                                            <div class="w-auto mt-3">
                                                <span class="visually-hidden">prodotto esaurito</span><img src="<?php echo ICON_DIR . "warning-icon.svg"; ?>" alt=""/>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
        </div>
    </div>
</section>