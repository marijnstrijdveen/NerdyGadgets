<?php
include __DIR__ . '/init.php';
/** @var $Connection mysqli */

$headTitel = 'NerdyGadgets - Payment';
include __DIR__ . '/header.php';
?>

    <section class="signin-container">
        <div class="container py-5">
            <h1>Betaling</h1>
            <div class="row">
                <div class="col-md-6">
                    <form method="post">
                        <div class="form-group">
                            <label for="Voornaam">Voornaam</label>
                            <input class="form-control" type="email" name="Voornaam" id="Achternaam">
                        </div>

                        <div class="form-group">
                            <label for="Achternaam">Achternaam</label>
                            <input class="form-control" type="email" name="Achternaam" id="Achternaam">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input class="form-control" type="email" name="email" id="email">
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="Stad">Stad</label>
                                <input class="form-control" type="email" name="Stad" id="Stad">
                            </div><div class="form-group">
                                <label for="Postcode">Postcode</label>
                                <input class="form-control" type="email" name="Postcode" id="Postcode">
                            </div>
                        </div>
                        <div class="dropdown">
                            <title>Static Dropdown List</title>
                            <body>
                            Land
                            <select>
                                <option value="Verenigdestaten">United states</option>
                                <option value="Nederland">Nederland</option>
                                <option value="Duitsland">Duitsland</option>
                                <option value="Canada">Canada</option>
                                <option value="België">België</option>
                                <option value="Frankrijk">Frankrijk</option>
                                <option value="Zweden">Zweden</option>
                                <option value="China">China</option>
                            </select>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="password">Telefoonnummer</label>
                                <input class="form-control" type="" name="password" id="password">
                            </div>

                            <div class="form-group">
                                <label for="email">Telefoonnummer 2 (optioneel)</label>
                                <input class="form-control" type="email" name="email" id="email">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <button class="btn btn-primary" name="Back" type="submit">
                                    <- Back to cart
                                </button>
                            </div>

                            <div class="col text-right">
                                <form action="https://www.ideal.nl/">
                                    <button class="btn btn-primary" name="Payment" onclick="location.href='http://ideal.nl'" type="button">
                                        Betalen
                                    </button>
                                </form>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="col-md-6">
                    <div class="card bg-dark position-sticky" style="top: 100px">
                        <div class="card-body">
                            <h5 class="card-title">Overzicht</h5>
                            <div class="card-text">


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php include "footer.php"; ?>



