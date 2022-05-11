<div class="col-12 d-flex flex-column justify-content-center" id="home">
    <section>
        <?php if (count($templateParams["prodotti-scontati"]) > 0) :
            $prodotti_scontati = $templateParams["prodotti-scontati"]; ?>
            <div id="offerteCarousel" class="carousel slide col-lg-12 mx-lg-auto" data-bs-ride="carousel">
                <div class="carousel-inner m-0 p-0">
                    <?php for ($i = 0; $i < count($prodotti_scontati); $i++) : ?>
                        <div class="carousel-item <?php echo ($i == 0 ? "active" : ""); ?>">
                            <div class="card">
                                <div class="row g-0 flex-grow-1 px-3 px-md-5 justify-content-xxs-start">
                                    <div class="col-4 d-xxs-none">
                                        <img src="<?php echo UPLOAD_DIR . $prodotti_scontati[$i]["ImgPath"]; ?>" alt="" />
                                    </div>
                                    <div class="col-6 d-flex align-self-stretch flex-grow-xxs-1">
                                        <div class="card-body p-0 d-flex flex-column">
                                            <h4 class="card-title">Offerta speciale</h4>
                                            <p class="card-text flex-grow-1"><?php echo $prodotti_scontati[$i]["Sconto"]; ?>% di sconto su <?php echo $prodotti_scontati[$i]["NomeProdotto"]; ?></p>
                                            <a class="btn btn-primary-dark col-md-4 align-self-start" href="prodotto.php?id=<?php echo $prodotti_scontati[$i]["CodProdotto"];?>&idFornitore=<?php echo $prodotti_scontati[$i]["CodFornitore"]; ?>">dettagli</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endfor; ?>
                </div>
            </div>
        <?php endif; ?>
    </section>
    
    <!-- categorie -->
    <section class="col-12 d-flex flex-column align-items-center" id="categorie">
        <header class="col-11">
            <h1 class="m-0">Categoria</h1>
        </header>
        <div class="col-11 p-0 justify-content-center">
            <ul class="nav gap-5 gap-md-0 justify-content-evenly">
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
    </section>
    
    <!-- prodotti consigliati -->
    <?php if (count($templateParams["prodotti_consigliati"]) > 0) :
        $prodotti_consigliati = $templateParams["prodotti_consigliati"]; ?>
        <section class="p-0 m-0 d-flex flex-column align-items-center" id="prodotti-consigliati">
            <header class="col-11">
                <h1 class="m-0">Prodotti consigliati</h1>
            </header>
            <div class="col-12 m-0 p-0">
                <div id="carouselProdottiConsigliati" class="carousel carousel-dark" data-bs-interval="false">
                    <div class="carousel-inner">
                        <ul class="hstack m-0 p-0">
                            <?php for ($i = 0; $i < count($prodotti_consigliati); $i++) : ?>
                                <li class="card">
                                    <a class="text-decoration-none text-body" href="prodotto.php?id=<?php echo $prodotti_consigliati[$i]["CodProdotto"];?>&idFornitore=<?php echo $prodotti_consigliati[$i]["CodFornitore"]; ?>">
                                        <img src="<?php echo UPLOAD_DIR . $prodotti_consigliati[$i]["ImgPath"]; ?>" alt="" />
                                        <div class="card-body align-items-center p-2">
                                            <h5 class="card-title m-0"><span class="visually-hidden">nome prodotto</span><?php echo $prodotti_consigliati[$i]["NomeProdotto"]; ?></h5>
                                        </div>
                                    </a>
                                </li>
                            <?php endfor; ?>
                        </ul>
                    </div>
                    <div class="carousel-control-prev" aria-hidden="true">
                        <span class="carousel-control-prev-icon"></span>
                    </div>
                    <div class="carousel-control-next" aria-hidden="true">
                        <span class="carousel-control-next-icon"></span>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>
</div>