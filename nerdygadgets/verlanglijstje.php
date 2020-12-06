<?php
include __DIR__ . '/init.php';
/** @var $Connection mysqli */
/** @var $conn mysqli */

if (isset($_GET['add'])) {
    $shows = new shows();
    $info = $shows->add_cart();
}

if (isset($_GET['wish'])) {
    // Remove record from table "wishlist" by data:
    //  $_SESSION['userid']; // Account ID
    // and
    // $_GET['wish']; // Stock Item ID

    // DELETE FROM table_name WHERE officeCode = 4 AND ...;
    $deleteToWishlistSql = "DELETE FROM `wishlist` WHERE account_id = ? AND stock_item_id = ?;";

    try {
        $Statement = mysqli_prepare($Connection, $deleteToWishlistSql);
        mysqli_stmt_bind_param($Statement, 'ii', $_SESSION['userid'], $_GET['wish']);
        mysqli_stmt_execute($Statement);

        $info = '<div class="alert alert-success">Product deleted from wishlist.</div>';
    } catch (Throwable $exception) {
        $info = '<div class="alert alert-danger">Is not present in your wishlist.</div>';
    }
}

$currentUserId = $_SESSION['userid'];
$ShowStockLevel = 1000;

$Query = "
    SELECT SI.StockItemID, SI.StockItemName, SI.MarketingComments, 
    ROUND(SI.TaxRate * SI.RecommendedRetailPrice / 100 + SI.RecommendedRetailPrice,2) as SellPrice, 
    (CASE WHEN (SIH.QuantityOnHand) >= ? THEN 'Large stock available' ELSE CONCAT('Stock: ',QuantityOnHand) END) AS QuantityOnHand,
    (SELECT ImagePath FROM stockitemimages WHERE StockItemID = SI.StockItemID LIMIT 1) as ImagePath,
    (SELECT ImagePath FROM stockgroups JOIN stockitemstockgroups USING(StockGroupID) WHERE StockItemID = SI.StockItemID LIMIT 1) as BackupImagePath           
    FROM stockitems SI 
    JOIN stockitemholdings SIH USING(stockitemid)
    JOIN stockitemstockgroups USING(StockItemID)
    WHERE SI.stockitemid IN (SELECT `stock_item_id` FROM `wishlist` WHERE `account_id` = ?)
    GROUP BY StockItemID
";

$Statement = mysqli_prepare($Connection, $Query);
mysqli_stmt_bind_param($Statement, 'ii', $ShowStockLevel, $currentUserId);
mysqli_stmt_execute($Statement);
$ReturnableResult = mysqli_stmt_get_result($Statement);
$ReturnableResult = mysqli_fetch_all($ReturnableResult, MYSQLI_ASSOC);

$headTitel = 'NerdyGadgets - Your Wishlist';
include __DIR__ . '/header.php';
?>

<div id="ResultsArea" class="Browse">
    <?=$info ?? ''?>
    <h2>Your wishlist</h2>
    <?php
    if (isset($ReturnableResult) && count($ReturnableResult) > 0):
        foreach ($ReturnableResult as $row):
    ?>
            <div class="container">
                <div class="row no-gutters">
                    <div class="col-4">
                        <a href='view.php?id=<?=$row['StockItemID']?>'>
                            <?php if (isset($row['ImagePath'])): ?>
                                <div class="ImgFrame" style="background-image: url('<?php print "Public/StockItemIMG/" . $row['ImagePath']; ?>'); background-size: 230px; background-repeat: no-repeat; background-position: center;"></div>
                            <?php elseif (isset($row['BackupImagePath'])): ?>
                                <div class="ImgFrame" style="background-image: url('<?php print "Public/StockGroupIMG/" . $row['BackupImagePath'] ?>'); background-size: cover;"></div>
                            <?php endif; ?>
                        </a>
                    </div>
                    <div class="col-6">
                        <a href='view.php?id=<?=$row['StockItemID']?>'>
                            <h1 class="StockItemID">Product number <?=$row["StockItemID"]?></h1>
                            <div class="StockItemName"><?=$row['StockItemName']?></div>
                            <div class="StockItemComments"><?=$row['MarketingComments']?></div>
                        </a>
                        <a href="verlanglijstje.php?add=<?=$row['StockItemID']?>" class="btn btn-danger">Add to Cart</a>

                        <a href="verlanglijstje.php?wish=<?=$row['StockItemID']?>" class="btn btn-primary">Remove from wishlist</a>
                    </div>
                    <div class="col-2">
                        <h1 class="StockItemPriceText"><?php print sprintf("€ %0.2f", $row["SellPrice"]); ?></h1>
                        <h6>Including taxes</h6>
                        <div class="align-bottom"><?=$row["QuantityOnHand"]?></div>
                    </div>
                </div>
            </div>
    <?php
        endforeach;
    else:
    ?>



    <?php endif; ?>
</div>

<?php
include __DIR__ . "/footer.php";
?>

