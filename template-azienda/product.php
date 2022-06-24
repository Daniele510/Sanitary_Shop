<div class="row">
    <section class="col-11 mx-auto d-flex flex-column gap-4">
    <?php if (isset($templateParams["prodotto"])) : ?>
        <div class="d-flex flex-column gap-1">
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

        <div class="d-flex flex-wrap gap-3 justify-content-between align-items-center">
            <p class="m-0"> Quantità in magazzino: <?php echo $templateParams["prodotto"]['QtaInMagazzino']?> </p>
            <input class="btn btn-primary" type="button" name="action" value="Rifornisci">
        </div>

        <div class="col-12 ">
            <div class="d-flex flex-wrap gap-3 justify-content-between">
                <select name="time" class="p-1 b-radius-10 col-5 border-0">
                    <option value="7 day">Ultimi 7 giorni</option>
                    <option value="14 week">Ultimi 3 mesi</option>
                    <option value="12 month">Ultimo anno</option>
                </select>
                <div class="bg-white b-radius-10 text-center col-4">
                    <p id="TotVendite" class="w-100 m-0 p-1">2300</p>
                </div>
            </div>
            <div>
                <canvas id="myChart"></canvas>

            </div>

        </div>

    <?php endif; ?>
    </section>
</div>


