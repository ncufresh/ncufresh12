CREATE TABLE IF NOT EXISTS `calendar_events` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `calendar_id` int(10) unsigned NOT NULL DEFAULT 0,
  `name` varchar(256) NOT NULL,
  `description` text NOT NULL,
  `start` int(10) unsigned NOT NULL DEFAULT 0,
  `end` int(10) unsigned NOT NULL DEFAULT 0,
  `created` int(10) unsigned NOT NULL DEFAULT 0,
  `invisible` tinyint(1) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=1 ;
