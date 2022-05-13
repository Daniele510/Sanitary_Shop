<div class="row">
    <section class="col-11 mx-auto d-flex flex-column align-items-center">
    <?php if (isset($templateParams["prodotto"])) : ?>
        <div class="row product_title">
            <div class="venditore">
                <a href="<?php echo "ricerca-prodotti-azienda.php?" ?>" ><small> <?php echo  $templateParams["prodotto"]["Fornitore"];?> </small> </a>
            </div>
            <div class="nome_prodotto">
            <h1> <?php echo  $templateParams["prodotto"]["NomeProdotto"];?> </h1>
            </div>
        </div>
            <div id="immagineProdotto"  class="card col-10 align-items-center" >
                <div class= "container">
                    <img class= "card-image-center" src="<?php echo UPLOAD_DIR . $templateParams["prodotto"]["ImgPath"];?>" width="500" height="500" alt="<?=$templateParams["prodotto"]['NomeProdotto']?>">
                </div>
            </div>
        <div>
                <span class="price">
                    &euro;<?=$templateParams["prodotto"]['Prezzo']?>
                </span>
                <div class="d-flex flex-column">
                    <div class="col-4">
                    <input type="number" name="quantità" value="1" min="1" max="<?php echo $templateParams["prodotto"]['MaxQtaMagazzino']?>" placeholder="Quantity" required>
                    </div>
                    <input type="hidden" name="id_prodotto" value="<?php echo $templateParams["prodotto"]['CodProdotto']?>">
                    <input type="hidden" name="id_fornitore" value="<?php echo $templateParams["prodotto"]['CodFornitore']?>">
                    
                    <input type="submit" name="action" value="Aggiungi al carrello">
                </div>
                <div class="description">
                    <?php echo $templateParams["prodotto"]['Descrizione']?>
                </div>
    <?php endif; ?>
    </section>
</div>
