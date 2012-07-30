CREATE TABLE IF NOT EXISTS `game_missions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  `content` text NOT NULL,
  `answer` varchar(256) NOT NULL,
  `experience` int(10) unsigned NOT NULL DEFAULT 0,
  `money` int(10) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=1 ;

INSERT INTO `game_missions` (`id`, `name`, `content`, `answer`, `experience`, `money`) VALUES
(1, '1-1', '剛剛進入宿舍的光亮，發現大家都有快速的宿舍網路可以用，結果他一用，不公平阿，為什麼我不能用阿，後來一問之下才知道要去買網路卡，請問要去哪棟建築買網路卡? ', '行政大樓', 217, 100),
(2, '1-2', '有天小梁在凌晨一點多肚子餓了，可是他發現大部分的店家都關了，而且他又不想要吃便利商店，請問他應該到哪裡去尋找他的食物呢?  ', '宵夜街', 223, 200),
(3, '1-3', '有一天，想要出國遊學的哈哈想要加強他的英文，所以聽取了其他人的建議，決定多閱讀英文雜誌，可是他又不想要買全新的，請問學校裡有哪裡可以找到過期的免費雜誌?  ', '中正圖書館', 241, 300),
(4, '1-4', '小王是住在男11舍的新生，有一天在上課前，才發現他忘記要影印老師的上課講義了，可是他已經快要來不及了，所以要尋找最近的影印店，請問離男11舍最近的影印店是在哪間宿舍的地下室呢？', '女十四舍', 271, 350);
