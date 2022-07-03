<section class="row justify-content-center">
  <div class="col-10 d-flex flex-column gap-4 col-md-11">
    <div class="d-flex">
      <button class="btn p-0 d-none d-md-block back w-auto"><img src="<?php echo ICON_DIR; ?>back.svg" alt="torna indietro"></button>
      <h2 class="mx-auto">Storico ordini</h2>
    </div>
    <div class="col-12 d-flex gap-5 justify-content-lg-between" id="container_ordini">
    <?php if (!empty($templateParams["ordini"])) : ?>
      <ul class="list-group p-0 col-12 col-lg-5">
        <?php foreach ($templateParams["ordini"] as $ordine) : ?>
          <li class="list-group-item d-flex align-items-start flex-wrap justify-content-between">
            <div class="card col-12 p-2">
              <div class="row g-0 p-0 m-0 gap-3 gap-lg-5">
                <div class="col-12 p-0 m-0">
                  <div class="card-body justify-content-between h-100 p-0">
                    <p class="card-title fs-5 fw-bold">ordine n° <?php echo $ordine["CodOrdine"] ?></p>
                    <p class="card-text fw-lighter me-3"><small><?php echo $ordine["DataOrdine"] ?></small></p>
                    <input type="hidden" value="<?php echo $ordine["CodOrdine"] ?>" name="CodOrdine">
                  </div>
                </div>
              </div>
            </div>
          </li>
        <?php endforeach; ?>
      </ul>
      <section id="box_info_ordine" class="d-lg-flex justify-content-center col-12 opacity-0 opacity-lg-100 align-items-start">
        <?php if (!empty($templateParams["dettagli-ordine"]) && !empty($templateParams["lista-prodotti"])) : ?>
            <div class="col-lg-10 justify-content-end d-flex flex-column gap-4">
              <h2 class="col-12 m-0">Info ordine</h2>
              <div class="col-md-12 d-flex flex-column spacing-2">

                <section class="white-container">
                  <div class="m-0 d-flex fw-light">
                    Data dell'ordine: <span class="ms-auto"><?php echo $templateParams["dettagli-ordine"]["DataOrdine"]; ?></span>
                  </div>
                  <div class="m-0 d-flex fw-light">
                    Numero ordine: <span class="ms-auto"><?php echo $templateParams["dettagli-ordine"]["CodOrdine"]; ?></span>
                  </div>
                  <div class="m-0 d-flex fw-bold">
                    Totale:<span class="ms-auto">EUR <?php echo $templateParams["dettagli-ordine"]["ImportoConSconto"]; ?></span><span class="fw-normal"><?php echo " (" . $templateParams["num-articoli"] . ($templateParams["num-articoli"] == 1 ? " arcicolo" : " articoli") . ")"; ?></span>
                  </div>
                </section>

                <section>
                  <h3>Indirizzo di spedizione</h3>
                  <div class="white-container">
                    <p class="mb-0">
                      <?php echo $templateParams["dettagli-ordine"]["NomeCompletoIntestatario"]; ?><br />
                      <?php echo $templateParams["dettagli-ordine"]["IndirizzoConsegna"]; ?><br />
                    </p>
                  </div>
                </section>

                <section>
                  <h3>Informazioni di pagamento</h3>
                  <div class="white-container">
                    <p class="mb-0">
                      ****<?php echo substr($templateParams["dettagli-ordine"]["CodCarta"], -4); ?><br />
                      <?php echo $templateParams["dettagli-ordine"]["NomeCompletoIntestatario"]; ?><br />
                      Data Scadenza: <?php echo $templateParams["dettagli-ordine"]["MeseScadenza"]; ?> / <?php echo $templateParams["dettagli-ordine"]["AnnoScadenza"]; ?>
                    </p>
                  </div>
                </section>

                <section class="white-container">
                  <div class="m-0 d-flex fw-light">
                    Articoli: <span class="ms-auto"><?php echo $templateParams["dettagli-ordine"]["ImportoSenzaSconto"]; ?> €</span>
                  </div>
                  <div class="m-0 d-flex fw-light">
                    Sconto applicato: <span class="ms-auto"><?php echo $templateParams["dettagli-ordine"]["ScontoTotale"]; ?> €</span>
                  </div>
                  <div class="m-0 d-flex fw-bold">
                    Totale: <span class="ms-auto"><?php echo $templateParams["dettagli-ordine"]["ImportoConSconto"]; ?> €</span>
                  </div>
                </section>
              </div>
              <section id="box_lista_prodotti">
                <h4>Dettagli prodotti ordine</h4>
                <ul class="list-group p-0 col-12">
                  <?php foreach ($templateParams["lista-prodotti"] as $prodotto) : ?>
                    <li class="col-12 list-group-item">
                      <div class="card col-12 p-2">
                        <div class="row g-0 p-0 m-0 justify-content-between justify-content-xl-start gap-xl-4 justify-content-xxs-start">
                          <div class="col-4 align-self-center d-xxs-none">
                            <img src="<?php echo UPLOAD_DIR . $prodotto["ImgPath"]; ?>" alt="" />
                          </div>
                          <div class="col-7 col-lg-6 p-0 m-0 flex-grow-xxs-1 flex-grow-xl-1">
                            <div class="card-body d-flex flex-wrap">
                              <p class="card-text col-12 mb-4"><span class="visually-hidden">nome prodotto</span><?php echo $prodotto["NomeProdotto"]; ?></p>
                              <p class="card-text m-0 mt-2 col-12 fw-bold">
                                <span class="visually-hidden">prezzo</span>
                                <?php echo round($prodotto["PrezzoVendita"], 2); ?>€
                              </p>
                              <p class="card-text m-0 mt-3 col-12">Quantità: <?php echo $prodotto["Qta"] ?></p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </li>
                  <?php endforeach; ?>
                </ul>
              </section>
            </div>
          <?php endif; ?>
      </section>
    <?php endif; ?>
    </div>
  </div>
</section>