<div class="row">
    <!-- slider data-bs-interval="false" to block the slide-->
    <div id="myCarousel" class="carousel carousel-dark slide" data-bs-ride="carousel" style="margin-bottom: 33px;">
        <div class="carousel-indicators" style="margin-bottom: 0;">
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <!-- TODO: presa di n prdootti random scontati dal database  -->
            <div class="carousel-item active">
                <div class="card" style="display: flex; border-radius: 10px; margin: 20px 30px 0px">
                    <div class="row g-0" style="flex-direction: row-reverse; justify-content: space-evenly; align-items: stretch; margin-bottom: 1rem;">
                        <div class="col-4">
                            <img src="<?php echo UPLOAD_DIR . "Bagno.png"; ?>" class="img-fluid" alt="" style="height: 100%; padding-top: 1rem;" />
                        </div>
                        <div class="col-6 d-flex">
                            <div class="card-body" style="padding-right: 0; padding-bottom: 0;">
                                <h5 class="card-title" style="margin-bottom: 8px;">Offerta speciale</h5>
                                <p class="card-text" style="line-height: 22px;">.30% di sconto su questo prodotto</p>
                                <a class="btn btn-dark" href="#" style="align-self: flex-end; padding: 0.1rem 0.8rem; border-radius: 10px; background: #324B4B;">dettagli</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="card" style="display: flex; border-radius: 10px; margin: 20px 30px 0px">
                    <div class="row g-0" style="flex-direction: row-reverse; justify-content: space-evenly; align-items: stretch; margin-bottom: 1rem;">
                        <div class="col-4">
                            <img src="<?php echo UPLOAD_DIR . "Bagno.png"; ?>" class="img-fluid" alt="" style="height: 100%; padding-top: 1rem;" />
                        </div>
                        <div class="col-6 d-flex">
                            <div class="card-body" style="padding-right: 0; padding-bottom: 0;">
                                <h5 class="card-title" style="margin-bottom: 8px;">Offerta speciale</h5>
                                <p class="card-text" style="line-height: 22px;">.30% di sconto su questo prodotto</p>
                                <a class="btn btn-dark" href="#" style="align-self: flex-end; padding: 0.1rem 0.8rem; border-radius: 10px; background: #324B4B;">dettagli</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item ">
                <div class="card" style="display: flex; border-radius: 10px; margin: 20px 30px 0px">
                    <div class="row g-0" style="flex-direction: row-reverse; justify-content: space-evenly; align-items: stretch; margin-bottom: 1rem;">
                        <div class="col-4">
                            <img src="<?php echo UPLOAD_DIR . "Bagno.png"; ?>" class="img-fluid" alt="" style="height: 100%; padding-top: 1rem;" />
                        </div>
                        <div class="col-6 d-flex">
                            <div class="card-body" style="padding-right: 0; padding-bottom: 0;">
                                <h5 class="card-title" style="margin-bottom: 8px;">Offerta speciale</h5>
                                <p class="card-text" style="line-height: 22px;">.30% di sconto su questo prodotto</p>
                                <a class="btn btn-dark" href="#" style="align-self: flex-end; padding: 0.1rem 0.8rem; border-radius: 10px; background: #324B4B;">dettagli</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>

<!-- categorie -->
<!-- TODO:prendere le categorie dal database  -->
<div class="row" id="categorie" style="margin-bottom: 33px;">
    <h1 style="margin: 0 0 14px 30px; text-transform: capitalize;">categoria</h1>
    <div class="col-md-1 col-sm-2"></div>
    <div class="col-12 col-md-10">
        <ul class="nav">
            <li class="nav-item col-6 col-md-3">
                <a href="#" class="text-dark text-decoration-none">
                    <figure class="figure nav-link mt-2 mx-2 text-center gb-none">
                        <img src="<?php echo UPLOAD_DIR . "Superficie.png"; ?>" class="figure-img img-fluid rounded" alt="" />
                        <figcaption class="figure-caption">prodotti multiuso</figcaption>
                    </figure>
                </a>
            </li>
            <li class="nav-item col-6 col-md-3">
                <a href="#" class="text-dark text-decoration-none">
                    <figure class="figure nav-link mt-2 mx-2 text-center gb-none">
                        <img src="<?php echo UPLOAD_DIR . "Bagno.png"; ?>" class="figure-img img-fluid rounded" alt="" />
                        <figcaption class="figure-caption">prodotti cucina</figcaption>
                    </figure>
                </a>
            </li>
            <li class="nav-item col-6 col-md-3">
                <a href="#" class="text-dark text-decoration-none">
                    <figure class="figure nav-link mt-2 mx-2 text-center gb-none">
                        <img src="<?php echo UPLOAD_DIR . "Bagno.png"; ?>" class="figure-img img-fluid rounded" alt="" />
                        <figcaption class="figure-caption">prodotti bagno</figcaption>
                    </figure>
                </a>
            </li>
            <li class="nav-item col-6 col-md-3">
                <a href="#" class="text-dark text-decoration-none">
                    <figure class="figure nav-link mt-2 mx-2 text-center gb-none outline-dark">
                        <img src="<?php echo UPLOAD_DIR . "Altro.png"; ?>" class="figure-img img-fluid rounded" alt="" />
                        <figcaption class="figure-caption">altro</figcaption>
                    </figure>
                </a>
            </li>
        </ul>
    </div>
    <div class="col-md-1 col-sm-2"></div>
</div>

<!-- prodotti consigliati -->
<!-- TODO:prendere i prodotti dal database -->
<div class="row">
    <h1 style="margin: 0 0 14px 30px;">Prodotti consigliati</h1>
    <div class="col-12">
        <div id="carouselProdottiConsigliati" class="carousel carousel-dark slide" data-bs-interval="false">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="card col-4" style="margin: 0 30px;">
                        <img class="img-fluid" src="<?php echo UPLOAD_DIR . "Superficie.png"; ?>" alt="" />
                        <div class="card-body" style="display: flex; justify-content: space-between;">
                            <h5 class="card-title" style="margin: 0;">Card title</h5>
                            <a class="btn btn-dark" href="#" style="justify-self: end; padding: 0.1rem 0.8rem; border-radius: 10px; background: #324B4B;">dettagli</a>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="card col-4" style="margin: 0 30px;">
                        <img class="img-fluid" src="<?php echo UPLOAD_DIR . "Superficie.png"; ?>" alt="" />
                        <div class="card-body" style="display: flex; justify-content: space-between;">
                            <h5 class="card-title" style="margin: 0;">Card title</h5>
                            <a class="btn btn-dark" href="#" style="justify-self: end; padding: 0.1rem 0.8rem; border-radius: 10px; background: #324B4B;">dettagli</a>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="card col-4" style="margin: 0 30px;">
                        <img class="img-fluid" src="<?php echo UPLOAD_DIR . "Superficie.png"; ?>" alt="" />
                        <div class="card-body" style="display: flex; justify-content: space-between;">
                            <h5 class="card-title" style="margin: 0;">Card title</h5>
                            <a class="btn btn-dark" href="#" style="justify-self: end; padding: 0.1rem 0.8rem; border-radius: 10px; background: #324B4B;">dettagli</a>
                        </div>
                    </div>
                </div>
            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#carouselProdottiConsigliati" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselProdottiConsigliati" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
</div>