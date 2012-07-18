<img src="../statics/fire.png">
<?php   
        $id = 2;
        echo '<br/>Id：';
        print_r(Game::model()->getId($id));
        echo '<br/>User_Id：';
        print_r(Game::model()->getUserId($id));
        echo '<br/>頭髮：';
        print_r(Game::model()->getHairName($id));
        echo '<br/>眼睛：';
        print_r(Game::model()->getEyesName($id));
        echo '<br/>衣服：';
        print_r(Game::model()->getClothsName($id));
        echo '<br/>褲子：';
        print_r(Game::model()->getPantsName($id));
        echo '<br/>手勢：';
        print_r(Game::model()->getHandsName($id));
        echo '<br/>鞋子：';
        print_r(Game::model()->getShoesName($id));
        echo '<br/>特殊寶物：';
        print_r(Game::model()->getOthersName($id));
        echo '<br/>經驗值：';
        print_r(Game::model()->getExpValue($id));
        echo '<br/>金錢：';
        print_r(Game::model()->getMoneyValue($id));
?>