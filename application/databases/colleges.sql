CREATE TABLE IF NOT EXISTS `colleges` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=1 ;

INSERT INTO `colleges` (`id`, `name`) VALUES
(1, '資電學院'),
(2, '理工學院'),
(3, '地科學院'),
(4, '文學院'),
(5, '自然科學學院'),
(6, '管理學院');
