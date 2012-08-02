<h3> LV.<?php echo $level ?> / <?php echo $money ?> 金幣</h3>
<h3> <頭髮> </h3>
<?php $shopping = Item::model()->getBuyItems($level, 1); ?>
<?php foreach ($shopping as $item) : ?>
<?php $exist = ItemBag::model()->itemExist($item->id); ?>
<?php if ( $exist == true ) : // 如果已經有此物品 ?>
<a class="item-icons" href="<?php echo Yii::app()->createUrl('game/items', array('id'=>$user_id))?>">
    <img src="<?php echo Yii::app()->request->baseUrl ?>/statics/game/icon/hairs/<?php echo $item->filename?>.png" alt="<?php $item->name ?>">
    <div class="item-description">
        <h4>&lt; <?php echo $item->name ?> &gt;</h4>
        <span class="description"><?php echo $item->description ?></span>
        <span>需求等級：LV.<?php echo $item->level?> / 價值：<?php echo $item->price ?> 金幣</span>
        <span class="exist">（已經擁有此道具）</span>
<?php else : // 如果沒有此物品 ?>
<a class="item-icons" href="<?php echo Yii::app()->createUrl('game/buy', array('id'=>$item->id))?>">
    <img src="<?php echo Yii::app()->request->baseUrl ?>/statics/game/icon/question-mark.png" alt="<?php $item->name ?>">
    <div class="item-description">
        <h4>&lt; <?php echo $item->name ?> &gt;</h4>
        <span class="description">？？？？？</span>
        <span>需求等級：LV.<?php echo $item->level?> / 價值：<?php echo $item->price ?> 金幣</span>
<?php endif; ?>
    </div>
</a>
<?php endforeach; ?>

<h3> <臉飾> </h3>
<?php $shopping = Item::model()->getBuyItems($level, 2); ?>
<?php foreach ($shopping as $item) : ?>
<?php $exist = ItemBag::model()->itemExist($item->id); ?>
<?php if ( $exist == true ) : // 如果已經有此物品 ?>
<a class="item-icons" href="<?php echo Yii::app()->createUrl('game/items', array('id'=>$user_id))?>">
    <img src="<?php echo Yii::app()->request->baseUrl ?>/statics/game/icon/eyes/<?php echo $item->filename?>.png" alt="<?php $item->name ?>">
    <div class="item-description">
        <h4>&lt; <?php echo $item->name ?> &gt;</h4>
        <span class="description"><?php echo $item->description ?></span>
        <span>需求等級：LV.<?php echo $item->level?> / 價值：<?php echo $item->price ?> 金幣</span>
        <span class="exist">（已經擁有此道具）</span>
<?php else : // 如果沒有此物品 ?>
<a class="item-icons" href="<?php echo Yii::app()->createUrl('game/buy', array('id'=>$item->id))?>">
    <img src="<?php echo Yii::app()->request->baseUrl ?>/statics/game/icon/question-mark.png" alt="<?php $item->name ?>">
    <div class="item-description">
        <h4>&lt; <?php echo $item->name ?> &gt;</h4>
        <span class="description">？？？？？</span>
        <span>需求等級：LV.<?php echo $item->level?> / 價值：<?php echo $item->price ?> 金幣</span>
<?php endif; ?>
    </div>
</a>
<?php endforeach; ?>

<h3> <衣服> </h3>
<?php $shopping = Item::model()->getBuyItems($level, 3); ?>
<?php foreach ($shopping as $item) : ?>
<?php $exist = ItemBag::model()->itemExist($item->id); ?>
<?php if ( $exist == true ) : // 如果已經有此物品 ?>
<a class="item-icons" href="<?php echo Yii::app()->createUrl('game/items', array('id'=>$user_id))?>">
    <img src="<?php echo Yii::app()->request->baseUrl ?>/statics/game/icon/clothes/<?php echo $item->filename?>.png" alt="<?php $item->name ?>">
    <div class="item-description">
        <h4>&lt; <?php echo $item->name ?> &gt;</h4>
        <span class="description"><?php echo $item->description ?></span>
        <span>需求等級：LV.<?php echo $item->level?> / 價值：<?php echo $item->price ?> 金幣</span>
        <span class="exist">（已經擁有此道具）</span>
<?php else : // 如果沒有此物品 ?>
<a class="item-icons" href="<?php echo Yii::app()->createUrl('game/buy', array('id'=>$item->id))?>">
    <img src="<?php echo Yii::app()->request->baseUrl ?>/statics/game/icon/question-mark.png" alt="<?php $item->name ?>">
    <div class="item-description">
        <h4>&lt; <?php echo $item->name ?> &gt;</h4>
        <span class="description">？？？？？</span>
        <span>需求等級：LV.<?php echo $item->level?> / 價值：<?php echo $item->price ?> 金幣</span>
<?php endif; ?>
    </div>
</a>
<?php endforeach; ?>

<h3> <褲子> </h3>
<?php $shopping = Item::model()->getBuyItems($level, 4); ?>
<?php foreach ($shopping as $item) : ?>
<?php $exist = ItemBag::model()->itemExist($item->id); ?>
<?php if ( $exist == true ) : // 如果已經有此物品 ?>
<a class="item-icons" href="<?php echo Yii::app()->createUrl('game/items', array('id'=>$user_id))?>">
    <img src="<?php echo Yii::app()->request->baseUrl ?>/statics/game/icon/pants/<?php echo $item->filename?>.png" alt="<?php $item->name ?>">
    <div class="item-description">
        <h4>&lt; <?php echo $item->name ?> &gt;</h4>
        <span class="description"><?php echo $item->description ?></span>
        <span>需求等級：LV.<?php echo $item->level?> / 價值：<?php echo $item->price ?> 金幣</span>
        <span class="exist">（已經擁有此道具）</span>
