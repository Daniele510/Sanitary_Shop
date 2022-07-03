<div class="row justify-content-center">
  <div class="col-10 d-flex flex-column gap-5 col-md-11">
    <div class="d-flex justify-content-center">
        <div class="col-12 align-item-center d-flex flex-column gap-4 justify-content-md-between flex-md-row">
          <div class="col-12 col-md-5 d-flex flex-column spacing-2">
            <div class="white-container">
                <div class="m-0 d-flex fw-light">
                    Data dell'ordine: <span class="ms-auto"><?php echo $templateParams["dettagli-ordine"]["DataOrdine"]; ?></span>
                </div>
                <div class="m-0 d-flex fw-light">
                    Numero ordine: <span class="ms-auto"><?php echo $templateParams["dettagli-ordine"]["CodOrdine"]; ?></span>
                </div>
                <div class="m-0 d-flex fw-bold">
                    Totale:<span class="ms-auto">EUR <?php echo $templateParams["dettagli-ordine"]["ImportoConSconto"]; ?></span><span class="fw-normal"><?php echo " (" . $templateParams["num-articoli"] . ($templateParams["num-articoli"] == 1 ? " arcicolo" : " articoli") . ")"; ?></span>
                </div>
            </div>

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

            <div class="white-container">
                <div class="m-0 d-flex fw-light">
                    Articoli: <span class="ms-auto"><?php echo $templateParams["dettagli-ordine"]["ImportoSenzaSconto"]; ?> &euro;</span>
                </div>
                <div class="m-0 d-flex fw-light">
                    Sconto applicato: <span class="ms-auto"><?php echo $templateParams["dettagli-ordine"]["ScontoTotale"]; ?> &euro;</span>
                </div>
                <div class="m-0 d-flex fw-bold">
                    Totale: <span class="ms-auto"><?php echo $templateParams["dettagli-ordine"]["ImportoConSconto"]; ?> &euro;</span>
                </div>
            </div>
        </div>
          <section class="d-flex flex-column gap-3 align-items-center flex-grow-1" id="risultato">
            <h4 class = "m-0 col-12 col-lg-10 col-xl-9 col-md-10">Dettagli ordine</h4>
            <ul class="list-group p-0 col-12 col-lg-10 col-xl-9 col-md-10">
              <?php foreach ($templateParams["prodotti_ordine"] as $prodotto) : ?>
                <li class="col-12 list-group-item">
                  <div class="card col-12 p-2">
                    <div class="row g-0 p-0 m-0 justify-content-between justify-content-xl-start gap-xl-4 justify-content-xxs-start">
                      <div class="col-4 align-self-center d-xxs-none">
                        <img src="<?php echo UPLOAD_DIR . $prodotto["ImgPath"]; ?>" alt="" />
                      </div>
                      <div class="col-7 col-lg-6 p-0 m-0 flex-grow-xxs-1 flex-grow-xl-1">
                        <div class="card-body d-flex flex-wrap">
                          <p class="card-text col-12 mb-4"><span class="visually-hidden">nome prodotto</span><?php echo $prodotto["NomeProdotto"]; ?></p>
                          <p class="card-text m-0 mt-2 col-12 fw-bold text-danger">
                            <span class="visually-hidden">prezzo</span>
                            <?php echo round($prodotto["PrezzoVendita"], 2); ?>&euro;
                          </p>
                          <p class="card-text m-0 mt-3 col-12">Quantità: <?php echo $prodotto["Qta"] ?></p>
                          <input type="hidden" value="<?php echo $prodotto["CodProdotto"] ?>" name="CodProdotto">
                          <input type="hidden" value="<?php echo $prodotto["CodFornitore"] ?>" name="CodFornitore">
                        </div>
                      </div>
                    </div>
                  </div>
                </li>
              <?php endforeach; ?>
            </ul>
          </section>
        </div>
    </div>
  </div>
</div>