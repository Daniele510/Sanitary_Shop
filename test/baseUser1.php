<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link rel="stylesheet" href="./style1.css" />

    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

    <script src="script.js"></script>

    <title>Document</title>
</head>

<body style="background: #E3F5F5;">
    <div class="container-fluid p-0 overflow-hidden">
        <main>
            <div class="row">
                <div id="carouselProdottiConsigliati" class="carousel carousel-dark slide" data-bs-interval="false">
                    <div class="carousel-inner" style="display: flex; overflow-x: auto; scroll-behavior: smooth; gap: 2rem; margin-left: 2rem;">
                        <?php for ($i = 0; $i < 5; $i++) : ?>
                            <div class="card col-4" style="margin: 0;">
                                <img class="img-fluid" src="../upload/categoryImgs/Bagno.png" alt="" />
                                <div class="card-body" style="display: flex; justify-content: space-between;">
                                    <h5 class="card-title" style="margin: 0;">card title</h5>
                                    <a class="btn btn-dark" href="#" style="justify-self: end; padding: 0.1rem 0.8rem; border-radius: 10px; background: #324B4B;">dettagli</a>
                                </div>
                            </div>
                        <?php endfor; ?>
                        <div class="card col-4" style="margin: 0 2rem 0 0;">
                            <img class="img-fluid" src="../upload/categoryImgs/Bagno.png" alt="" />
                            <div class="card-body" style="display: flex; justify-content: space-between;">
                                <h5 class="card-title" style="margin: 0;">card title</h5>
                                <a class="btn btn-dark" href="#" style="justify-self: end; padding: 0.1rem 0.8rem; border-radius: 10px; background: #324B4B;">dettagli</a>
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
        </main>
    </div>


    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->

</body>

</html>