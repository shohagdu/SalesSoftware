<!---
ALTER TABLE `product_info` ADD `purchase_price` DECIMAL(10,2) NOT NULL AFTER `unit_sale_price`;
ALTER TABLE `product_info` CHANGE `is_active` `is_active` TINYINT(1) NULL DEFAULT '1' COMMENT '0= Delete, 1 = Active, 2 = Inactive ';
ALTER TABLE `stock_info` ADD `purchaseAmtForSales` DECIMAL(10,2) NULL DEFAULT NULL AFTER `total_price`;