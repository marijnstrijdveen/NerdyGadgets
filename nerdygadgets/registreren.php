<?php
include "header.php"
?>
<section class="signin-container">
    <div class="container py-5">
        <h1>Registreren</h1>
        <div class="row">
            <div class="col-md-6">
                <form method="post">
                    <div class="form-group">
                        <label for="email">Voornaam</label>
                        <input class="form-control" type="text" name="first_name" id="first_name" placeholder="Vul hier uw voornaam in" required>
                        <label for="email">Achternaam</label>
                        <input class="form-control" type="text" name="last_name" id="last_name" placeholder="Vul hier uw achternaam in " required>
                        <label for="email">Email</label>
                        <input class="form-control" type="email" name="email" id="email" placeholder="Vul hier uw emailadress in" required>
                        <label for="password">Wachtwoord</label>
                        <input class="form-control" type="password" name="password" id="password" placeholder="Vul hier uw wachtwoord in" required>
                        <label for="password">Wachtwoord herhalen</label>
                        <input class="form-control" type="password" name="password" id="password" placeholder="Herhaal hier uw wachtwoord in" required>
                    </div>
                    <div class="form-row">
                        <div class="col">
                            <button class="btn btn-primary" name="login" type="submit">
                                Registreren
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>