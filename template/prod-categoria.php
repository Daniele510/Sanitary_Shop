<div class="row">
    <h3 style="margin: 1.188rem 0 1.188rem 1.563rem;"><?php echo $templateParams["titolo_pagina"]; ?></h3>
    <div class="vstack col-md-5 mx-auto" style="gap: 2rem;">
        <?php if (count($templateParams["prodotti"]) > 0 && $templateParams["titolo_pagina"] !== 'Categoria assente') : ?>
            <?php foreach ($templateParams["prodotti"] as $prodoto) : ?>
                <div style="display: flex; justify-content: center;">
                    <div class="card col-10" style="border-radius: 10px; <?php echo "border: 2px solid #" . $templateParams["ColoreCategoria"] . ";" ?>">
                        <div class="row g-0 d-flex align-items-stretch">
                            <div class="col-5">
                                <img src="<?php echo UPLOAD_DIR . $prodoto["ImgPath"]; ?>" class="img-fluid rounded-start" alt="" style="min-height: 152px;" />
                            </div>
                            <div class="col-7">
                                <div class="card-body overflow-hidden d-flex flex-column" style="height: 100%;">
                                    <h5 class="card-title m-0"><?php echo $prodoto["NomeProdotto"]; ?></h5>
                                    <div class="row">
                                        <p class="card-text m-0"><?php echo round($prodoto["Prezzo"], 2); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>