<?php
$Connection = mysqli_connect("localhost", "root", "", "nerdygadgets");
mysqli_set_charset($Connection, 'latin1');
include __DIR__ . "/header.php";

$Query = "SELECT * from accounts where id = {$_SESSION['userid']}";

$ShowStockLevel = 1000;
$Statement = mysqli_prepare($Connection, $Query);
//mysqli_stmt_bind_param($Statement, "i", $_GET['id']);
mysqli_stmt_execute($Statement);
$ReturnableResult = mysqli_stmt_get_result($Statement);
if ($ReturnableResult && mysqli_num_rows($ReturnableResult) == 1) {
    $Result = mysqli_fetch_all($ReturnableResult, MYSQLI_ASSOC)[0];
} else {
    $Result = null;
}
?>

<section class="breadcrumbSection container pt-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="index.php"><i class="fa fa-home"></i></a></li>
            <li class="breadcrumb-item active" aria-current="page">Account</li>
        </ol>
    </nav>
</section>
<section class="account-section container py-3">
    <div class="row">
        <div class="col">
            <h1>Hallo, <?php print $Result["fullname"]; ?></h1>
        </div>
    </div>
    <div class="row" >
        <div class="col">
            <h3>Accountinformatie</h3>
            <ul class="list-group">
                <li class="list-group-item bg-dark">
                    <small class="text-muted">Naam:</small>
                    <h6 class="my-0"><?php print $Result["fullname"]; ?></h6>
                </li>
                <li class="list-group-item bg-dark">
                    <small class="text-muted">Adres:</small>
                    <h6 class="my-0"><?php print $Result["address"]; ?></h6>
                </li>
                <li class="list-group-item bg-dark">
                    <small class="text-muted">Postcode:</small>
                    <h6 class="my-0"><?php print $Result["postalcode"]; ?></h6>
                </li>
                <li class="list-group-item bg-dark">
                    <small class="text-muted">Woonplaats:</small>
                    <h6 class="my-0"><?php print $Result["city"]; ?></h6>
                </li>
                <li class="list-group-item bg-dark">
                    <small class="text-muted">Telefoonnummer:</small>
                    <h6 class="my-0"><?php print $Result["phone"]; ?></h6>
                </li>
                <li class="list-group-item bg-dark">
                    <small class="text-muted">E-mailadres:</small>
                    <h6 class="my-0"><?php print $Result["email"]; ?></h6>
                </li>
            </ul>
        </div>
        <div class="col">
            <h3>Orders</h3>
            <ul class="list-group">
            </ul>
        </div>
    </div>
</section>
<?php
include "footer.php";
?>
