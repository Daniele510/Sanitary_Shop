<div class="row">
    <h1><?php echo $templateParams["titolo_pagina"] ?></h1>
      <div class="card col-10" style="display: flex; border-radius: 5px; margin: 20px 30px 0px" id="">
        <div class="row g-0" style="flex-direction: row-reverse; justify-content: space-evenly; align-items: stretch; margin-bottom: 1rem;">
          <div class="col4">
            <div class="card-body" style="padding-right: 0; padding-bottom: 0;">
              <h1 class="card-title">Totale</h1>
              <a class="btn btn-dark" href="#" style="align-self: flex-end; padding: 1.1rem 3.8rem; border-radius: 10px; background: #324B4B;">Vai alla cassa(<?php echo $numArticoli; ?> <?php if($numArticoli==0 or $numArticoli>1) echo $testo2; else echo $testo1; ?>) </a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="vstack col-md-5 mx-auto" style="gap: 2rem;">
        <?php if (count($templateParams["prodotti"]) > 0 && $templateParams["titolo_pagina"] !== 'Categoria assente') : ?>
            <?php foreach ($templateParams["prodotti"] as $prodoto) : ?>
                <div style="display: flex;">
                    <div class="col-1"></div>
                    <div class="card col-10" style="border-radius: 10px;">
                        <div class="row g-0 d-flex align-items-stretch">
                            <div class="col-5">
                                <img src="<?php echo UPLOAD_DIR . $prodoto["ImgPath"]; ?>" class="img-fluid rounded-start" alt="" style="min-height: 152px;"/>
                            </div>
                            <div class="col-7">
                                <div class="card-body overflow-hidden d-flex flex-column" style="height: 100%;">
                                    <h5 class="card-title m-0"><?php echo $prodoto["NomeProdotto"]; ?></h5>
                                    <div class="my-auto row d-flex align-items-center justify-content-between">
                                        <p class="card-text col-8 m-0"><?php echo $prodoto["Prezzo"]; ?></p>
                                        <span class="col-2 d-flex justify-content-end"><img src="<?php echo UPLOAD_DIR . "carbon_shopping-cart-plus.svg"; ?>" alt="aggungi al carrello" style="height: 20px;" /></span>
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