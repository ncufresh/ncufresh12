CREATE TABLE IF NOT EXISTS `chat_queues` (
  `uuid` char(32) COLLATE utf8_general_ci NOT NULL,
  `sender_id` int(10) unsigned NOT NULL,
  `receiver_id` int(10) unsigned NOT NULL,
  `message` char(128) COLLATE utf8_general_ci NOT NULL,
  `timestamp` int(10) unsigned NOT NULL DEFAULT 0,
  `sequence` int(10) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`uuid`)
) ENGINE=MEMORY DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ; 