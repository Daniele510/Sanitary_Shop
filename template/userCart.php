<section class="row justify-content-center ">
  <div class="col-10 d-flex flex-column flex-lg-row-reverse gap-lg-3 justify-content-lg-between flex-wrap" id= "user-cart">
    <div id="containerCartButton" class="white-container align-items-center card col-12 col-lg-4 d-flex flex-column rounded-5 m-0 align-items-md-center align-self-start">
      <h1 class="align-self-lg-center align-self-start">Totale: <?php echo $templateParams["totaleCassa"] ?> </h1> 
      <button id="cartButton" name="action" class="col-12 btn btn-primary-dark" >Vai alla cassa (<?php echo $templateParams["numArticoli"]; ?> <?php if($templateParams["numArticoli"]==1) echo "articolo"; else echo "articoli"; ?>) </button>
    </div>

    <div id="risultato" class="d-flex justify-content-center flex-grow-1">
        <ul class="list-group p-0 col-12 col-lg-10 col-xl-9">
          <?php
          if(!empty($templateParams["prodotti_carrello"])) :
             for ($i=0; $i<count($templateParams["prodotti_carrello"]); $i++  ) : 
               $values = $templateParams["prodotti_carrello"][$i];?>
            <li class="col-12 list-group-item bg-transparent d-flex flex-column gap-1">
              <a href="prodotto.php?id=<?php echo $values["CodProdotto"]; ?>&idFornitore=<?php echo $values["CodFornitore"]; ?>" class="card col-12 text-decoration-none text-body p-2 ">
                <div class="row g-0 p-0 m-0 justify-content-between justify-content-xl-start gap-xl-4 justify-content-xxs-start">
                  <div class="col-5">
                    <img src="<?php echo UPLOAD_DIR . $values["ImgPath"]; ?>" class="img-fluid rounded-start" alt=""/>
                  </div>
                  <div class="col-7 col-lg-6">
                    <div class="card-body overflow-hidden d-flex flex-column h-100">
                      <h5 class="card-title m-0"><?php echo $values["NomeProdotto"]; ?></h5>
                      <div class="my-auto row d-flex align-items-center justify-content-between">
                        <p class="card-text col-8 m-0"><?php echo round($values["Prezzo"],2); ?></p>
                      </div>
                      <?php if ($values["QtaInMagazzino"] <= 0) : ?>
                        <div class="w-auto mt-3">
                          <img src="<?php echo ICON_DIR . "warning-icon.svg"; ?>" alt="prodotto esaurito" />
                        </div>
                      <?php endif; ?>
                    </div>
                  </div>
                </div>
              </a>
              <div class="d-flex align-items-center flex-wrap">
                <label class="fw-bold col-form-label form-label me-3" for="<?php echo "qta-".$i ?>">Quantità</label>
                <div class="w-auto"> 
                  <input class="card-text m-0 form-control w-75" name="Qta" id="<?php echo "qta-".$i ?>" type="number" min="0" max="<?php echo $values["MaxQtaMagazzino"];?>" value="<?php echo $values["Qta"]; ?>">
                </div>
                <input type="hidden" name="id_prodotto" value="<?php echo $values['CodProdotto']?>">
                <input type="hidden" name="id_fornitore" value="<?php echo $values['CodFornitore']?>">

                <button class="w-auto btn delete"><img src="<?php echo ICON_DIR . "cart-bin.svg"; ?>" alt="rimuovi dal carrello" /></button>
              </div>
            </li>
          <?php endfor; ?>
          <?php
          else :
          ?>
            <li class="list-unstyled"><h2 class="text-center"><?php echo $templateParams["titolo_pagina"]?></h2></li>
          <?php
          endif;?>
        </ul>
    </div>
  </div>
</section>