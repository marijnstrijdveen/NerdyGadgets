<?php
include __DIR__ . '/init.php';
/** @var $Connection mysqli */

$headTitel = 'NerdyGadgets - Wachtwoord vergeten';
include __DIR__ . '/header.php';
?>
    <section class="signin-container">
        <div class="container py-5">
            <h1>Forgot password?</h1>
            <div class="row">
                <div class="col-md-6">
                    <form method="post">
                        <div class="form-group">

                            <label for="email">Email</label>

                            <input class="form-control" type="email" name="Email" id="email">
                        </div>
                        <button class="btn btn-primary" type="submit" name="Send">
                            Request password
                        </button>

                        <a href="inloggen.php" class="py-2 d-block">
                            Log in
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </section>

<?php include "footer.php"; ?>