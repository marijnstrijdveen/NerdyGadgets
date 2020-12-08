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
        echo '<span class="alert alert-success bg-green">Account succesfully made!</span>';
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
                        <label for="email">Full name</label>
                        <input class="form-control" type="text" name="fullname" id="fullname" placeholder="Insert full name" required>
                        <label for="email">Email</label>
                        <input class="form-control" type="email" name="email" id="email" placeholder="Insert Email" required>
                        <label for="password">Password</label>
                        <input class="form-control" type="password" name="password" id="password" placeholder="Insert password" required>
                        <label for="email">Phone number</label>
                        <input class="form-control" type="text" name="phone" id="phone" placeholder="Insert phone number" required>
                        <label for="email">Address</label>
                        <input class="form-control" type="text" name="address" id="address" placeholder="Insert address" required>
                        <label for="email">Residence</label>
                        <input class="form-control" type="text" name="city" id="city" placeholder="Insert residence" required>
                        <label for="email">Postal code</label>
                        <input class="form-control" type="text" name="postalcode" id="postalcode" placeholder="Insert postal code" pattern="[1-9][0-9]{3}\s?[a-zA-Z]{2}" maxlength=7 required>
                        <label for="email">Country</label>
                        <input class="form-control" type="text" name="country" id="country" placeholder="Insert country" required>
                    </div>
                    <div class="form-row">
                        <div class="col">
                            <button href="inloggen.php" class="btn btn-primary" name="register" type="submit">
                                Register
                            </button>
                        </div>
                        <div class="col text-right">
                            <a href="inloggen.php" class="open-login">Log in</a>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-6">
                <div class="card bg-dark position-sticky" style="top: 100px">
                    <div class="card-body">
                        <h5 class="card-title">The benefits of making an account: </h5>
                        <div class="card-text">
                            Become a member of NerdyGadgets and make use of:

                            <ul>
                                <li>Faster paying</li>
                                <li>Discounts</li>
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