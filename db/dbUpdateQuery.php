<!---
ALTER TABLE `product_info` ADD `purchase_price` DECIMAL(10,2) NOT NULL AFTER `unit_sale_price`;
ALTER TABLE `product_info` CHANGE `is_active` `is_active` TINYINT(1) NULL DEFAULT '1' COMMENT '0= Delete, 1 = Active, 2 = Inactive ';
ALTER TABLE `stock_info` ADD `purchaseAmtForSales` DECIMAL(10,2) NULL DEFAULT NULL AFTER `total_price`;
-----------Updated

ALTER TABLE `stock_info` ADD `product_code` INT(11) UNSIGNED NULL DEFAULT NULL AFTER `updated_ip`;
UPDATE  `stock_info` SET `total_price`=`total_item`*`unit_price` ORDER BY id DESC LIMIT 1


UPDATE stock_info as T1   JOIN product_info as T2 ON T1.product_code = T2.productCode
  SET T1.product_id = T2.id
WHERE T1.product_code is NOT NULL

-----------Updated

UPDATE `product_info` SET `band_id`=15,`source_id`=22 ORDER BY id DESC
