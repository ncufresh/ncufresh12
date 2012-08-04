CREATE TABLE IF NOT EXISTS `forum_categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `master_id` int(10) unsigned NOT NULL DEFAULT 0,
  `name` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=1 ;

INSERT INTO `forum_categories` (`id`, `master_id`, `name`) VALUES
(1, 4, '綜合討論'),
(2, 0, '社團討論'),
(3, 60, '中國文學系'),
(4, 58, '英美語文學系'),
(5, 48, '法國語文學系'),
(6, 57, '土木工程學系'),
(7, 43, '機械工程學系'),
(8, 51, '化學工程與材料工程學系'),
(9, 42, '資訊工程學系'),
(10, 56, '電機工程學系'),
(11, 49, '通訊工程學系'),
(12, 46, '數學系'),
(13, 47, '化學系'),
(14, 53, '物理學系'),
(15, 45, '生命科學系'),
(16, 61, '理學院學士班'),
(17, 41, '光電科學與工程學系'),
(18, 52, '經濟學系'),
(19, 59, '企業管理學系'),
(20, 44, '資訊管理學系'),
(21, 55, '財務金融學系'),
(22, 54, '地球科學系'),
(23, 50, '大氣科學系');
