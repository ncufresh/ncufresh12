<?php $user_id = Yii::app()->user->getId(); //使用者的id 
       //$user_level = Character::model()->findByPk($watch_id)->exp;?>
    <h1>使用者ID => 登入帳號 / 觀看中 => <?php echo $user_id.' / '.$watch_id?> </h1>
    <div class="game-system">
    <div class="user-body">
    <?php //////////////////////////////////////////////////////////TEST
        //////////////////// 暫時圖片變數名稱
        $skin = 'girlN4.png';
        $eyes = 'faceN15.png';
        $hair = 'hairN15.png';
        $shoes = 'shoeN11.png';
        $cloths = 'clothesN12.png';
        $pants = 'pantsN12.png';
        ///////////////////////////////////////////////////////////////TEST
    ?>
    <img src="<?php echo Yii::app()->baseUrl; ?>/statics/game/skin/<?php echo $skin;?>" >
    <img src="<?php echo Yii::app()->baseUrl; ?>/statics/game/eyes/<?php echo $eyes;?>" >
    <img src="<?php echo Yii::app()->baseUrl; ?>/statics/game/hair/<?php echo $hair;?>" >
    <img src="<?php echo Yii::app()->baseUrl; ?>/statics/game/shoes/<?php echo $shoes;?>" >
    <img src="<?php echo Yii::app()->baseUrl; ?>/statics/game/pants/<?php echo $pants;?>" >
    <img src="<?php echo Yii::app()->baseUrl; ?>/statics/game/clothes/<?php echo $cloths;?>" >
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

