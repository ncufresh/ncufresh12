CREATE TABLE IF NOT EXISTS `chat_messages` (
  `uuid` char(32) NOT NULL,
  `sender_id` int(10) unsigned NOT NULL DEFAULT 0,
  `receiver_id` int(10) unsigned NOT NULL DEFAULT 0,
  `message` char(128) NOT NULL,
  `timestamp` int(10) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ;
