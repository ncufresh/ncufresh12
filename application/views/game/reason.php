<h1> 商城精靈表示： </h1>
<h1> <?php echo $reason ?> </h1>
<a href="<?php echo Yii::app()->createUrl('game/shop', array('id' => $watch_id));  ?>">回商店購買</a></br>
<a href="<?php echo Yii::app()->createUrl('game/items', array('id' => $watch_id));  ?>">回道具列表</a>