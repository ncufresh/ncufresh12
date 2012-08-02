<?php $user_id = Yii::app()->user->getId(); //使用者的id 
       //$user_level = Character::model()->findByPk($watch_id)->exp;?>
    <div class="game-system">
    <div class="user-body">
<?php $this->widget('Avatar', array(
    'id'        => $watch_id
)); ?>
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
<div id="game-mission-dialog">
    <h4>Mission：<span class="MissionName"></span></h4>
        <img src="<?php echo Yii::app()->request->baseUrl;?>/statics/game/npc/<? echo rand(0,9)?>.png" alt="npc" class="npc"/>
    <div class="display">
        
    </div>
    <form action="#" method="post" >
    <span>解答：</span>
    <input type="text" name="answer" />
    <button type="submit">送啦~!!!</button>
    </form>
        <?php $this->widget('Avatar', array(
            'id'        => $watch_id
        )); ?>
</div>
    <h1>使用者ID => 登入帳號 / 觀看中 => <?php echo $user_id.' / '.$watch_id?> </h1>