<?php else : // 如果沒有此物品 ?>
<a class="item-icons" href="<?php echo Yii::app()->createUrl('game/buy', array('id'=>$item->id))?>">
    <img src="<?php echo Yii::app()->request->baseUrl ?>/statics/game/icon/question-mark.png" alt="<?php $item->name ?>">
    <div class="item-description">
        <h4>&lt; <?php echo $item->name ?> &gt;</h4>
        <span class="description">？？？？？</span>
        <span>需求等級：LV.<?php echo $item->level?> / 價值：<?php echo $item->price ?> 金幣</span>
<?php endif; ?>
    </div>
</a>
<?php endforeach; ?>

<h3> <鞋子> </h3>
<?php $shopping = Item::model()->getBuyItems($level, 5); ?>
<?php foreach ($shopping as $item) : ?>
<?php $exist = ItemBag::model()->itemExist($item->id); ?>
<?php if ( $exist == true ) : // 如果已經有此物品 ?>
<a class="item-icons" href="<?php echo Yii::app()->createUrl('game/items', array('id'=>$user_id))?>">
    <img src="<?php echo Yii::app()->request->baseUrl ?>/statics/game/icon/shoes/<?php echo $item->filename?>.png" alt="<?php $item->name ?>">
    <div class="item-description">
        <h4>&lt; <?php echo $item->name ?> &gt;</h4>
        <span class="description"><?php echo $item->description ?></span>
        <span>需求等級：LV.<?php echo $item->level?> / 價值：<?php echo $item->price ?> 金幣</span>
        <span class="exist">（已經擁有此道具）</span>
<?php else : // 如果沒有此物品 ?>
<a class="item-icons" href="<?php echo Yii::app()->createUrl('game/buy', array('id'=>$item->id))?>">
    <img src="<?php echo Yii::app()->request->baseUrl ?>/statics/game/icon/question-mark.png" alt="<?php $item->name ?>">
    <div class="item-description">
        <h4>&lt; <?php echo $item->name ?> &gt;</h4>
        <span class="description">？？？？？</span>
        <span>需求等級：LV.<?php echo $item->level?> / 價值：<?php echo $item->price ?> 金幣</span>
<?php endif; ?>
    </div>
</a>
<?php endforeach; ?>

<h3> <皮膚> </h3>
<?php $shopping = Item::model()->getBuyItems($level, 6); ?>
<?php foreach ($shopping as $item) : ?>
<?php $exist = ItemBag::model()->itemExist($item->id); ?>
<?php if ( $exist == true ) : // 如果已經有此物品 ?>
<a class="item-icons" href="<?php echo Yii::app()->createUrl('game/items', array('id'=>$user_id))?>">
    <img src="<?php echo Yii::app()->request->baseUrl ?>/statics/game/icon/skins/<?php echo $item->filename?>.png" alt="<?php $item->name ?>">
    <div class="item-description">
        <h4>&lt; <?php echo $item->name ?> &gt;</h4>
        <span class="description"><?php echo $item->description ?></span>
        <span>需求等級：LV.<?php echo $item->level?> / 價值：<?php echo $item->price ?> 金幣</span>
        <span class="exist">（已經擁有此道具）</span>
<?php else : // 如果沒有此物品 ?>
<a class="item-icons" href="<?php echo Yii::app()->createUrl('game/buy', array('id'=>$item->id))?>">
    <img src="<?php echo Yii::app()->request->baseUrl ?>/statics/game/icon/question-mark.png" alt="<?php $item->name ?>">
    <div class="item-description">
        <h4>&lt; <?php echo $item->name ?> &gt;</h4>
        <span class="description">？？？？？</span>
        <span>需求等級：LV.<?php echo $item->level?> / 價值：<?php echo $item->price ?> 金幣</span>
<?php endif; ?>
    </div>
</a>
<?php endforeach; ?>

<h3> <其他裝備> </h3>
<?php $shopping = Item::model()->getBuyItems($level, 7); ?>
<?php foreach ($shopping as $item) : ?>
<?php $exist = ItemBag::model()->itemExist($item->id); ?>
<?php if ( $exist == true ) : // 如果已經有此物品 ?>
<a class="item-icons" href="<?php echo Yii::app()->createUrl('game/items', array('id'=>$user_id))?>">
    <img src="<?php echo Yii::app()->request->baseUrl ?>/statics/game/icon/others/<?php echo $item->filename?>.png" alt="<?php $item->name ?>">
    <div class="item-description">
        <h4>&lt; <?php echo $item->name ?> &gt;</h4>
        <span class="description"><?php echo $item->description ?></span>
        <span>需求等級：LV.<?php echo $item->level?> / 價值：<?php echo $item->price ?> 金幣</span>
        <span class="exist">（已經擁有此道具）</span>
<?php else : // 如果沒有此物品 ?>
<a class="item-icons" href="<?php echo Yii::app()->createUrl('game/buy', array('id'=>$item->id))?>">
    <img src="<?php echo Yii::app()->request->baseUrl ?>/statics/game/icon/question-mark.png" alt="<?php $item->name ?>">
    <div class="item-description">
        <h4>&lt; <?php echo $item->name ?> &gt;</h4>
        <span class="description">？？？？？</span>
        <span>需求等級：LV.<?php echo $item->level?> / 價值：<?php echo $item->price ?> 金幣</span>
<?php endif; ?>
    </div>
</a>
<?php endforeach; ?>