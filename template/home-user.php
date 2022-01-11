<div class="row offerte_box">
    <?php if (count($templateParams["prodotti-scontati"]) > 0) :
        $prodotti_scontati = $templateParams["prodotti-scontati"]; ?>
        <div id="offerteCarousel" class="carousel carousel-dark slide">
            <?php if (count($prodotti_scontati) > 1) : ?>
                <div class="carousel-indicators" style="margin-bottom: 0;">
                    <?php for ($i = 0; $i < count($prodotti_scontati); $i++) : ?>
                        <button type="button" data-bs-target="#offerteCarousel" data-bs-slide-to="<?php echo $i; ?>" aria-label="Slide <?php echo $i + 1; ?>"></button>
                    <?php endfor; ?>
                </div>
            <?php endif; ?>

            <div class="carousel-inner">
                <?php for ($i = 0; $i < count($prodotti_scontati); $i++) : ?>
                    <div class="carousel-item">
                        <div class="card" style="display: flex; border-radius: 10px; margin: 0 30px 0">
                            <div class="row g-0" style="flex-direction: row-reverse; justify-content: space-evenly; align-items: stretch; margin-bottom: 1rem;">
                                <div class="col-4">
                                    <img src="<?php echo UPLOAD_DIR . $prodotti_scontati[$i]["ImgPath"]; ?>" class="img-fluid" alt="" style="height: 100%; padding-top: 1rem;" />
                                </div>
                                <div class="col-6 d-flex">
                                    <div class="card-body" style="padding-right: 0; padding-bottom: 0;">
                                        <h5 class="card-title" style="margin-bottom: 8px;">Offerta speciale</h5>
                                        <p class="card-text" style="line-height: 22px;"><?php echo $prodotti_scontati[$i]["Sconto"]; ?>% di sconto su <?php echo $prodotti_scontati[$i]["NomeProdotto"]; ?></p>
                                        <a class="btn btn-dark" href="#" style="align-self: flex-end; padding: 0.1rem 0.8rem; border-radius: 10px; background: #324B4B;">dettagli</a>
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
<div class="row d-flex justify-content-center" id="categorie" style="margin: 33px 0;">
    <h1 style="margin: 0 0 14px 30px; text-transform: capitalize;">categoria</h1>
    <div class="col-12 col-md-10">
        <ul class="nav">
            <?php if (isset($templateParams["categorie"])) : ?>
                <?php foreach ($templateParams["categorie"] as $categoria) : ?>
                    <li class="nav-item col-6 col-md-3">
                        <a href="prodotti-categoria.php?id=<?php echo $categoria["CodCategoria"]; ?>" class="text-dark text-decoration-none">
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
    <div class="row">
        <h1 style="margin: 0 0 14px 30px;">Prodotti consigliati</h1>
        <div id="carouselProdottiConsigliati" class="carousel carousel-dark slide" data-bs-interval="false">
            <div class="carousel-inner" style="display: flex; overflow-x: auto; scroll-behavior: smooth; gap: 2rem; margin-left: 2rem;">
                <?php for ($i = 0; $i < count($prodotti_consigliati); $i++) : ?>
                    <div class="card col-4">
                        <img class="img-fluid" src="<?php echo UPLOAD_DIR . $prodotti_consigliati[$i]["ImgPath"]; ?>" alt="" />
                        <div class="card-body" style="display: flex; align-items: center;">
                            <h5 class="card-title" style="margin: 0;"><?php echo $prodotti_consigliati[$i]["NomeProdotto"]; ?></h5>
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