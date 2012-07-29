CREATE TABLE IF NOT EXISTS `activities` (
  `uuid` char(32) COLLATE utf8_general_ci NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `ip` int(10) unsigned NOT NULL DEFAULT 0,
  `timestamp` int(10) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`uuid`)
) ENGINE=MEMORY DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ;