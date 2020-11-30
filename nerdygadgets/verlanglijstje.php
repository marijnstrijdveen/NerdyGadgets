<?php
include "header.php";

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
?>

<div id="ResultsArea" class="Browse">
    <h2>Your wishlist</h2>
    <?php
    if (isset($ReturnableResult) && count($ReturnableResult) > 0) {
        foreach ($ReturnableResult as $row) {
            ?>
            <a class="ListItem" href='view.php?id=<?php print $row['StockItemID']; ?>'>
                <div id="ProductFrame">
                    <?php
                    if (isset($row['ImagePath'])) { ?>
                        <div class="ImgFrame"
                             style="background-image: url('<?php print "Public/StockItemIMG/" . $row['ImagePath']; ?>'); background-size: 230px; background-repeat: no-repeat; background-position: center;"></div>
                    <?php } else if (isset($row['BackupImagePath'])) { ?>
                        <div class="ImgFrame"
                             style="background-image: url('<?php print "Public/StockGroupIMG/" . $row['BackupImagePath'] ?>'); background-size: cover;"></div>
                    <?php }
                    ?>

                    <div id="StockItemFrameRight">
                        <div class="CenterPriceLeftChild">
                            <h1 class="StockItemPriceText"><?php print sprintf("€ %0.2f", $row["SellPrice"]); ?></h1>
                            <h6>Including taxes </h6>
                        </div>
                    </div>
                    <h1 class="StockItemID">Product number <?php print $row["StockItemID"]; ?></h1>
                    <p class="StockItemName"><?php print $row["StockItemName"]; ?></p>
                    <p class="StockItemComments"><?php print $row["MarketingComments"]; ?></p>
                    <h4 class="ItemQuantity"><?php print $row["QuantityOnHand"]; ?></h4>
                </div>
            </a>
        <?php } ?>
        <?php
    } else {
        ?>
        <h2 id="NoSearchResults">
            No results have been found.
        </h2>
        <?php
    }
    ?>
</div>

<?php
include __DIR__ . "/footer.php";
?>

