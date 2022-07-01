<div class="row">
    <section class="col-11 col-lg-10 mx-auto d-flex flex-column flex-wrap gap-5 flex-md-row">
    <?php if (isset($templateParams["prodotto"])) : ?>
        <div class="d-flex flex-column gap-1 col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="mb-0"> <?php echo  $templateParams["prodotto"]["NomeProdotto"];?> </h1>
                <a href="prodotto.php?action=mod-info-prod&id=<?php echo $templateParams["prodotto"]["CodProdotto"];?>">
                    <img src="../../Sanitary_Shop/upload/iconsImg/edit.svg" alt="Modifica dati prodotto">
                </a>
            </div>
            <div>
                <p class="m-0 fw-light"><small> <?php echo  $templateParams["prodotto"]["NomeCategoria"];?> </small></p>
            </div>
        </div>
        <div class="bg-white col-12 col-md-6 col-lg-4 d-flex align-items-center justify-content-center p-3">
            <img class= "card-image-center w-100 h-100" src="<?php echo UPLOAD_DIR . $templateParams["prodotto"]["ImgPath"];?>" alt="<?=$templateParams["prodotto"]['NomeProdotto']?>">
        </div>
        <div class="d-flex flex-column col-md-4 col-lg-5 gap-3 gap-lg-4 ms-md-5">
            <div class="price align-self-center align-self-md-start text-danger">
                <span class="text-dark">Prezzo: </span>
                <strong>&euro;<?=round($templateParams["prodotto"]['Prezzo'],2)?></strong>
            </div>

            <div class="d-flex flex-wrap gap-3 justify-content-between align-items-center">
                <p class="m-0"> Quantità in magazzino: 
                    <span  id="QtaInMagazzino">
                        <?php echo $templateParams["prodotto"]['QtaInMagazzino']?>
                    </span>
                </p>
                <input class="btn btn-primary" type="button" name="action" value="Rifornisci">
            </div>
            <p class="m-0 fw-light"> <?php echo  $templateParams["prodotto"]["Descrizione"];?> </p>
        </div>
        

        <div class="col-12 mt-md-4 d-md-flex align-items-md-start justify-content-md-between flex-wrap">
            <div class="d-flex flex-wrap col-md-3 flex-md-column gap-4 justify-content-between">
                <select name="time" class="p-1 b-radius-10 col-5 col-md-6 border-0 p-md-2">
                    <option value="7 day">Ultimi 7 giorni</option>
                    <option value="14 week">Ultimi 3 mesi</option>
                    <option value="12 month">Ultimo anno</option>
                </select>
                <div class="bg-white b-radius-10 text-center col-4 col-md-6">
                    <p id="TotVendite" class="w-100 m-0 p-1 fw-bold fs-3"></p>
                </div>
            </div>
            <div class="col-md-8 mt-5 mt-md-0">
                <canvas id="myChart"></canvas>

            </div>

        </div>

    <?php endif; ?>
    </section>
</div>


