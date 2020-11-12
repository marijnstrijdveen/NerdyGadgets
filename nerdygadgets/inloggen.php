<?php
include "header.php";
?>

<section class="signin-container">
        <div class="container py-5">
            <h1>Inloggen</h1>
            <div class="row">
                <div class="col-md-6">
                    <form method="post">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input class="form-control" type="email" name="email" id="email">
                        </div>

                        <div class="form-group">
                            <label for="password">Wachtwoord</label>
                            <input class="form-control" type="password" name="password" id="password">
                        </div>

                        <div class="form-row">
                            <div class="col">
                                <button class="btn btn-primary" name="login" type="submit">
                                    Inloggen
                                </button>
                            </div>

                            <div class="col text-right">
                                <a href="wachtwoord-vergeten.php">Wachtwoord vergeten?</a>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="col-md-6">
                    <div class="card bg-dark position-sticky" style="top: 100px">
                        <div class="card-body">
                            <h5 class="card-title">Maak een account aan</h5>
                            <div class="card-text">
                                Word lid van Nerdygadgets en maak gebruik van:

                                <ul>
                                    <li>Sneller afrekenen</li>
                                    <li>Aanbiedingen</li>
                                </ul>

                                <a href="registreren.php" class="btn btn-primary">
                                    Account aanmaken
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>

<?php include "footer.php"; ?>