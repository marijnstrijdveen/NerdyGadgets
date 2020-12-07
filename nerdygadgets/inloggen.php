<?php
include __DIR__ . '/init.php';
/** @var $Connection mysqli */

$invalid = false;

if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $invalid = true;

    $email = mysqli_real_escape_string($Connection, $_POST['email']);
    $sql = mysqli_query($Connection, "SELECT * FROM `accounts` WHERE `email`='$email'");

    if (mysqli_num_rows($sql)) {
        $accountData = $sql->fetch_array(MYSQLI_ASSOC);

        /*
            array(10) {
                ["id"]=> string(2) "21"
                ["userid"] = $email["userid"];
                ["fullname"]=> string(4) "Yana"
                ["email"]=> string(19) "salsayana@gmail.com"
                ["password"]=> string(32) "$2y$10$lDD7gUD4GQaFxUKwxqt1I.0Th"
                ["userpwd"] = $password["userpwd"];
                ["phone"]=> string(6) "123456"
                ["address"]=> string(4) "Dijk"
                ["city"]=> string(6) "Amster"
                ["postalcode"]=> string(6) "1234GV"
                ["state"]=> string(2) "aw"
                ["country"]=> string(9) "Nederland"
            }
        */

        $passwordValid = password_verify($_POST['password'], $accountData['password']);

        if($passwordValid) {
            $_SESSION['userid'] = $accountData['id'];
            $_SESSION['email'] = $accountData['email'];

            header("location:categories.php");
        }
    }
}

$headTitel = 'NerdyGadgets - Login';
include __DIR__ . '/header.php';
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