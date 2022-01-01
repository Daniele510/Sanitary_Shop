<div class="row">
    <h1><?php echo $templateParams["titolo_pagina"] ?></h1>
    <?php if (count($templateParams["prodotti"]) > 0 && $templateParams["titolo_pagina"] !== 'Categoria assente') : ?>
        <?php foreach ($templateParams["prodotti"] as $prodoto) : ?>
            <div class="card d-inline col-12">
                <div class="row g-0 align-items-center">
                    <div class="col-4">
                        <img src="<?php echo UPLOAD_DIR . $prodoto["ImgPath"]; ?>" class="img-fluid rounded-start" alt="" />
                    </div>
                    <div class="col-8">
                        <div class="card-body overflow-hidden">
                            <h5 class="card-title"><?php echo $prodoto["NomeProdotto"]; ?></h5>
                            <div class="row d-flex align-items-center">
                                <p class="card-text col-6 m-0"><?php echo $prodoto["Prezzo"]; ?></p>
                                <a class="card-text col-6 d-flex justify-content-end" href="#"><img class="img-fluid" src="<?php echo UPLOAD_DIR . "carbon_shopping-cart-plus.svg"; ?>" alt="aggungi al carrello" /></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    <?php
        endforeach;
    endif; ?>
</div>