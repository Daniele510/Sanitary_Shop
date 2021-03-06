<div class="row justify-content-center align-items-start gap-2">
    <button class="btn p-0 d-none d-md-block back w-auto ms-3 mt-2"><img src="<?php echo ICON_DIR; ?>back.svg" alt="torna indietro"></button>
    <section class="col-11 col-lg-10 mx-auto d-flex flex-column flex-wrap gap-5 flex-md-row">
    <?php if (isset($templateParams["prodotto"])) : ?>
        <div class="d-flex flex-column gap-1 col-12">
            <div class="product_title ">
                <a class="text-decoration-none" href="<?php echo "ricerca-prodotti-azienda.php?idFornitore=" .$templateParams["prodotto"]['CodFornitore'] ?>" ><small> <?php echo  $templateParams["prodotto"]["Fornitore"];?> </small> </a>
            </div>
            <div>
                <h1 class="mb-0"> <?php echo  $templateParams["prodotto"]["NomeProdotto"];?> </h1>
            </div>
            <div>
                <a class="text-decoration-none m-0 fw-light" href="<?php echo "categoria.php?id=" .$templateParams["prodotto"]['CodCategoria'] ?>"><small> <?php echo  $templateParams["prodotto"]["NomeCategoria"];?> </small></a>
            </div>
        </div>
        <div class="bg-white col-12 col-md-6 col-lg-5 d-flex align-items-center justify-content-center p-3">
            <img class= "card-image-center w-100 h-100" src="<?php echo UPLOAD_DIR . $templateParams["prodotto"]["ImgPath"];?>" alt="<?=$templateParams["prodotto"]['NomeProdotto']?>">
        </div>
        <div class="d-flex flex-column col-md-4 gap-4 ms-md-5">
            <?php if($templateParams["prodotto"]['QtaInMagazzino']>0 && !empty($templateParams["prodotto"]["InVendita"])):?>
                <p>
                    <span class="text-success fw-bold fs-4">Disponibile</span> / 
                    <span>Non disponibile</span>
                </p>
            <?php else: ?>
                <p>
                    <span>Disponibile</span> / 
                    <span class="text-danger fw-bold fs-4">Non disponibile</span>
                </p>
            <?php endif;?>
            <div class="price align-self-center align-self-md-start text-danger">
                <span class="text-dark">Prezzo: </span>
                <strong>&euro;<?=round($templateParams["prodotto"]['Prezzo'],2)?></strong>
            </div>
            <form action="gestione-carrello.php" class="d-flex flex-column gap-3" method="post">
                <div class="col-12 d-flex gap-1 align-items-center flex-wrap">
                    <label class="fw-bold col-form-label form-label me-3" for="Qta">Quantit??</label>
                    <input class="col-md-2" id="Qta" type="number" name="quantit??" value="1" min="1" max="<?php echo $templateParams["prodotto"]['MaxQtaMagazzino']?>" placeholder="Quantity" required>
                </div>
                <input type="hidden" name="id_prodotto" value="<?php echo $templateParams["prodotto"]['CodProdotto']?>">
                <input type="hidden" name="id_fornitore" value="<?php echo $templateParams["prodotto"]['CodFornitore']?>">
                
                <input class="btn btn-primary col-xl-7" <?php echo isUserLoggedIn() ? "" : "disabled";  ?> type="submit" name="action" value="Aggiungi al carrello">
                <input class="btn btn-primary-dark col-xl-7" <?php echo !isCompanyLoggedIn() && $templateParams["prodotto"]["QtaInMagazzino"] > 0 ? "" : "disabled";  ?> type="submit" name="action" value="Acquista ora">
            </form>
            <div>
                <h3>Descrizione</h3>
                <div class="descrizione-prodotto">
                    <?php echo $templateParams["prodotto"]['Descrizione']?>
                </div>
            </div>
        </div>
        <div class="descrizione-azienda col-12">
            <h3>Per informazioni</h3>
            <p><?php echo $templateParams["prodotto"]['Email']?><br/>
            <?php echo $templateParams["prodotto"]['NumeroTelefono']?></p>
        </div>
    <?php endif; ?>
    </section>
</div>
