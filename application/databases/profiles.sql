CREATE TABLE IF NOT EXISTS `profiles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `department_id` int(10) unsigned NOT NULL DEFAULT 0,
  `name` varchar(256) NOT NULL,
  `nickname` varchar(256) NOT NULL,
  `grade` tinyint(1) unsigned NOT NULL DEFAULT 0,
  `senior` varchar(256) NOT NULL DEFAULT 0,
  `birthday` int(10) unsigned NOT NULL DEFAULT 0,
  `gender` tinyint(1) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=1 ;
