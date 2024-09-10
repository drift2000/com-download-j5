CREATE TABLE IF NOT EXISTS `#__download_items` (
    `id` int NOT NULL AUTO_INCREMENT,
    `cid` int NOT NULL,
    `url` varchar(255) DEFAULT NULL,
    `category` varchar(255) DEFAULT NULL,
    `class` varchar(255) DEFAULT NULL,
    `group` varchar(255) DEFAULT NULL,
    `product` varchar(255) DEFAULT NULL,
    `type` varchar(255) DEFAULT NULL,
    `access_level` int DEFAULT NULL,
    `usersgroup` int DEFAULT NULL,
    `emailsend` varchar(255) DEFAULT NULL,
    `MD5` varchar(255) DEFAULT NULL,
    `published` varchar(255) DEFAULT NULL,
    `publish_up` datetime DEFAULT NULL,
    `compounds` varchar(255) DEFAULT NULL,
    `manager` varchar(255) DEFAULT NULL,
    `user_id` int DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB AUTO_INCREMENT = 11 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `#__download_stat` (
    `id` int NOT NULL AUTO_INCREMENT,
    `cid` int NOT NULL DEFAULT '0',
    `username` varchar(255) DEFAULT NULL,
    `dtime` datetime DEFAULT NULL,
    `category` varchar(255) DEFAULT NULL,
    `class` varchar(255) DEFAULT NULL,
    `group` varchar(255) DEFAULT NULL,
    `product` varchar(255) DEFAULT NULL,
    `type` varchar(255) DEFAULT NULL,
    `ip` varchar(255) DEFAULT NULL,
    `fullname` varchar(255) DEFAULT NULL,
    `action_stat` varchar(255) DEFAULT NULL,
    `email` varchar(255) DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB AUTO_INCREMENT = 17 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `#__cta_access` (
    `id` int NOT NULL AUTO_INCREMENT,
    `asset_id` int NOT NULL DEFAULT '0' COMMENT 'FK to the #__assets table.',
    `created_date` datetime DEFAULT NULL,
    `created_by` int NOT NULL DEFAULT '0',
    `fullname` varchar(255) DEFAULT NULL,
    `email` varchar(255) DEFAULT NULL,
    `message` text DEFAULT NULL COMMENT 'Message or Comment',
    `company` text DEFAULT NULL,
    `download_file` int NOT NULL DEFAULT '0',
    `page_name` varchar(255) DEFAULT NULL,
    `page_url` text DEFAULT NULL,
    `ip` varchar(45) DEFAULT NULL COMMENT 'user IP',
    PRIMARY KEY (`id`)
) ENGINE = InnoDB AUTO_INCREMENT = 12 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `#__cta_file_request` (
    `id` int NOT NULL AUTO_INCREMENT,
    `asset_id` int unsigned NOT NULL DEFAULT '0' COMMENT 'FK to the #__assets table.',
    `created_date` datetime DEFAULT NULL,
    `created_by` int DEFAULT NULL,
    `fullname` varchar(255) DEFAULT NULL,
    `email` varchar(255) DEFAULT NULL,
    `message` text COMMENT 'Message or Comment',
    `company` text,
    `download_file` int DEFAULT NULL,
    `page_name` varchar(255) DEFAULT NULL,
    `page_url` text,
    `ip` varchar(45) DEFAULT NULL COMMENT 'user IP',
    PRIMARY KEY (`id`)
) ENGINE = InnoDB AUTO_INCREMENT = 9 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

INSERT INTO `#__download_items` (`cid`, `url`, `category`, `class`, `group`, `product`, `access_level`, `emailsend`, `published`, `compounds`, `manager`) 
    VALUES ('1', 'test.zip', 'test', 'test', 'test', 'test1', '2', 'email@email.com', '1', '100500', 'Super User');
INSERT INTO `#__download_items` (`cid`, `url`, `category`, `class`, `group`, `product`, `access_level`, `emailsend`, `published`, `compounds`, `manager`) 
    VALUES ('3', 'test.zip', 'test', 'test', 'test', 'test3', '11', 'email@email.com', '1', '100500', 'Super User');
INSERT INTO `#__download_items` (`cid`, `url`, `category`, `class`, `group`, `product`, `access_level`, `emailsend`, `published`, `compounds`, `manager`) 
    VALUES ('5', '', 'test', 'test', 'test', 'test5', '2', 'email@email.com', '1', '100500', 'Super User');
INSERT INTO `#__download_items` (`cid`, `url`, `category`, `class`, `group`, `product`, `access_level`, `emailsend`, `published`, `compounds`, `manager`) 
    VALUES ('7', 'test.zip', 'test', 'test', 'test', 'test7', '2', 'email@email.com', '0', '100500', 'Super User');
INSERT INTO `#__download_items` (`cid`, `url`, `category`, `class`, `group`, `product`, `access_level`, `emailsend`, `published`, `compounds`, `manager`) 
    VALUES ('9', 'test1.zip', 'test', 'test', 'test', 'test9', '2', 'email@email.com', '1', '100500', 'Super User');

INSERT INTO `#__download_stat` (`cid`, `username`, `dtime`, `category`, `class`, `group`, `product`, `ip`, `fullname`, `email`, `action_stat` )
    VALUES ( 0, 'user', NOW(), 'test', 'test', 'test', 'test', '0.0.0.0', 'F name', 'email@email.com', 'download' );