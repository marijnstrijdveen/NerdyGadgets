<?php
include "header.php"
/*


SELECT SI.StockItemID,
(RecommendedRetailPrice*(1+(TaxRate/100))) AS SellPrice,
StockItemName,
CONCAT('Stock ',QuantityOnHand)AS QuantityOnHand,
SearchDetails,
(CASE WHEN (RecommendedRetailPrice*(1+(TaxRate/100))) > 50 THEN 0 ELSE 6.95 END) AS SendCosts, MarketingComments, CustomFields, SI.Video,
(SELECT ImagePath FROM stockgroups JOIN stockitemstockgroups USING(StockGroupID) WHERE StockItemID = SI.StockItemID LIMIT 1) as BackupImagePath
FROM stockitems SI
JOIN stockitemholdings SIH USING(stockitemid)
JOIN stockitemstockgroups ON SI.StockItemID = stockitemstockgroups.StockItemID
JOIN stockgroups USING(StockGroupID)
WHERE SI.stockitemid IN (SELECT `stock_item_id` FROM `wishlist` WHERE `account_id` = ?)
GROUP BY StockItemID

*/
?>

<h2>Your wishlist</h2>
<br>
<br>

