<div class="row login">
    <h1 class="col-6">WELCOME!</h1>
    <form action="#" method="POST" class="col-10 col-md-8 needs-validation inputs" novalidate>
        <?php if (isset($templateParams["errorelogin"])) : ?>
            <div class="col-10 p-0 err-msg d-flex justify-content-center">
                <p class="m-0 p-0" tabindex="-1"><?php echo $templateParams["errorelogin"]; ?></p>
            </div>
        <?php endif; ?>
        <div class="row fields">
            <div class="row">
                <label for="validationEmail" class="col-sm-2 col-form-label form-label">Email</label>
                <div class="col-sm-10 input">
                    <input type="email" class="form-control" id="validationEmail" name="EmailCompany" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required>
                    <div class="invalid-feedback">
                        Please insert a valid email address
                    </div>
                </div>
            </div>
            <div class="row">
                <label for="validationPassword" class="col-sm-2 col-form-label form-label">Password</label>
                <div class="col-sm-10 input">
                    <input class="form-control" type="password" id="validationPassword" name="PasswordCompany" required>
                    <div class="invalid-feedback">
                        Please fill the password's field
                    </div>
                </div>
            </div>
        </div>
        <button class="col-6 col-sm-3 btn primary" type="submit">Login</button>
        <div class="row justify-content-center">
            <div class="col-12 col-sm-4 p-0">
                <a href="login.php?action=registrazione-azienda">Registrati ora</a>
            </div>
        </div>
    </form>
</div>