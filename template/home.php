<div class="row offerte_box">
    <?php if (count($templateParams["prodotti-scontati"]) > 0) :
        $prodotti_scontati = $templateParams["prodotti-scontati"]; ?>
        <div id="offerteCarousel" class="carousel carousel-dark slide">
            <?php if (count($prodotti_scontati) > 1) : ?>
                <div class="carousel-indicators">
                    <?php for ($i = 0; $i < count($prodotti_scontati); $i++) : ?>
                        <button type="button" data-bs-target="#offerteCarousel" data-bs-slide-to="<?php echo $i; ?>" aria-label="Slide <?php echo $i + 1; ?>"></button>
                    <?php endfor; ?>
                </div>
            <?php endif; ?>

            <div class="carousel-inner">
                <?php for ($i = 0; $i < count($prodotti_scontati); $i++) : ?>
                    <div class="carousel-item">
                        <div class="card">
                            <div class="row g-0">
                                <div class="col-4">
                                    <img src="<?php echo UPLOAD_DIR . $prodotti_scontati[$i]["ImgPath"]; ?>" class="img-fluid" alt="" />
                                </div>
                                <div class="col-6 d-flex">
                                    <div class="card-body px-0">
                                        <h5 class="card-title mb-2">Offerta speciale</h5>
                                        <p class="card-text"><?php echo $prodotti_scontati[$i]["Sconto"]; ?>% di sconto su <?php echo $prodotti_scontati[$i]["NomeProdotto"]; ?></p>
                                        <a class="btn primary-dark" href="#">dettagli</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endfor; ?>
            </div>
            <?php if (count($prodotti_scontati) > 1) : ?>
                <button class="carousel-control-prev d-flex" type="button" data-bs-target="#offerteCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon " aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next"type="button" data-bs-target="#offerteCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</div>

<!-- categorie -->
<div class="row d-flex justify-content-center" id="categorie">
    <h1>Categoria</h1>
    <div class="col-12 col-md-11">
        <ul class="nav">
            <?php if (isset($templateParams["categorie"])) : ?>
                <?php foreach ($templateParams["categorie"] as $categoria) : ?>
                    <li class="nav-item col-6 col-md-3">
                        <a href="categoria.php?id=<?php echo $categoria["CodCategoria"]; ?>" class="text-dark text-decoration-none">
                            <figure class="figure nav-link mt-2 mx-2 text-center gb-none">
                                <img src="<?php echo UPLOAD_DIR . $categoria["ImgPath"]; ?>" class="figure-img img-fluid rounded" alt="" />
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
        <div id="carouselProdottiConsigliati" class="carousel carousel-dark slide" data-bs-interval="false">
            <div class="carousel-inner">
                <?php for ($i = 0; $i < count($prodotti_consigliati); $i++) : ?>
                    <div class="card col-4">
                        <img class="img-fluid" src="<?php echo UPLOAD_DIR . $prodotti_consigliati[$i]["ImgPath"]; ?>" alt="" />
                        <div class="card-body align-items-center p-2">
                            <h5 class="card-title m-0"><?php echo $prodotti_consigliati[$i]["NomeProdotto"]; ?></h5>
                        </div>
                    </div>
                <?php endfor; ?>
            </div>
            <button class="carousel-control-prev" type="button">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
<?php endif; ?>