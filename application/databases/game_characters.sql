CREATE TABLE IF NOT EXISTS `game_characters` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `skin_id` int(10) unsigned NOT NULL DEFAULT 0,
  `hair_id` int(10) unsigned NOT NULL DEFAULT 0,
  `eyes_id` int(10) unsigned NOT NULL DEFAULT 0,
  `clothes_id` int(10) unsigned NOT NULL DEFAULT 0,
  `pants_id` int(10) unsigned NOT NULL DEFAULT 0,
  `shoes_id` int(10) unsigned NOT NULL DEFAULT 0,
  `others_id` int(10) unsigned NOT NULL DEFAULT 0,
  `missions` int(10) unsigned NOT NULL DEFAULT 0,
  `experience` int(10) unsigned NOT NULL DEFAULT 0,
  `money` int(10) unsigned NOT NULL DEFAULT 0,
  `total_money` int(10) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=1 ;
