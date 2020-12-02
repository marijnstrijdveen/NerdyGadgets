<?php
include __DIR__ . '/init.php';
/** @var $Connection mysqli */

$headTitel = 'NerdyGadgets - Wachtwoord vergeten';
include __DIR__ . '/header.php';
?>
    <section class="signin-container">
        <div class="container py-5">
            <h1>Wachtwoord vergeten?</h1>
            <div class="row">
                <div class="col-md-6">
                    <form method="post">
                        <div class="form-group">

                            <label for="email">Email</label>

                            <input class="form-control" type="email" name="email" id="email">
                        </div>
                        <button class="btn btn-primary" type="submit" name="Verstuurd">
                            Wachtwoord aanvragen
                        </button>

                        <a href="inloggen.php" class="py-2 d-block">
                            Ik weet mijn wachtwoord weer, inloggen
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </section>

<?php include "footer.php"; ?>