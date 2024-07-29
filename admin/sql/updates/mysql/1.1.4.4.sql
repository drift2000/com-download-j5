ALTER TABLE `#__download_items` 
ADD COLUMN `type` VARCHAR(255) NULL AFTER `product`;

ALTER TABLE `#__download_stat` 
ADD COLUMN `type` VARCHAR(255) NULL AFTER `product`;