<?php
include __DIR__ . '/init.php';
/** @var $Connection mysqli */

if (isset($_POST['register']))   {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $postalcode = $_POST['postalcode'];
    $state = $_POST['state'];
    $country = $_POST['country'];

    $query = "INSERT INTO accounts(fullname, email, password, phone, address, city, postalcode, state, country) VALUES ('$fullname','$email','$password','$phone','$address','$city','$postalcode','$state','$country')";

    $statement = mysqli_query($Connection, $query);

    if ($statement) {
        echo '<span class="alert alert-success bg-green">Account succesvol aangemaakt</span>';
    } else {
        echo '<span class="alert alert-success">Something went wrong</span>';
    }
    }

$headTitel = 'NerdyGadgets - Registreren';
include __DIR__ . '/header.php';
?>
<section class="signin-container">
    <div class="container py-5">
        <h1>Registreren</h1>
        <div class="row">
            <div class="col-md-6">
                <form method="post">
                    <div class="form-group">
                        <label for="email">Volledige naam</label>
                        <input class="form-control" type="text" name="fullname" id="fullname" placeholder="Vul hier uw voornaam in" required>
                        <label for="email">Email</label>
                        <input class="form-control" type="email" name="email" id="email" placeholder="Vul hier uw emailadress in" required>
                        <label for="password">Wachtwoord</label>
                        <input class="form-control" type="password" name="password" id="password" placeholder="Vul hier uw wachtwoord in" required>
                        <label for="email">Telefoonnummer</label>
                        <input class="form-control" type="text" name="phone" id="phone" placeholder="Vul hier uw telefoonnummer in" required>
                        <label for="email">address</label>
                        <input class="form-control" type="text" name="address" id="address" placeholder="Vul hier uw address in" required>
                        <label for="email">Woonplaats</label>
                        <input class="form-control" type="text" name="city" id="city" placeholder="Vul hier uw wonnplaats in" required>
                        <label for="email">postcode</label>
                        <input class="form-control" type="text" name="postalcode" id="postalcode" placeholder="Vul hier uw postcode in" required>
                        <label for="email">provincie</label>
                        <input class="form-control" type="text" name="state" id="state" placeholder="Vul hier uw provincie in" required>
                        <label for="email">Land</label>
                        <input class="form-control" type="text" name="country" id="country" placeholder="Vul hier uw land in" required>
                    </div>
                    <div class="form-row">
                        <div class="col">
                            <button class="btn btn-primary" name="register" type="submit">
                                Registreren
                            </button>
                        </div>
                        <div class="col text-right">
                            <a href="inloggen.php" class="open-login">Ik heb al een account</a>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-6">
                <div class="card bg-dark position-sticky" style="top: 100px">
                    <div class="card-body">
                        <h5 class="card-title">Voordelen van een account aanmaken:</h5>
                        <div class="card-text">
                            Word lid van Nerdygadgets en maak gebruik van:

                            <ul>
                                <li>Sneller afrekenen</li>
                                <li>Aanbiedingen</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
include "footer.php";
?>