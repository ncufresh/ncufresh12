CREATE TABLE IF NOT EXISTS `departments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `college_id` int(10) unsigned NOT NULL DEFAULT 0,
  `name` varchar(256) NOT NULL,
  `abbreviation` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=1 ;

INSERT INTO `departments` (`id`, `college_id`, `name`, `abbreviation`) VALUES
(1, 1, '電機工程學系 ', '電機系'),
(2, 1, '資訊工程學系 ', '資工系'),
(3, 1, '通訊工程學系', '通訊系'),
(4, 2, '機械工程學系 ', '機械系'),
(5, 2, '土木工程學系 ', '土木系'),
(6, 2, '化學工程與材料工程學系', '化工系'),
(7, 3, '地球科學學系', '地科系'),
(8, 3, '大氣科學學系', '大氣系'),
(9, 4, '中國文學系 ', '中文系'),
(10, 4, '英美語文學系 ', '英文系'),
(11, 4, '法國語文學系 ', '法文系'),
(12, 5, '理學院學士班 ', '理學院'),
(13, 5, '物理學系 ', '物理系'),
(14, 5, '數學系 ', '數學系'),
(15, 5, '化學學系 ', '化學系 '),
(16, 5, '生命科學系 ', '生科系 '),
(17, 5, '光電科學與工程學系 ', '光電系 '),
(18, 6, '企業管理學系 ', '企管系'),
(19, 6, ' 資訊管理學系', '資管系'),
(20, 6, '財務金融學系 ', '財金系'),
(21, 6, '經濟學系 ', '經濟系');