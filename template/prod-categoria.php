<div class="row">
    <h3><?php echo $templateParams["titolo_pagina"]; ?></h3>
    <?php if (count($templateParams["prodotti"]) > 0 && $templateParams["titolo_pagina"] !== 'Categoria assente') : ?>
        <div class="row container-list">
        <!-- elenco risultati se presenti -->
            <?php foreach ($templateParams["prodotti"] as $prodotto) : ?>
                <div class="card col-10" style="<?php echo "border: 2px solid #" . $templateParams["ColoreCategoria"] . ";" ?>">
                    <div class="row g-0 p-0 m-0 align-items-center">
                        <div class="col-4">
                            <img src="<?php echo UPLOAD_DIR . $prodotto["ImgPath"]; ?>" class="img-fluid" alt="" />
                        </div>
                        <div class="col-8 p-0 m-0">
                            <div class="card-body d-flex flex-wrap">
                                <h5 class="card-title col-12"><?php echo $prodotto["NomeProdotto"]; ?></h5>
                                <p class="card-text m-0"><?php echo round($prodotto["Prezzo"], 2); ?></p>
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
</div>