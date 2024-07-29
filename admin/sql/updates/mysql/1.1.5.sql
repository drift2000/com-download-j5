CREATE TABLE IF NOT EXISTS `#__cta_file_request` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `asset_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'FK to the #__assets table.',
  `created_date` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` text NOT NULL COMMENT 'Message or Comment',
  `company` text NOT NULL,
  `download_file` int(11) NOT NULL,
  `page_name` varchar(255) NOT NULL,
  `page_url` text NOT NULL,
  `ip` varchar(45) NOT NULL COMMENT 'user IP',
  UNIQUE KEY `id` (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;