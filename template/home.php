<div class="row">
    <?php if (count($templateParams["prodotti-scontati"]) > 0) :
        $prodotti_scontati = $templateParams["prodotti-scontati"]; ?>
        <div id="offerteCarousel" class="carousel slide" data-bs-ride="carousel">
            <ul class="carousel-inner m-0 p-0">
                <?php for ($i = 0; $i < count($prodotti_scontati); $i++) : ?>
                    <li class="carousel-item <?php echo ($i==0 ? "active" : ""); ?>">
                        <div class="card">
                            <div class="row g-0 flex-grow-1">
                                <div class="col-4">
                                    <img src="<?php echo UPLOAD_DIR . $prodotti_scontati[$i]["ImgPath"]; ?>" alt="" />
                                </div>
                                <div class="col-6 d-flex">
                                    <div class="card-body p-0 d-flex flex-column">
                                        <h4 class="card-title">Offerta speciale</h4>
                                        <p class="card-text flex-grow-1"><?php echo $prodotti_scontati[$i]["Sconto"]; ?>% di sconto su <?php echo $prodotti_scontati[$i]["NomeProdotto"]; ?></p>
                                        <a class="btn primary-dark col-md-4 align-self-start" href="#">dettagli</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                <?php endfor; ?>
            </ul>
        </div>
    <?php endif; ?>
</div>

<!-- categorie -->
<div class="row justify-content-center" id="categorie" <?php if (count($templateParams["prodotti-scontati"]) > 0) : ?> style="margin: 33px 0;" <?php else : ?> style="margin: 0 0 33px 0;" <?php endif; ?>>
    <h1>Categoria</h1>
    <div class="col-11 p-0 justify-content-center">
        <ul class="nav gap-5 justify-content-even">
            <?php if (isset($templateParams["categorie"])) : ?>
                <?php foreach ($templateParams["categorie"] as $categoria) : ?>
                    <li class="nav-item">
                        <a href="categoria.php?id=<?php echo $categoria["CodCategoria"]; ?>" class="text-dark text-decoration-none">
                            <figure class="figure text-center m-0 p-0">
                                <img src="<?php echo UPLOAD_DIR . $categoria["ImgPath"]; ?>" class="figure-img" alt="" />
                                <figcaption class="figure-caption"><?php echo $categoria["NomeCategoria"]; ?></figcaption>
                            </figure>
                        </a>
                    </li>
            <?php endforeach;
            endif; ?>
        </ul>
    </div>
</div>

<!-- prodotti consigliati -->
<?php if (count($templateParams["prodotti_consigliati"]) > 0) :
    $prodotti_consigliati = $templateParams["prodotti_consigliati"]; ?>
    <div class="row" id="prodotti-consigliati">
        <h1>Prodotti consigliati</h1>
        <ul id="carouselProdottiConsigliati" class="carousel carousel-dark" data-bs-interval="false">
            <li class="carousel-inner">
                <ul class="d-flex flex-row m-0 p-0">
                <?php for ($i = 0; $i < count($prodotti_consigliati); $i++) : ?>
                    <li class="card col-4">
                        <img src="<?php echo UPLOAD_DIR . $prodotti_consigliati[$i]["ImgPath"]; ?>" alt="" />
                        <div class="card-body align-items-center p-2">
                            <h5 class="card-title m-0"><span class="visually-hidden">nome prodotto</span><?php echo $prodotti_consigliati[$i]["NomeProdotto"]; ?></h5>
                        </div>
                    </li>
                <?php endfor; ?>
                </ul>
            </li>
            <div class="carousel-control-prev" aria-hidden="true">
                <span class="carousel-control-prev-icon"></span>
            </div>
            <div class="carousel-control-next" aria-hidden="true">
                <span class="carousel-control-next-icon"></span>
            </div>
        </ul>
    </div>
<?php endif; ?>