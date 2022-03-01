<nav class="navbar col-12 header-sticky" <?php if (isset($templateParams["ColoreCategoria"]) && $templateParams["ColoreCategoria"] !== "06ACB8") {
                                echo 'style="background: radial-gradient(137.85% 1032.58% at -21.73% 36.36%, #' . $templateParams["ColoreCategoria"] . ' 0%, #F0F7FA 100%); border-bottom: 1px solid #' . $templateParams["ColoreCategoria"] . ';"';
                            } ?>>
    <ul class="navbar-nav fixed-bottom col-12 col-md-5" <?php if (isset($templateParams["ColoreCategoria"]) && $templateParams["ColoreCategoria"] !== "06ACB8") {
                                                            echo 'style="border-top: 1px solid #' . $templateParams["ColoreCategoria"] . ';"';
                                                        } ?>>
        <li class="nav-item col-4 col-md-2">
            <a class="nav-link<?php isActive("index.php"); ?>" href="index.php">
                <div>HOME</div>
                <svg width="32" height="32" viewBox="0 0 56 56" fill="none" xmlns="http://www.w.org/2000/svg" aria-labelledby="home-icon" role="img">
                    <title id="home-icon">Home</title>
                    <rect width="56" height="56" rx="10" fill="none" />
                    <path d="M11.6667 51.3336H44.3333C45.571 51.3336 46.758 50.8419 47.6332 49.9667C48.5083 49.0915 49 47.9046 49 46.6669V25.6669C49.0018 25.3598 48.9429 25.0554 48.8268 24.7711C48.7107 24.4868 48.5396 24.2282 48.3233 24.0102L29.6567 5.34356C29.2195 4.90897 28.6281 4.66504 28.0117 4.66504C27.3952 4.66504 26.8038 4.90897 26.3667 5.34356L7.7 24.0102C7.47953 24.2263 7.30413 24.484 7.18397 24.7684C7.06381 25.0528 7.00128 25.3582 7 25.6669V46.6669C7 47.9046 7.49167 49.0915 8.36683 49.9667C9.242 50.8419 10.429 51.3336 11.6667 51.3336ZM23.3333 46.6669V35.0002H32.6667V46.6669H23.3333ZM11.6667 26.6236L28 10.2902L44.3333 26.6236V46.6669H37.3333V35.0002C37.3333 33.7625 36.8417 32.5756 35.9665 31.7004C35.0913 30.8252 33.9043 30.3336 32.6667 30.3336H23.3333C22.0957 30.3336 20.9087 30.8252 20.0335 31.7004C19.1583 32.5756 18.6667 33.7625 18.6667 35.0002V46.6669H11.6667V26.6236Z" fill="#324B4B" />
                </svg>
            </a>
        </li>
        <!--TODO: classe cart.php  ?> -->
        <li class="nav-item col-4 col-md-2">
            <a class="nav-link<?php isActive("carrello.php");?>" href="carrello.php">
                <div>CART</div>
                <svg width="32" height="32" viewBox="0 0 56 56" fill="none" xmlns="http://www.w3.org/2000/svg" aria-labelledby="cart-icon" role="img">
                    <title id="cart-icon">Cart</title>
                    <rect width="56" height="56" rx="10" fill="none" />
                    <path d="M50.918 17.339C50.7033 17.0288 50.4167 16.7753 50.0827 16.6002C49.7487 16.425 49.3771 16.3335 49 16.3333H17.1103L14.4176 9.87001C14.0646 9.01886 13.4667 8.29172 12.6999 7.78077C11.933 7.26982 11.0318 6.99808 10.1103 7.00001H4.66663V11.6667H10.1103L21.1796 38.2317C21.3569 38.6567 21.656 39.0198 22.0393 39.2751C22.4225 39.5305 22.8728 39.6667 23.3333 39.6667H42C42.973 39.6667 43.8433 39.0623 44.1863 38.1547L51.1863 19.488C51.3186 19.1348 51.3633 18.7548 51.3165 18.3805C51.2698 18.0062 51.133 17.6489 50.918 17.339ZM40.383 35H24.8896L19.0563 21H45.633L40.383 35Z" fill="#324B4B" />
                    <path d="M24.5 49C26.433 49 28 47.433 28 45.5C28 43.567 26.433 42 24.5 42C22.567 42 21 43.567 21 45.5C21 47.433 22.567 49 24.5 49Z" fill="#324B4B" />
                    <path d="M40.8334 49C42.7664 49 44.3334 47.433 44.3334 45.5C44.3334 43.567 42.7664 42 40.8334 42C38.9004 42 37.3334 43.567 37.3334 45.5C37.3334 47.433 38.9004 49 40.8334 49Z" fill="#324B4B" />
                </svg>
            </a>
        </li>
        <li class="nav-item col-4 col-md-2">
            <a class="nav-link<?php isActive("login.php"); ?>" href="login.php">
                <div>USER</div>
                <svg width="32" height="32" viewBox="0 0 56 56" fill="none" xmlns="http://www.w3.org/2000/svg" aria-labelledby="login-icon" role="img">
                    <title id="login-icon">User</title>
                    <rect width="56" height="56" rx="10" fill="none" />
                    <path d="M17.5 15.1665C17.5 20.9555 22.211 25.6665 28 25.6665C33.789 25.6665 38.5 20.9555 38.5 15.1665C38.5 9.3775 33.789 4.6665 28 4.6665C22.211 4.6665 17.5 9.3775 17.5 15.1665ZM46.6667 48.9998H49V46.6665C49 37.6622 41.671 30.3332 32.6667 30.3332H23.3333C14.3267 30.3332 7 37.6622 7 46.6665V48.9998H46.6667Z" fill="#324B4B" />
                </svg>
            </a>
        </li>
    </ul>
    <form action="ricerca-prodotto.php" method="GET" class="col-9 col-md-6">
        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="NomeProdotto" <?php if (isset($filtri["NomeProdotto"])): ?> value="<?php echo $filtri["NomeProdotto"]; ?>" <?php endif; ?>>
        <button class="btn outline_secondary" type="submit">
            <img src="<?php echo UPLOAD_DIR . "iconImgs/search-icon.svg"; ?>" alt="">
        </button>
    </form>
</nav>