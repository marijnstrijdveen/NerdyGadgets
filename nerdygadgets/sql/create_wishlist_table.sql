USE `nerdygadgets`;
CREATE TABLE IF NOT EXISTS `wishlist`(
    `account_id` INT NOT NULL,
    `stock_item_id` INT NOT NULL,
    PRIMARY KEY (`account_id`, `stock_item_id`)
);
