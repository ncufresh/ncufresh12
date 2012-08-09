CREATE TABLE IF NOT EXISTS `forum_articles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `author_id` int(10) unsigned NOT NULL DEFAULT 0,
  `forum_id` int(10) unsigned NOT NULL DEFAULT 0,
  `category_id` int(10) unsigned NOT NULL DEFAULT 0,
  `sticky` tinyint(1) unsigned NOT NULL,
  `title` varchar(256) NOT NULL,
  `content` text NOT NULL,
  `viewed` int(10) unsigned NOT NULL DEFAULT 0,
  `replies_count` int(10) unsigned NOT NULL DEFAULT 0,
  `created` int(10) unsigned NOT NULL DEFAULT 0,
  `updated` int(10) unsigned NOT NULL DEFAULT 0,
  `invisible` tinyint(1) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=1 ;
