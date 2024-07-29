CREATE TABLE IF NOT EXISTS `#__download_items` (
    `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    `cid` INT(10) UNSIGNED NOT NULL DEFAULT 0,
    `url` VARCHAR(255),
    `category` VARCHAR(255),
    `class` VARCHAR(255),
    `group` VARCHAR(255),
    `product` VARCHAR(255),
    `type` VARCHAR(255),
    `usersgroup` VARCHAR(255),
    `emailsend` VARCHAR(255),
    `MD5` VARCHAR(255),
    `published` TINYINT(4) NOT NULL DEFAULT 0,
    `publish_up` DATETIME,
    `compounds` VARCHAR(255),
    `manager` VARCHAR(255),
    PRIMARY KEY (`id`)
) ENGINE = InnoDB AUTO_INCREMENT = 11 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `#__download_stat` (
    `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    `cid` INT(10) UNSIGNED NOT NULL DEFAULT 0,
    `username` VARCHAR(255),
    `dtime` DATETIME,
    `category` VARCHAR(255),
    `class` VARCHAR(255),
    `group` VARCHAR(255),
    `product` VARCHAR(255),
    `type` VARCHAR(255),
    `ip` VARCHAR(255),
    `fullname` VARCHAR(255),
    `action_stat` VARCHAR(255),
    `email` VARCHAR(255),
    PRIMARY KEY (`id`)
) ENGINE = InnoDB AUTO_INCREMENT = 11 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `#__cta_access` (
    `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    `asset_id` INT(10) UNSIGNED NOT NULL DEFAULT 0,
    `created_date` DATETIME,
    `created_by` INT(11),
    `fullname` VARCHAR(255),
    `email` VARCHAR(255),
    `message` text NOT NULL,
    `company` text NOT NULL,
    `download_file` INT(11),
    `page_name` VARCHAR(255),
    `page_url` text NOT NULL,
    `ip` varchar(45) NOT NULL,
    UNIQUE KEY `id` (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `#__cta_file_request` (
    `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    `asset_id` INT(10) UNSIGNED NOT NULL DEFAULT 0,
    `created_date` DATETIME,
    `created_by` int DEFAULT NULL,
    `fullname` VARCHAR(255),
    `email` VARCHAR(255),
    `message` text,
    `company` text,
    `download_file` int DEFAULT NULL,
    `page_name` VARCHAR(255),
    `page_url` text,
    `ip` varchar(45) DEFAULT NULL,
    UNIQUE KEY `id` (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

INSERT INTO
    `#__download_items` (
        `cid`,
        `url`,
        `category`,
        `class`,
        `group`,
        `product`,
        `usersgroup`,
        `emailsend`,
        `published`,
        `publish_up`,
        `compounds`,
        `manager`
    )
VALUES
    (
        1,
        'test.zip',
        'test',
        'test',
        'test',
        'test',
        '2',
        'email@email.com',
        '1',
        NOW(),
        '100500',
        'Super User'
    );

INSERT INTO
    `#__download_items` (
        `cid`,
        `url`,
        `category`,
        `class`,
        `group`,
        `product`,
        `usersgroup`,
        `emailsend`,
        `published`,
        `publish_up`,
        `compounds`,
        `manager`
    )
VALUES
    (
        3,
        'test.zip',
        'test',
        'test',
        'test',
        'test',
        '11',
        'email@email.com',
        '1',
        NOW(),
        '100500',
        'Super User'
    );

INSERT INTO
    `#__download_items` (
        `cid`,
        `url`,
        `category`,
        `class`,
        `group`,
        `product`,
        `usersgroup`,
        `emailsend`,
        `published`,
        `publish_up`,
        `compounds`,
        `manager`
    )
VALUES
    (
        5,
        '',
        'test',
        'test',
        'test',
        'test',
        '2',
        'email@email.com',
        '1',
        NOW(),
        '100500',
        'Super User'
    );

INSERT INTO
    `#__download_items` (
        `cid`,
        `url`,
        `category`,
        `class`,
        `group`,
        `product`,
        `usersgroup`,
        `emailsend`,
        `published`,
        `publish_up`,
        `compounds`,
        `manager`
    )
VALUES
    (
        7,
        'test.zip',
        'test',
        'test',
        'test',
        'test',
        '2',
        'email@email.com',
        '0',
        NOW(),
        '100500',
        'Super User'
    );

INSERT INTO
    `#__download_items` (
        `cid`,
        `url`,
        `category`,
        `class`,
        `group`,
        `product`,
        `usersgroup`,
        `emailsend`,
        `published`,
        `publish_up`,
        `compounds`,
        `manager`
    )
VALUES
    (
        9,
        'test1.zip',
        'test',
        'test',
        'test',
        'test',
        '2',
        'email@email.com',
        '1',
        NOW(),
        '100500',
        'Super User'
    );

INSERT INTO
    `#__download_stat` (
        `cid`,
        `username`,
        `dtime`,
        `category`,
        `class`,
        `group`,
        `product`,
        `ip`,
        `fullname`,
        `email`,
        `action_stat`
    )
VALUES
    (
        0,
        'user',
        NOW(),
        'test',
        'test',
        'test',
        'test',
        '0.0.0.0',
        'F name',
        'email@email.com',
        'download'
    );