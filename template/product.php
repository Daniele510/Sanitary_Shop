<div class="row">
    <?php if $templateParams["titolo_pagina"] !== 'Prodotto non esistente') : ?>
        <div class="product content-wrapper">
            <img src="<?php echo UPLOAD_DIR . $templateParams["prodotto"]["ImgPath"];?>" width="500" height="500" alt="<?=$templateParams["prodotto"]['nomeProdotto']?>">
            <div>
                <h1 class="name"><?=$templateParams["prodotto"]['nomeProdotto']?></h1>
                <span class="price">
                    &euro;<?=$templateParams["prodotto"]['PrezzoUnitario']?>
                </span>
                <form method="post">
                    <input type="number" name="quantity" value="1" min="1" max="<?=$templateParams["prodotto"]['MaxQtaMagazzino']?>" placeholder="Quantity" required>
                    <input type="hidden" name="product_id" value="<?=$templateParams["prodotto"]['CodProdotto']?>">
                    <input type="submit" value="Add To Cart">
                </form>
                <div class="description">
                    <?=$templateParams["prodotto"]['Descrizione']?>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>