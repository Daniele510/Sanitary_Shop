<div class="row">
    <?php if (count($templateParams["prodotti-scontati"]) > 0) :
        $prodotti_scontati = $templateParams["prodotti-scontati"]; ?>
        <div id="offerteCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <?php for ($i = 0; $i < count($prodotti_scontati); $i++) : ?>
                    <div class="carousel-item <?php echo ($i==0 ? "active" : ""); ?>">
                        <div class="card flex-grow-1">
                            <div class="row g-0">
                                <div class="col-4">
                                    <img src="<?php echo UPLOAD_DIR . $prodotti_scontati[$i]["ImgPath"]; ?>" alt="" />
                                </div>
                                <div class="col-6 d-flex">
                                    <div class="card-body p-0">
                                        <h4 class="card-title">Offerta speciale</h4>
                                        <p class="card-text"><?php echo $prodotti_scontati[$i]["Sconto"]; ?>% di sconto su <?php echo $prodotti_scontati[$i]["NomeProdotto"]; ?></p>
                                        <a class="btn primary-dark col-md-4 mb-auto" href="#">dettagli</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endfor; ?>
            </div>
        </div>
    <?php endif; ?>
</div>

<!-- categorie -->
<div class="row d-flex justify-content-center" id="categorie" <?php if (count($templateParams["prodotti-scontati"]) > 0) : ?> style="margin: 33px 0;" <?php else : ?> style="margin: 0 0 33px 0;" <?php endif; ?>>
    <h1>Categoria</h1>
    <div class="col-12 col-md-11">
        <ul class="nav">
            <?php if (isset($templateParams["categorie"])) : ?>
                <?php foreach ($templateParams["categorie"] as $categoria) : ?>
                    <li class="nav-item col-6 col-md-3">
                        <a href="categoria.php?id=<?php echo $categoria["CodCategoria"]; ?>" class="text-dark text-decoration-none">
                            <figure class="figure nav-link mt-2 mx-2 text-center gb-none">
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
        <div id="carouselProdottiConsigliati" class="carousel carousel-dark slide" data-bs-interval="false">
            <div class="carousel-inner">
                <?php for ($i = 0; $i < count($prodotti_consigliati); $i++) : ?>
                    <div class="card col-4">
                        <img src="<?php echo UPLOAD_DIR . $prodotti_consigliati[$i]["ImgPath"]; ?>" alt="" />
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