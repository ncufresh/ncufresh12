CREATE TABLE IF NOT EXISTS `forum_article_categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=1 ;

INSERT INTO `forum_article_categories` (`id`, `name`) VALUES
(1, '生活'),
(2, '課業'),
(3, '宿舍'),
(4, '分享'),
(5, '遊戲'),
(6, '自介'),
(7, '學術'),
(8, '康樂'),
(9, '服務'),
(10, '聯誼'),
(11, '其他');
