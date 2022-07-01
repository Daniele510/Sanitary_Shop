<div class="row justify-content-center">
  <div class="col-10 d-flex flex-column gap-5 col-md-11">
    <div class="d-flex justify-content-center">
        <div class="col-12 align-item-center d-flex flex-column gap-4 justify-content-md-between flex-md-row">
          
          <!-- TODO: togliere style -->
          <div class="col-12 col-md-5 d-flex flex-column" style="gap: 2rem">
            <div class="d-flex flex-column gap-4 order-md-1">
                <input class="btn btn-primary-dark" type="submit" name="action" value="Conferma acquisto">
                <input class="btn btn-danger" type="submit" name="action" value="Annulla acquisto">
            </div>
            <section>
              <h3 class="d-none d-md-block">Info acquisto</h3>
              <div class="white-container">
                  <div class="m-0 d-flex fw-light">
                    Articoli: <span class="ms-auto"><?php echo $templateParams["ImportoSenzaSconto"]; ?> €</span>
                  </div>
                  <div class="m-0 d-flex fw-light">
                    Sconto applicato: <span class="ms-auto"><?php echo $templateParams["Sconto"]; ?> €</span>
                  </div>
                  <div class="m-0 d-flex fw-bold">
                    Totale: <span class="ms-auto text-danger"><?php echo $templateParams["ImportoConSconto"]; ?> €</span>
                  </div>
              </div>
            </section> 

            <section>
              <h3>Indirizzo di spedizione</h3>
              <div class="white-container">
                <p class="mb-0">
                  <?php echo $templateParams["info_utente"]["NomeCompletoIntestatario"]; ?><br />
                  <?php echo $templateParams["info_utente"]["IndirizzoSpedizione"]; ?><br />
                </p>
              </div>
            </section>

            <section>
              <h3>Informazioni di pagamento</h3>
              <div class="white-container">
                <p class="mb-0">
                  ****<?php echo substr($templateParams["info_utente"]["CodCarta"], -4); ?><br />
                  <?php echo $templateParams["info_utente"]["NomeCompletoIntestatario"]; ?><br />
                  Data Scadenza: <?php echo $templateParams["info_utente"]["MeseScadenza"]; ?> / <?php echo $templateParams["info_utente"]["AnnoScadenza"]; ?>
                </p>
              </div>
            </section>
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
                            <?php echo round($prodotto["Prezzo"], 2); ?>€
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