<div class="row">
    <h3 style="margin: 1.188rem 0 1.188rem 1.563rem;"><?php echo $templateParams["titolo_pagina"]; ?></h3>
    <div class="vstack col-md-5 mx-auto" style="gap: 2rem;">
        <?php if (count($templateParams["prodotti"]) > 0 && $templateParams["titolo_pagina"] !== 'Categoria assente') : ?>
            <?php foreach ($templateParams["prodotti"] as $prodoto) : ?>
                <div style="display: flex;">
                    <div class="col-1"></div>
                    <div class="card col-10">
                        <div class="row g-0 align-items-center">
                            <div class="col-5">
                                <img src="<?php echo UPLOAD_DIR . $prodoto["ImgPath"]; ?>" class="img-fluid rounded-start" alt="" />
                            </div>
                            <div class="col-7">
                                <div class="card-body overflow-hidden">
                                    <h5 class="card-title"><?php echo $prodoto["NomeProdotto"]; ?></h5>
                                    <div class="row d-flex align-items-center">
                                        <p class="card-text col-8 m-0"><?php echo $prodoto["Prezzo"]; ?></p>
                                        <span class="card-text col-4 d-flex justify-content-end"><img class="img-fluid" src="<?php echo UPLOAD_DIR . "carbon_shopping-cart-plus.svg"; ?>" alt="aggungi al carrello" style="height: 25px;" /></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-1"></div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>