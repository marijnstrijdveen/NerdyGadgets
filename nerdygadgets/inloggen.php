<?php

session_start();
require('connect.php');

$ingelogd = true;
$invalid = false;

if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $email = mysqli_real_escape_string($Connection, $_POST['email']);
    $password = mysqli_real_escape_string($Connection, $_POST['password']);
    $sql = mysqli_query($Connection, "SELECT * FROM `accounts` WHERE `email`='$email'  AND `password`='$password'  ");
    if (mysqli_num_rows($sql) == 1) {
        session_start();
        $_SESSION["userid"] = $email["userid"];
        $_SESSION["userpwd"] = $password["userpwd"];
        $_SESSION['email'] = $email;
            header("location:account.php");
    } else {
        $invalid = true;
    }
}
include "header.php";
?>
<section class="signin-container">
        <div class="container py-5">
            <h1>Inloggen</h1>
            <div class="row">
                <div class="col-md-6">
                    <form method="post">
                        <div class="form-group">
                        <?php if ($invalid) : ?>
                            <div class="alert alert-danger">
                                Er is geen account gevonden met deze combinatie.
                            </div>
                        <?php endif; ?>
                            <label for="email">Email</label>
                            <input class="form-control" type="email" name="email" id="email" required>
                        </div>

                        <div class="form-group">
                            <label for="password">Wachtwoord</label>
                            <input class="form-control" type="password" name="password" id="password" required>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <button class="btn btn-primary" name="login" type="submit">
                                    Inloggen
                                </button>
                            </div>
                            <div class="col text-right">
                                <a href="Wachtwoord-vergeten.php">Wachtwoord vergeten?</a>
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