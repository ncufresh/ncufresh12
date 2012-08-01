CREATE TABLE IF NOT EXISTS `forum_categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `master_id` int(10) unsigned NOT NULL DEFAULT 0,
  `name` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=1 ;

INSERT INTO `forum_categories` (`id`, `master_id`, `name`) VALUES
(1, 4, '綜合討論'),
(2, 0, '社團討論'),
(3, 0, '中國文學系'),
(4, 0, '英美語文學系'),
(5, 0, '法國語文學系'),
(6, 0, '土木工程學系'),
(7, 0, '機械工程學系'),
(8, 0, '化學工程與材料工程學系'),
(9, 0, '資訊工程學系'),
(10, 0, '電機工程學系'),
(11, 0, '通訊工程學系'),
(12, 0, '數學系'),
(13, 0, '化學系'),
(14, 0, '物理學系'),
(15, 0, '生命科學系'),
(16, 0, '理學院學士班'),
(17, 0, '光電科學與工程學系'),
(18, 0, '經濟學系'),
(19, 0, '企業管理學系'),
(20, 0, '資訊管理學系'),
(21, 0, '財務金融學系'),
(22, 0, '地球科學系'),
(23, 0, '大氣科學系');
