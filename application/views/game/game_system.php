<?php $watch_id = Yii::app()->user->getId() //正在觀看頁面的id ?>

<div class="game-system">
    <div class="user-body">
    <?php 
        //////////////////// 暫時圖片變數名稱
        $skin = 'boyC1.png';
        $eyes = 'e9.png';
        $hair = 'hairN5.png';
        $shoes = 'shoeN5.png';
        $cloths = 'clothseN4.png';
        $pants = 'pantsN3.png';
    ?>
    <img src="<?php echo Yii::app()->baseUrl; ?>/statics/game/skin/<?php echo $skin;?>" >
    <img src="<?php echo Yii::app()->baseUrl; ?>/statics/game/eyes/<?php echo $eyes;?>" >
    <img src="<?php echo Yii::app()->baseUrl; ?>/statics/game/hair/<?php echo $hair;?>" >
    <img src="<?php echo Yii::app()->baseUrl; ?>/statics/game/shoes/<?php echo $shoes;?>" >
    <img src="<?php echo Yii::app()->baseUrl; ?>/statics/game/pants/<?php echo $pants;?>" >
    <img src="<?php echo Yii::app()->baseUrl; ?>/statics/game/cloths/<?php echo $cloths;?>" >
    </div>
    <div class="function-body">
        <ul class="game-button">
<?php if ( $watch_id == $user_id ) : ?>
            <li class="enabled">
                <a href="" title="任務">任務</a>
            </li>
<?php else : ?>
            <li class="disabled">
                任務
            </li>
<?php endif; ?>
            <li class="enabled">
                <a href="" title="成就">成就</a>
            </li>
            <li class="enabled">
                <a href="" title="道具">道具</a>
            </li>
<?php if ( $watch_id == $user_id ) : ?>
            <li class="enabled">
                <a href="" title="商城">商城</a>
            </li>
<?php else : ?>
            <li class="disabled">
                商城
            </li>
<?php endif; ?>
            <li class="enabled">
                <a href="" title="惡搞">惡搞</a>
            </li>
        </ul>
        <div class="game-display">

            <h1>目前使用者ID => <?php echo $watch_id?> </h1>
            <h1>觀看使用者ID => <?php echo $user_id;?></h1>
            <?php echo $content ?>
            <h1>TEST</h1>
            <h1>TEST</h1>
            <h1>TEST</h1>
            <h1>TEST</h1>
            <h1>TEST</h1>
            <h1>TEST</h1>
            <h1>TEST</h1>
            <h1>TEST</h1>
            <h1>TEST</h1>


        </div>
    </div>
</div>

