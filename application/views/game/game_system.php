<?php $user_id = Yii::app()->user->getId(); //使用者的id 
       //$user_level = Character::model()->findByPk($watch_id)->exp;?>
    <h1>使用者ID => 登入帳號 / 觀看中 => <?php echo $user_id.' / '.$watch_id?> </h1>
    <h1> <?php echo $url=Character::model()->findByPk($watch_id)->skin->url.'<br/>'; ?></h1>
    <div class="game-system">
    <div class="user-body">
    <?php //////////////////////////////////////////////////////////TEST
        //////////////////// 暫時圖片變數名稱
        $skin = Character::model()->findByPk($watch_id)->skin->url.'.png';
        $eyes = '24b6ae55f40bdbbb4fdb32a841270b3f.png';
        $hair = '7460295c7cc2e01624a84975d11b3bd3.png';
        $shoes = '1557dbd15c83e88ba07a5bb64ce49e29.png';
        $cloths = '8d2080d0d821a89d7f3b02322db50b7b.png';
        $pants = '83d966b27da098dc0b19671943a9902d.png';
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

