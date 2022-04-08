<div class="row justify-content-center p-0 m-0">
    <div class="col-11 grid-container" id="user-home">
        <div class="d-flex" id="ordini">
            <!-- TODO: implementare la schermata ordini -->
            <a href="#" class="col-6 col-md-12 btn btn-outline-primary">ORDINI</a>
        </div>
        <div id="notifiche" class="d-flex justify-content-end align-items-center justify-content-md-start align-items-md-start">
            <!-- TODO: implementare la schermata notifiche -->
            <a href="#" class="d-md-none text-decoration-none">
                <img src="<?php if (!empty($templateParams["info-utente"]["Notifiche"]) && count($templateParams["info-utente"]["Notifiche"]) > 0) {
                                echo ICON_DIR . "active-bell.svg";
                            } else {
                                echo ICON_DIR . "bell.svg";
                            } ?>" alt="notifiche">
            </a>
            <div class="col-12 d-none d-md-flex flex-md-column">
                <div class="row">
                    <div class="col-12 p-0 d-flex align-items-center justify-content-between">
                        <h3 class="p-0 m-0">Notifiche</h3>
                        <a href="#">
                            <img src="<?php echo ICON_DIR; ?>bell.svg" alt="link da cliccare per accedere allo storico delle notifiche">
                        </a>
                    </div>
                </div>
                <!-- FIXME: mettere a posto la sezione notifiche -->
                <ul class="list-group gap-md-3 p-md-0 m-md-0 mh-25">
                    <?php for ($i = 0; $i<5; $i++): ?>
                        <li>
                            <div class="card col-12">
                                <div class="row">
                                    <div class="col-5">
                                        <!-- <img src="upload/categoryImgs/Bagno.png" alt="" /> -->
                                    </div>
                                    <div class="col-7 card-body">
                                        <h5 class="card-title m-0">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis ducimus voluptates debitis.</h5>
                                        <p class="card-text m-0">22/03</p>
                                    </div>
                                </div>
                            </div>
                        </li>
                    <?php endfor; ?>
                    
                    <?php if (count($templateParams["info-utente"]["Notifiche"]) > 0) :
                        foreach ($templateParams["info-utente"]["Notifiche"] as $notifica) : ?>
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
            <div class="col-12 white-column-container">
                <h3 class="mb-0">Dati spedizione</h3>
                <p class="mb-0">
                    <?php echo $templateParams["info-utente"]["NomeCompleto"]; ?><br />
                    <?php echo $templateParams["info-utente"]["IndirizzoSpedizione"]; ?><br />
                    <?php if (!empty($templateParams["info-utente"]["NumeroTelefono"])) : ?>
                        Numero di telefono: <?php echo $templateParams["info-utente"]["NumeroTelefono"]; ?>
                    <?php endif; ?>
                </p>
                <a class="col-7 col-sm-5 btn btn-primary d-md-flex justify-content-md-center align-items-md-center flex-md-grow-1" href="login.php?action=mod-info-spedizione">Modifica</a>
            </div>
        </div>
        <div class="row" id="info-carta">
            <div class="col-12 white-column-container">
                <h3 class="mb-0">Modalità di pagamento</h3>
                <p class="mb-0">
                    ****<?php echo substr($templateParams["info-utente"]["CodCarta"], -4); ?><br />
                    <?php echo $templateParams["info-utente"]["NomeCompletoIntestatario"]; ?><br />
                    Data Scadenza: <?php echo $templateParams["info-utente"]["MeseScadenza"]; ?>-<?php echo $templateParams["info-utente"]["AnnoScadenza"]; ?>
                </p>
                <a class="col-7 col-sm-5 btn btn-primary d-md-flex justify-content-md-center align-items-md-center flex-md-grow-1" href="login.php?action=mod-info-carta">Modifica</a>
            </div>
        </div>
        <div class="spacer"></div>
        <div id="logout">
            <a href="login.php?action=logout" class="col-7 col-md-12 btn btn-danger">Logout</a>
        </div>
    </div>
</div>