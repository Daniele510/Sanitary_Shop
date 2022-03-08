<div class="row">
    <?php if ($templateParams["titolo_pagina"] !== 'Prodotto non esistente') : ?>
        <div class="product content-wrapper">
            <img src="<?php echo UPLOAD_DIR . $templateParams["prodotto"]["ImgPath"];?>" width="500" height="500" alt="<?php echo $templateParams["prodotto"]['NomeProdotto']?>">
            <div>
                <h1 class="name"><?php echo $templateParams["prodotto"]['NomeProdotto']?></h1>
                <span class="price">
                    &euro;<?php echo $templateParams["prodotto"]['Prezzo']?>
                </span>
                <form method="post">
                    <input type="number" name="quantity" value="1" min="1" max="<?php echo $templateParams["prodotto"]['MaxQtaMagazzino']?>" placeholder="Quantity" required>
                    <input type="hidden" name="product_id" value="<?php echo $templateParams["prodotto"]['CodProdotto']?>">
                    <input type="submit" value="Add To Cart">
                </form>
                <div class="description">
                    <?php echo $templateParams["prodotto"]['Descrizione']?>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>