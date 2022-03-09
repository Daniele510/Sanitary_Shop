<div class="row">
    <?php if (isset($templateParams["prodotto"])) : ?>
        <div class="row product_title" style="display: flex; margin: 20px 20px 20px">
            <div class="venditore">
                <h1> <?php echo  $templateParams["prodotto"]["Fornitore"];?> </h1>
            </div>
            <div class="nome_prodotto">
            <h2> <?php echo  $templateParams["prodotto"]["NomeProdotto"];?> </h2>
            </div>
        </div>
        <div class="card col-10 align-items-center">
            <img src="<?php echo UPLOAD_DIR . $templateParams["prodotto"]["ImgPath"];?>" width="500" height="500" alt="<?=$templateParams["prodotto"]['NomeProdotto']?>">
            </div>
        </div>
        <div>
                <span class="price">
                    &euro;<?=$templateParams["prodotto"]['Prezzo']?>
                </span>
                <form method="post">
                    <input type="number" name="quantity" value="1" min="1" max="<?=$templateParams["prodotto"]['MaxQtaMagazzino']?>" placeholder="Quantity" required>
                    <input type="hidden" name="product_id" value="<?=$templateParams["prodotto"]['CodProdotto']?>">
                    <input type="submit" value="Add To Cart">
                </form>
                <div class="description">
                    <?=$templateParams["prodotto"]['Descrizione']?>
                </div>
    <?php endif; ?>
</div>
