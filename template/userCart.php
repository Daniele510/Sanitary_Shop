<section class="row">
  <div class="col-12" id= "user-cart">
      <div class="card col-10" style="display: flex; border-radius: 5px; margin: 0 auto" id="">
            <div id="containerCartButton" class="white-container flex-column align-items-center">
              <h1 class="align-self-start">Totale: <!--<?php echo number_format($total, 2); ?> --></h1> 
              <a id="cartButton" class="col-12 btn btn-primary-dark" href="#" >Vai alla cassa(<?php echo $numArticoli; ?> <?php if($numArticoli==0 or $numArticoli>1) echo $testo2; else echo $testo1; ?>) </a>
            </div>
      </div>
    <div class="vstack col-md-5 mx-auto" style="gap: 2rem;">
        <?php
        if(isset($_COOKIE["shopping_cart"]))
        {
        $totale = 0;
        $cookie_data = stripslashes($_COOKIE['shopping_cart']);
        $templateParams["dati_carrello"] = json_decode($cookie_data, true);
        foreach($cart_data as $keys => $values)
        {
        ?>
        <div style="display: flex;">
          <div class="col-1"></div>
            <div class="card col-10" style="border-radius: 10px;">
              <div class="row g-0 d-flex align-items-stretch">
                <div class="col-5">
                  <img src="<?php echo UPLOAD_DIR . $values["ImgPath"]; ?>" class="img-fluid rounded-start" alt="" style="min-height: 152px;"/>
                </div>
                <div class="col-7">
                  <div class="card-body overflow-hidden d-flex flex-column" style="height: 100%;">
                    <h5 class="card-title m-0"><?php echo $values["nome_prodotto"]; ?></h5>
                      <div class="my-auto row d-flex align-items-center justify-content-between">
                        <p class="card-text col-8 m-0"><?php echo $values["prezzo_prodotto"]; ?></p>
                        <p class="card-text col-8 m-0"><?php echo $values["quantità_prodotto"]; ?></p>
                        <span class="col-2 d-flex justify-content-end"><img src="<?php echo UPLOAD_DIR . "carbon_shopping-cart-plus.svg"; ?>" alt="aggungi al carrello" style="height: 20px;" /></span>
                      </div>
                  </div>
                </div>
              </div>
            </div>
          <div class="col-1"></div>
        </div>
        <?php $templateParams["totaleCassa"] =  $templateParams["totaleCassa"] + ($values["quantità_prodotto"] * $values["prezzo_prodotto"]);
        }
        }
        else
        {
        ?>
          <h1 style="margin: 40px 0 0 0; text-align: center;"><?php echo $templateParams["titolo_pagina"]?></h1>
        <?php
        }
        ?> 
    </div>
  </div>
</section>