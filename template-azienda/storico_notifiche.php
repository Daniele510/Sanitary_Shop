<section class="row justify-content-center">
  <div class="col-10 d-flex flex-column gap-4">
    <div class="d-flex">
      <button class="btn p-0 d-none d-md-block back w-auto"><img src="<?php echo ICON_DIR; ?>back.svg" alt="torna indietro"></button>
      <h2 class="mx-auto">Storico notifiche</h2>
    </div>
    <div class="col-12 d-flex gap-5 align-items-start" id="container_notifiche">
      <?php if (!empty($templateParams["notifiche"])) : ?>
        <ul class="list-group p-0 col-12 col-lg-5">
          <?php foreach ($templateParams["notifiche"] as $notifica) : ?>
            <li class="list-group-item">
              <div class="card border-0 col-12 text-decoration-none text-body p-2">
                <div class="row g-0 p-0 m-0 gap-3 gap-lg-5">
                  <div class="col-2 align-self-center">
                    <img src="<?php echo UPLOAD_DIR . $notifica["ImgPath"]; ?>" alt="" />
                  </div>
                  <div class="col-7 p-0 m-0">
                    <div class="card-body justify-content-between h-100 p-0">
                      <h5 class="card-title"><?php echo $notifica["TitoloNotifica"]; ?></h5>
                      <p class="card-text fw-lighter me-3"><small><?php echo $notifica["Data"]; ?></small></p>
                      <input type="hidden" name="CodNotifica" value="<?php echo $notifica["CodNotifica"]; ?>">
                    </div>
                  </div>
                </div>
              </div>
            </li>
          <?php endforeach; ?>
        </ul>
        <?php if (!empty($templateParams["notifica"])) : ?>
          <section id="box_notifica" class="d-lg-flex justify-content-end col-12 opacity-0 opacity-lg-100">
            <div class="white-container col-12">
              <h2><?php echo $templateParams["notifica"][0]["TitoloNotifica"]; ?></h2>
              <p class="mb-5"><small><?php echo $templateParams["notifica"][0]["Data"]; ?></small></p>
              <p><?php echo $templateParams["notifica"][0]["DescrizioneNotifica"]; ?></p>
              <p class="mt-4 mb-0">per maggiori informazioni sul prodotto <a class="text-primary text-decoration-none" href="prodotto.php?id=<?php echo $templateParams["notifica"][0]["CodProdotto"]; ?>" class="text-reset text-decoration-none">clicca qui</a></p>
            </div>
          </section>
        <?php endif; ?>
      <?php endif; ?>
    </div>
  </div>
</section>