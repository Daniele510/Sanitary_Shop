<nav class="navbar col-12 header-sticky" <?php echo (isset($templateParams["ColoreCategoria"]) && $templateParams["ColoreCategoria"] !== "06ACB8" ? 'style="background: radial-gradient(137.85% 1032.58% at -21.73% 36.36%, #' . $templateParams["ColoreCategoria"] . ' 0%, #F0F7FA 100%); border-bottom: 1px solid #' . $templateParams["ColoreCategoria"] . ';"' : ""); ?>>
    <ul class="navbar-nav small-screen fixed-bottom col-12 d-flex justify-content-around align-items-center flex-row bg-white col-md-5 justify-content-md-start" <?php echo (isset($templateParams["ColoreCategoria"]) && $templateParams["ColoreCategoria"] !== "06ACB8" ? 'style="border-top: 1px solid #' . $templateParams["ColoreCategoria"] . ';"' : ""); ?>>
        <li class="nav-item d-flex justify-content-center allign-items-center w-auto">
            <a class="nav-link<?php isActive("index.php"); ?> text-reset me-md-auto" href="../../Sanitary_Shop/index.php">
                <svg viewBox="0 0 56 56" xmlns="http://www.w3.org/2000/svg" aria-labelledby="home-icon" role="img">
                    <title id="home-icon">home</title>
                    <rect width="56" height="56" rx="10" />
                    <path d="M11.6667 51.3336H44.3333C45.571 51.3336 46.758 50.8419 47.6332 49.9667C48.5083 49.0915 49 47.9046 49 46.6669V25.6669C49.0018 25.3598 48.9429 25.0554 48.8268 24.7711C48.7107 24.4868 48.5396 24.2282 48.3233 24.0102L29.6567 5.34356C29.2195 4.90897 28.6281 4.66504 28.0117 4.66504C27.3952 4.66504 26.8038 4.90897 26.3667 5.34356L7.7 24.0102C7.47953 24.2263 7.30413 24.484 7.18397 24.7684C7.06381 25.0528 7.00128 25.3582 7 25.6669V46.6669C7 47.9046 7.49167 49.0915 8.36683 49.9667C9.242 50.8419 10.429 51.3336 11.6667 51.3336ZM23.3333 46.6669V35.0002H32.6667V46.6669H23.3333ZM11.6667 26.6236L28 10.2902L44.3333 26.6236V46.6669H37.3333V35.0002C37.3333 33.7625 36.8417 32.5756 35.9665 31.7004C35.0913 30.8252 33.9043 30.3336 32.6667 30.3336H23.3333C22.0957 30.3336 20.9087 30.8252 20.0335 31.7004C19.1583 32.5756 18.6667 33.7625 18.6667 35.0002V46.6669H11.6667V26.6236Z" />
                </svg>
            </a>
        </li>
        <?php if (!isCompanyLoggedIn()) : ?>
            <li class="nav-item d-flex justify-content-center allign-items-center w-auto">
                <a class="nav-link<?php isActive("carrello.php"); ?> text-reset ms-md-auto" href="carrello.php">
                    <svg viewBox="0 0 56 56" xmlns="http://www.w3.org/2000/svg" aria-labelledby="cart-icon" role="img">
                        <title id="cart-icon">carrello</title>
                        <rect width="56" height="56" rx="10" />
                        <path d="M50.918 17.339C50.7033 17.0288 50.4167 16.7753 50.0827 16.6002C49.7487 16.425 49.3771 16.3335 49 16.3333H17.1103L14.4176 9.87001C14.0646 9.01886 13.4667 8.29172 12.6999 7.78077C11.933 7.26982 11.0318 6.99808 10.1103 7.00001H4.66663V11.6667H10.1103L21.1796 38.2317C21.3569 38.6567 21.656 39.0198 22.0393 39.2751C22.4225 39.5305 22.8728 39.6667 23.3333 39.6667H42C42.973 39.6667 43.8433 39.0623 44.1863 38.1547L51.1863 19.488C51.3186 19.1348 51.3633 18.7548 51.3165 18.3805C51.2698 18.0062 51.133 17.6489 50.918 17.339ZM40.383 35H24.8896L19.0563 21H45.633L40.383 35Z" />
                        <path d="M24.5 49C26.433 49 28 47.433 28 45.5C28 43.567 26.433 42 24.5 42C22.567 42 21 43.567 21 45.5C21 47.433 22.567 49 24.5 49Z" />
                        <path d="M40.8334 49C42.7664 49 44.3334 47.433 44.3334 45.5C44.3334 43.567 42.7664 42 40.8334 42C38.9004 42 37.3334 43.567 37.3334 45.5C37.3334 47.433 38.9004 49 40.8334 49Z" />
                    </svg>
                </a>
            </li>
            <li class="nav-item d-flex justify-content-center allign-items-center w-auto">
                <a class="nav-link<?php isActive("login.php"); ?> text-reset ms-md-4" href="login.php" id="login_link">
                    <svg viewBox="0 0 56 56" xmlns="http://www.w3.org/2000/svg" aria-labelledby="login-icon" role="img">
                        <title id="login-icon">area utente</title>
                        <rect width="56" height="56" rx="10" />
                        <path d="M17.5 15.1665C17.5 20.9555 22.211 25.6665 28 25.6665C33.789 25.6665 38.5 20.9555 38.5 15.1665C38.5 9.3775 33.789 4.6665 28 4.6665C22.211 4.6665 17.5 9.3775 17.5 15.1665ZM46.6667 48.9998H49V46.6665C49 37.6622 41.671 30.3332 32.6667 30.3332H23.3333C14.3267 30.3332 7 37.6622 7 46.6665V48.9998H46.6667Z" />
                    </svg>
                </a>
            </li>
        <?php else : ?>
            <li class="nav-item d-flex justify-content-center allign-items-center justify-content-md-start w-auto">
                <a class="nav-link<?php isActive("prodotti-compagnia.php"); ?> text-reset ms-md-auto" href="../../Sanitary_Shop/area-aziende/prodotti-compagnia.php">
                    <svg viewBox="0 0 56 56" xmlns="http://www.w3.org/2000/svg" aria-labelledby="prod-icon" role="img">
                        <title id="prod-icon">prodotti</title>
                        <path d="M35.7839 55.9545L52.6276 52.3092C52.6276 52.3092 46.5481 11.2122 46.5026 10.9375C46.4571 10.6628 46.2296 10.4913 46.0109 10.4913C45.7834 10.4913 41.5081 10.1728 41.5081 10.1728C41.5081 10.1728 38.5279 7.20125 38.1446 6.88275C38.0653 6.8041 37.9689 6.74481 37.8629 6.7095L35.7296 55.9562L35.7839 55.9545ZM27.3261 26.3778C27.3261 26.3778 25.4309 25.3925 23.1874 25.3925C19.8064 25.3925 19.6786 27.4977 19.6786 28.0543C19.6786 30.926 27.2351 32.0547 27.2351 38.8552C27.2351 44.205 23.8716 47.6227 19.2866 47.6227C13.7899 47.6227 11.0284 44.205 11.0284 44.205L12.5316 39.3382C12.5316 39.3382 15.4384 41.8267 17.8551 41.8267C19.4319 41.8267 20.1336 40.5597 20.1336 39.648C20.1336 35.875 13.9351 35.7018 13.9351 29.4858C13.8529 24.2638 17.5996 19.1765 25.2016 19.1765C28.1364 19.1765 29.5766 20.0148 29.5766 20.0148L27.3716 26.3585L27.3261 26.3778ZM26.0679 1.932C26.3776 1.932 26.6961 2.023 27.0059 2.2505C24.7081 3.3355 22.1934 6.0795 21.1539 11.5658C19.694 12.0407 18.2262 12.4906 16.7509 12.915C17.9549 8.75 20.8791 1.96 26.0661 1.96L26.0679 1.932ZM28.9484 8.813V9.1315C27.1896 9.66875 25.2471 10.262 23.3606 10.8448C24.4456 6.69725 26.4686 4.67425 28.2274 3.91825C28.6736 5.0855 28.9466 6.66225 28.9466 8.813H28.9484ZM30.2049 3.61025C31.8184 3.77475 32.8666 5.6245 33.5316 7.7035C32.7196 7.96775 31.8184 8.24075 30.8331 8.5505V7.96775C30.8331 6.209 30.6056 4.76875 30.2049 3.6015V3.61025ZM37.1874 6.61675C37.1331 6.61675 37.0421 6.66225 37.0054 6.66225C36.9599 6.66225 36.3316 6.8355 35.3376 7.154C34.3524 4.2735 32.5936 1.62225 29.4856 1.62225H29.2126C28.3201 0.49175 27.2264 0 26.2866 0C19.0399 0 15.5766 9.051 14.4916 13.6447C11.7021 14.4917 9.67911 15.1217 9.45161 15.2127C7.87486 15.7133 7.82936 15.7605 7.64736 17.2445C7.47411 18.3207 3.38086 50.057 3.38086 50.057L35.0174 56L37.1874 6.61675Z" />
                    </svg>
                </a>
            </li>
            <li class="nav-item d-flex justify-content-center allign-items-center justify-content-md-start w-auto">
                <a class="nav-link<?php isActive("login.php"); ?> text-reset ms-md-4" href="../../Sanitary_Shop/area-aziende/login.php" id="login_link">
                    <svg viewBox="0 0 56 56" xmlns="http://www.w3.org/2000/svg" aria-labelledby="login-icon" role="img">
                        <title id="login-icon">area azienda</title>
                        <rect width="56" height="56" rx="10" />
                        <path d="M17.5 15.1665C17.5 20.9555 22.211 25.6665 28 25.6665C33.789 25.6665 38.5 20.9555 38.5 15.1665C38.5 9.3775 33.789 4.6665 28 4.6665C22.211 4.6665 17.5 9.3775 17.5 15.1665ZM46.6667 48.9998H49V46.6665C49 37.6622 41.671 30.3332 32.6667 30.3332H23.3333C14.3267 30.3332 7 37.6622 7 46.6665V48.9998H46.6667Z" />
                    </svg>
                </a>
            </li>
        <?php endif; ?>
    </ul>
    <?php if (!empty($templateParams["back"])) : ?>
        <button class="btn p-0 d-md-none back ms-2"><img src="<?php echo ICON_DIR; ?>back.svg" alt="torna indietro"></button>
    <?php endif; ?>
    <?php if (empty($templateParams["no-search"])) : ?>
        <form action="<?php echo isCompanyLoggedIn() && basename($_SERVER['PHP_SELF']) == "prodotti-compagnia.php" ? "prodotti-compagnia.php" : "ricerca-prodotto.php"; ?>" method="GET" class="col-9 d-flex col-md-6 mx-auto">
            <input class="form-control" type="search" list="suggestions" placeholder="Search" aria-label="Search" name="NomeProdotto" <?php if (isset($filtri["NomeProdotto"])) : ?> value="<?php echo $filtri["NomeProdotto"]; ?>" <?php endif; ?>>
            <datalist id="suggestions">
            </datalist>
            <button class="btn btn-search" type="submit">
                <img src="<?php echo ICON_DIR . "search-icon.svg"; ?>" alt="">
            </button>
        </form>
    <?php endif; ?>
</nav>