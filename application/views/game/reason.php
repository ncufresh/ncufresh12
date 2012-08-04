<h4 class="game-title"> 商城精靈訊息 </h4>
<h4 class="shop-message"> <?php echo $reason ?> </h4>
<span class="shop-click">< 
<a class="shop-click" href="<?php echo Yii::app()->createUrl('game/shop', array('id' => $watch_id));  ?>">繼續購買</a> | 
<a class="shop-click" href="<?php echo Yii::app()->createUrl('game/items', array('id' => $watch_id));  ?>">道具列表</a> >
</span>