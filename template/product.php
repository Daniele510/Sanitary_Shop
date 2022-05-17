<div class="row">
    <section class="col-11 mx-auto d-flex flex-column gap-4">
    <?php if (isset($templateParams["prodotto"])) : ?>
        <div class="d-flex flex-column gap-1">
            <div class="product_title ">
                <a href="<?php echo "ricerca-prodotti-azienda.php?idFornitore=" .$templateParams["prodotto"]['CodFornitore'] ?>" ><small> <?php echo  $templateParams["prodotto"]["Fornitore"];?> </small> </a>
            </div>
            <div>
                <h1 class="mb-0"> <?php echo  $templateParams["prodotto"]["NomeProdotto"];?> </h1>
            </div>
            <div>
                <p class="m-0 fw-light"><small> <?php echo  $templateParams["prodotto"]["NomeCategoria"];?> </small></p>
            </div>
        </div>
        <div id="immagineProdotto"  class="bg-white col-12 align-items-center" style="display:grid; place-content:center" >
            <div class= "container">
                <img class= "card-image-center col-10" src="<?php echo UPLOAD_DIR . $templateParams["prodotto"]["ImgPath"];?>" alt="<?=$templateParams["prodotto"]['NomeProdotto']?>">
            </div>
        </div>
        <div class="price align-self-center text-danger">
            <span class="text-dark">Prezzo: </span>
            <strong>&euro;<?=round($templateParams["prodotto"]['Prezzo'],2)?></strong>
        </div>
        <div class="d-flex flex-column gap-3">
            <div class="col-4">
                <input type="number" name="quantità" value="1" min="1" max="<?php echo $templateParams["prodotto"]['MaxQtaMagazzino']?>" placeholder="Quantity" required>
            </div>
            <input type="hidden" name="id_prodotto" value="<?php echo $templateParams["prodotto"]['CodProdotto']?>">
            <input type="hidden" name="id_fornitore" value="<?php echo $templateParams["prodotto"]['CodFornitore']?>">
            
            <input class="btn btn-primary" type="submit" name="action" value="Aggiungi al carrello">
            <input class="btn btn-primary-dark" type="submit" name="action" value="Acquista ora">
        </div>
        <div class="descrizione-prodotto">
            <?php echo $templateParams["prodotto"]['Descrizione']?>
        </div>
        <div class="descrizione-azienda">
            <h3>Per informazioni</h3>
            <p><?php echo $templateParams["prodotto"]['Email']?><br/>
            <?php echo $templateParams["prodotto"]['NumeroTelefono']?></p>
        </div>
    <?php endif; ?>
    </section>
</div>
