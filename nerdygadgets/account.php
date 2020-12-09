<?php
include __DIR__ . '/init.php';
/** @var $Connection mysqli */

$shows = new shows();
$id = $_SESSION['userid'];
$Query = "SELECT * from accounts where id = {$id}";

$ShowStockLevel = 1000;
$Statement = mysqli_prepare($Connection, $Query);
//mysqli_stmt_bind_param($Statement, "i", $_GET['id']);
mysqli_stmt_execute($Statement);
$ReturnableResult = mysqli_stmt_get_result($Statement);
$Result = null;

if ($ReturnableResult && mysqli_num_rows($ReturnableResult) == 1) {
    $Result = mysqli_fetch_all($ReturnableResult, MYSQLI_ASSOC)[0];
}

$show_orders = '';
if ($id) {
    $show_orders = $shows->show_orders($conn);
}

$headTitel = 'NerdyGadgets - Your Account';
include __DIR__ . '/header.php';
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
            <h1>Hello, <?php print $Result["fullname"]; ?></h1>
        </div>
    </div>
    <div class="row" >
        <div class="col">
            <h3>Accountinformation</h3>
            <ul class="list-group">
                <li class="list-group-item bg-dark">
                    <small class="text-muted">Name:</small>
                    <h6 class="my-0"><?php print $Result["fullname"]; ?></h6>
                </li>
                <li class="list-group-item bg-dark">
                    <small class="text-muted">Address:</small>
                    <h6 class="my-0"><?php print $Result["address"]; ?></h6>
                </li>
                <li class="list-group-item bg-dark">
                    <small class="text-muted">Postal code:</small>
                    <h6 class="my-0"><?php print $Result["postalcode"]; ?></h6>
                </li>
                <li class="list-group-item bg-dark">
                    <small class="text-muted">Residence:</small>
                    <h6 class="my-0"><?php print $Result["city"]; ?></h6>
                </li>
                <li class="list-group-item bg-dark">
                    <small class="text-muted">Phone number:</small>
                    <h6 class="my-0"><?php print $Result["phone"]; ?></h6>
                </li>
                <li class="list-group-item bg-dark">
                    <small class="text-muted">Email:</small>
                    <h6 class="my-0"><?php print $Result["email"]; ?></h6>
                </li>
            </ul>
        </div>
        <div class="col">
            <h3>Orders</h3>
            <ul class="list-group">
                <li class="list-group-item bg-dark">
                    <table width="100%">
                    <tr>
                            <th>OrderID</th>
                            <th>Items</th>
                            <th>Action</th>
                        </tr>
                        <?php echo $show_orders; ?>
                    </table>
                </li>
            </ul>
        </div>
    </div>
</section>
<?php
include "footer.php";
?>
