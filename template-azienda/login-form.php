<div class="row login">
    <h1 class="col-6">WELCOME!</h1>
    <form action="#" method="POST" class="col-10 col-md-8 needs-validation white-column-container inputs" novalidate>
        <?php if (isset($templateParams["errorelogin"])) : ?>
            <div class="col-10 p-0 err-msg d-flex justify-content-center">
                <p class="m-0 p-0" tabindex="-1"><?php echo $templateParams["errorelogin"]; ?></p>
            </div>
        <?php endif; ?>
        <div class="col-12 vstack fields p-0">
            <div class="col-12 d-sm-flex">
                <label for="validationEmail" class="col-sm-2 col-form-label form-label">Email</label>
                <div class="col-sm-10 input">
                    <input type="email" class="form-control" id="validationEmail" name="EmailCompany" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required aria-labelledby="invalid-feedback-email">
                    <div class="invalid-feedback" id="invalid-feedback-email">
                        Inserire una indirizzo email valido
                    </div>
                </div>
            </div>
            <div class="col-12 d-sm-flex">
                <label for="validationPassword" class="col-sm-2 col-form-label form-label">Password</label>
                <div class="col-sm-10 input">
                    <input class="form-control" type="password" id="validationPassword" name="PasswordCompany" required aria-labelledby="invalid-feedback-password">
                    <div class="invalid-feedback" id="invalid-feedback-password">
                        Completa il campo
                    </div>
                </div>
            </div>
        </div>
        <button class="col-6 col-sm-3 btn btn-primary" type="submit">Login</button>
        <div class="col-12 d-flex justify-content-center">
            <div class="col-12 col-sm-3 p-0 text-center fw-lighter fst-italic fs-6">
                <a href="login.php?action=registrazione-azienda" class="text-decoration-none text-reset">Registrati ora</a>
            </div>
        </div>
    </form>
</div>