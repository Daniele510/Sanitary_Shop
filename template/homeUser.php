<div class="row">
    <!-- slider -->
    <div id="myCarousel" class="carousel carousel-dark slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="card d-inline">
                    <div class="row g-0 align-items-center">

                        <div class="col-4">
                            <img src="<?php echo UPLOAD_DIR . "Bagno.png"; ?>" class="img-fluid rounded-start" alt="" />
                        </div>
                        <div class="col-6">
                            <div class="card-body">
                                <h5 class="card-title">Offerta speciale</h5>
                                <p class="card-text">.30% di sconto su questo prodotto</p>
                                <p><a class="btn btn-lg btn-primary" href="#">dettagli</a></p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="card d-inline">
                    <div class="row g-0 align-items-center">
                        <div class="col-4">
                            <img src="<?php echo UPLOAD_DIR . "Superficie.png"; ?>" class="img-fluid rounded-start" alt="" />
                        </div>
                        <div class="col-6">
                            <div class="card-body overflow-hidden">
                                <h5 class="card-title">Card title</h5>
                                <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                <p><a class="btn btn-lg btn-primary" href="#">dettagli</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="card d-inline">
                    <div class="row g-0 align-items-center">

                        <div class="col-4">
                            <img src="<?php echo UPLOAD_DIR . "Bagno.png"; ?>" class="img-fluid rounded-start" alt="" />
                        </div>
                        <div class="col-6">
                            <div class="card-body">
                                <h5 class="card-title">Card title</h5>
                                <p class="card-text overflow-hidden">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                <p><a class="btn btn-lg btn-primary" href="#">dettagli</a></p>
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
<div class="row" id="categorie">
    <h1>categoria</h1>
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
<div class="row">
    <h1>prodotti consigliati</h1>
    <div class="col-12">
        <div id="carouselProdottiConsigliati" class="carousel carousel-dark slide" data-bs-ride="carousel" data-bs-interval="false">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="col-sm-4">
                        <div class="card" style="width: 18rem;">
                            <img class="img-fluid" src="<?php echo UPLOAD_DIR . "Superficie.png"; ?>" alt="" />
                            <div class="card-body">
                                <h5 class="card-title">Card title</h5>
                                <a href="#" class="btn btn-primary">Go somewhere</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="col-sm-4">
                        <div class="card" style="width: 18rem;">
                            <img class="img-fluid" src="<?php echo UPLOAD_DIR . "Superficie.png"; ?>" alt="" />
                                <div class="card-body">
                                    <h5 class="card-title">Card title</h5>
                                    <a href="#" class="btn btn-primary">Go somewhere</a>
                                </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="col-sm-4">
                        <div class="card" style="width: 18rem;">
                            <img class="img-fluid" src="<?php echo UPLOAD_DIR . "Superficie.png"; ?>" alt="" />
                                <div class="card-body">
                                    <h5 class="card-title">Card title</h5>
                                    <a href="#" class="btn btn-primary">Go somewhere</a>
                                </div>
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
