<div class="row">
    <h1><?php echo $templateParams["titolo_pagina"] ?></h1>
   <!-- <div class="col-4 mx-auto">
        <div class="card card-body mb-2 w-50" style="display: flex">
            <div class="card-body">
                <h1 class="card-title">Totale</h1>
                <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
        </div>
    </div> -->
    <div class="card" style="display: flex; border-radius: 5px; margin: 20px 30px 0px">
      <div class="row g-0" style="flex-direction: row-reverse; justify-content: space-evenly; align-items: stretch; margin-bottom: 1rem;">
        <div class="col-6 d-flex">
          <div class="card-body" style="padding-right: 0; padding-bottom: 0;">
            <h1 class="card-title">Totale <?php echo ?></h1>
            <a class="btn btn-dark" href="#" style="align-self: flex-end; padding: 0.1rem 0.8rem; border-radius: 10px; background: #324B4B;">Vai alla cassa(<?php echo $numArticoli; ?> <?php if($numArticoli==0 or $numArticoli>1) echo $testo2; else echo $testo1; ?>) </a>
          </div>
        </div>
      </div>
    </div>
</div>