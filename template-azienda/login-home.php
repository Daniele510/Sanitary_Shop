<div class="row d-flex justify-content-center p-0 m-0">
    <div class="col-11 grid-container" id="company-home">
        <div id="notifiche">
            <a href="#">
                <img src="<?php if (!empty($templateParams["info-azienda"]["Notifiche"]) && count($templateParams["info-azienda"]["Notifiche"]) > 0) {
                                echo ICON_DIR . "active-bell.svg";
                            } else {
                                echo ICON_DIR . "bell.svg";
                            } ?>" alt="notifiche">
            </a>
            <div class="col-12">
                <div class="row">
                    <div class="col-12 p-0 d-flex align-items-center justify-content-between">
                        <h3 class="p-0 m-0">Notifiche</h3>
                        <a href="#">
                            <img src="<?php echo ICON_DIR;?>bell.svg" alt="link da cliccare per accedere allo storico delle notifiche">
                        </a>
                    </div>
                </div>
                <ul>
                    <?php if (count($templateParams["info-azienda"]["Notifiche"]) > 0) :
                        foreach ($templateParams["info-azienda"]["Notifiche"] as $notifica) : ?>
                        <li>
                            <div class="card col-12">
                                <div class="row">
                                    <div class="col-5">
                                        <!-- <img src="upload/categoryImgs/Bagno.png" alt="" /> -->
                                    </div>
                                    <div class="col-7 card-body">
                                        <h5 class="card-title m-0"><?php echo $notifica["TitoloNotifica"]; ?></h5>
                                        <p class="card-text m-0"><?php echo $notifica["Data"]; ?></p>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <?php endforeach;
                    else : ?>
                        <li class="alert alert-info text-center mb-0" role="alert">
                            Non hai notifiche
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
        <div class="d-flex" id="titolo">
            <h1 class="m-0 p-0">Informazioni personali</h1>
        </div>
        <div class="row" id="info-addr">
            <div class="col-12 container">
                <?php if (isset($templateParams["info-azienda"])) : ?>
                    <p class="mb-0">
                        P.IVA: <?php echo $templateParams["info-azienda"]["CodVenditore"]; ?><br />
                        <?php echo $templateParams["info-azienda"]["NomeCompagnia"]; ?><br />
                        <?php echo $templateParams["info-azienda"]["Ind_Via"]; ?><br />
                        <?php echo $templateParams["info-azienda"]["Ind_Citta"]; ?><br />
                        <?php echo $templateParams["info-azienda"]["Ind_Paese"]; ?><br />
                        Numero di telefono: <?php echo $templateParams["info-azienda"]["NumeroTelefono"]; ?>
                    </p>
                <?php endif; ?>
                <a class="col-7 col-sm-5 btn primary" href="login.php?action=mod-info-azienda">Modifica</a>
            </div>
        </div>
        <div class="spacer"></div>
        <div id="logout">
            <a href="login.php?action=logout" class="col-7 col-md-12 btn btn-danger">Logout</a>
        </div>
    </div>
</div>