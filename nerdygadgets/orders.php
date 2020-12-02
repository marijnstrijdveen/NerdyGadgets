<?php
include __DIR__ . '/init.php';
/** @var $Connection mysqli */

$shows = new shows();
include __DIR__ . "/header.php";
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
$order_details = '';
if (isset($_REQUEST['OrderID'])) {
    $order_details = $shows->order_details($conn);
}

$headTitel = 'NerdyGadgets - Orders';
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
            <h1>Hallo, <?php print $Result["fullname"]; ?></h1>
        </div>
    </div>
    <div class="row" >
        <div class="col">
            <h3>Orders ID : <?php echo $order_details[0]; ?></h3>
            <ul class="list-group">
                <li class="list-group-item bg-dark">
                    <table width="100%">
                    <tr>
                            <th>ItemID</th>
                            <th>Item Name</th>
                            <th>Quantity</th>
                            <th>Item Price</th>
                            <th>Item Total</th>
                        </tr>
                        <?php echo $order_details[1]; ?>
                    </table>
                </li>
            </ul>
        </div>
    </div>
</section>
<?php
include "footer.php";
?>
