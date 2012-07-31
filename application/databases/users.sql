CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(256) NOT NULL,
  `password` char(128) NOT NULL,
  `salt` char(128) NOT NULL,
  `is_admin` tinyint(1) unsigned NOT NULL DEFAULT 0,
  `register_ip` int(10) unsigned NOT NULL DEFAULT 0,
  `last_login_ip` int(10) unsigned NOT NULL DEFAULT 0,
  `last_login_timestamp` int(10) unsigned NOT NULL DEFAULT 0,
  `online_count` int(10) unsigned NOT NULL DEFAULT 0,
  `created` int(10) NOT NULL DEFAULT 0,
  `updated` int(10) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=1 ;
