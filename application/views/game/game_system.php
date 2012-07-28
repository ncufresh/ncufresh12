<?php $user_id = Yii::app()->user->getId(); //使用者的id 
       //$user_level = Character::model()->findByPk($watch_id)->exp;?>
    <h1>使用者ID => 登入帳號 / 觀看中 => <?php echo $user_id.' / '.$watch_id?> </h1>
    <div class="game-system">
    <div class="user-body">
    <?php //////////////////////////////////////////////////////////TEST
        //////////////////// 暫時圖片變數名稱
        $skin = 'dabd2c330e4a579318957466be2fc94d.png';
        $eyes = 'ab8f56301214e55e906e68da171391f6.png';
        $hair = '8f8a84c4223c13a8dfa275f6d7d9676b.png';
        $shoes = '90f4dfcd8cc45edad70c06997973a4b0.png';
        $cloths = '6c95a392dbd908f05b1401e857cd343b.png';
        $pants = '64a9c4b82d554df4d60b558bb689d902.png';
        $others = '5a9d0b4a51332cbcdd5f49c83c53f1d4.png';
        ///////////////////////////////////////////////////////////////TEST
    ?>
    <img src="<?php echo Yii::app()->baseUrl; ?>/statics/game/skin/<?php echo $skin;?>" >
    <img src="<?php echo Yii::app()->baseUrl; ?>/statics/game/eyes/<?php echo $eyes;?>" >
    <img src="<?php echo Yii::app()->baseUrl; ?>/statics/game/hair/<?php echo $hair;?>" >
    <img src="<?php echo Yii::app()->baseUrl; ?>/statics/game/shoes/<?php echo $shoes;?>" >
    <img src="<?php echo Yii::app()->baseUrl; ?>/statics/game/pants/<?php echo $pants;?>" >
    <img src="<?php echo Yii::app()->baseUrl; ?>/statics/game/clothes/<?php echo $cloths;?>" >
    <img src="<?php echo Yii::app()->baseUrl; ?>/statics/game/others/<?php echo $others;?>" >
    </div>
    <div class="function-body">
        <ul class="game-button">
            <li class="enabled">
                <a href="<?php echo Yii::app()->createUrl('game/index', array('id'=>$watch_id)) ?>" title="資訊">資訊</a>
            </li>
<?php if ( $watch_id == $user_id ) : ?>
            <li class="enabled">
                <a href="<?php echo Yii::app()->createUrl('game/missions', array('id'=>$watch_id)) ?>" title="任務">任務</a>
            </li>
<?php else : ?>
            <li class="disabled">
                任務
            </li>
<?php endif; ?>
            <li class="enabled">
                <a href="<?php echo Yii::app()->createUrl('game/achievements', array('id'=>$watch_id)) ?>" title="成就">成就</a>
            </li>
            <li class="enabled">
                <a href="<?php echo Yii::app()->createUrl('game/items', array('id'=>$watch_id)) ?>" title="道具">道具</a>
            </li>
<?php if ( $watch_id == $user_id ) : ?>
            <li class="enabled">
                <a href="<?php echo Yii::app()->createUrl('game/shop', array('id'=>$watch_id)) ?>" title="商城">商城</a>
            </li>
<?php else : ?>
            <li class="disabled">
                商城
            </li>
<?php endif; ?>
        </ul>
        <div class="game-display">
            
            <?php echo $content; ?>
        </div>
    </div>
</div>

