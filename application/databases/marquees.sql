CREATE TABLE IF NOT EXISTS `marquees` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `message` varchar(256) NOT NULL,
  `invisible` tinyint(1) unsigned NOT NULL DEFAULT 0,
  `updated` int(10) unsigned NOT NULL DEFAULT 0,
  `created` int(10) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=1 ;
