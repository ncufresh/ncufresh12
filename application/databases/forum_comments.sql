CREATE TABLE IF NOT EXISTS `forum_comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `author_id` int(10) unsigned NOT NULL DEFAULT 0,
  `article_id` int(10) unsigned NOT NULL DEFAULT 0,
  `content` varchar(256) NOT NULL,
  `created` int(10) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=1 ;
