<h4 class="game-title">道具列表</h4>

<?php $items_bag = $character_data->getItemsByCategory(1); ?>
<h4 class="item-category">頭髮<b> （<?php echo count($items_bag)?>）</b></h4>
<?php foreach ($items_bag as $item) : ?>
<a class="own-items item-icons" href="<?php echo Yii::app()->createUrl('game/equip', array('id'=>$item->item_id))?>">
    <img src="<?php echo Yii::app()->request->baseUrl ?>/statics/game/icons/hairs/<?php echo $item->translation->filename?>.png" alt="<?php $item->translation->name ?>">
    <div class="item-description">
        <h4>&lt; <?php echo $item->translation->name ?> &gt;</h4>
        <span class="description"><?php echo $item->translation->description ?></span>
        <span>[ 需求等級：LV.<?php echo $item->translation->level?> / 價值：<?php echo $item->translation->price ?> 金幣 ]</span>
        <span>[ 獲取時間：<?php echo Yii::app()->format->datetime($item->created)?> ]</span>
    </div>
</a>
<?php endforeach; ?>

<?php $items_bag = $character_data->getItemsByCategory(2); ?>
<h4 class="item-category">臉飾<b> （<?php echo count($items_bag)?>）</b></h4>
<?php foreach ($items_bag as $item) : ?>
<a class="own-items item-icons" href="<?php echo Yii::app()->createUrl('game/equip', array('id'=>$item->item_id))?>">
    <img src="<?php echo Yii::app()->request->baseUrl ?>/statics/game/icons/eyes/<?php echo $item->translation->filename?>.png" alt="<?php $item->translation->name ?>">
    <div class="item-description">
        <h4>&lt; <?php echo $item->translation->name ?> &gt;</h4>
        <span class="description"><?php echo $item->translation->description ?></span>
        <span>[ 需求等級：LV.<?php echo $item->translation->level?> / 價值：<?php echo $item->translation->price ?> 金幣 ]</span>
        <span>[ 獲取時間：<?php echo Yii::app()->format->datetime($item->created)?> ]</span>
    </div>
</a>
<?php endforeach; ?>

<?php $items_bag = $character_data->getItemsByCategory(3); ?>
<h4 class="item-category">衣服<b> （<?php echo count($items_bag)?>）</b></h4>
<?php foreach ($items_bag as $item) : ?>
<a class="own-items item-icons" href="<?php echo Yii::app()->createUrl('game/equip', array('id'=>$item->item_id))?>">
    <img src="<?php echo Yii::app()->request->baseUrl ?>/statics/game/icons/clothes/<?php echo $item->translation->filename?>.png" alt="<?php $item->translation->name ?>">
    <div class="item-description">
        <h4>&lt; <?php echo $item->translation->name ?> &gt;</h4>
        <span class="description"><?php echo $item->translation->description ?></span>
        <span>[ 需求等級：LV.<?php echo $item->translation->level?> / 價值：<?php echo $item->translation->price ?> 金幣 ]</span>
        <span>[ 獲取時間：<?php echo Yii::app()->format->datetime($item->created)?> ]</span>
    </div>
</a>
<?php endforeach; ?>

<?php $items_bag = $character_data->getItemsByCategory(4); ?>
<h4 class="item-category">褲子<b> （<?php echo count($items_bag)?>）</b></h4>
<?php foreach ($items_bag as $item) : ?>
<a class="own-items item-icons" href="<?php echo Yii::app()->createUrl('game/equip', array('id'=>$item->item_id))?>">
    <img src="<?php echo Yii::app()->request->baseUrl ?>/statics/game/icons/pants/<?php echo $item->translation->filename?>.png" alt="<?php $item->translation->name ?>">
    <div class="item-description">
        <h4>&lt; <?php echo $item->translation->name ?> &gt;</h4>
        <span class="description"><?php echo $item->translation->description ?></span>
        <span>[ 需求等級：LV.<?php echo $item->translation->level?> / 價值：<?php echo $item->translation->price ?> 金幣 ]</span>
        <span>[ 獲取時間：<?php echo Yii::app()->format->datetime($item->created)?> ]</span>
    </div>
</a>
<?php endforeach; ?>

<?php $items_bag = $character_data->getItemsByCategory(5); ?>
<h4 class="item-category">鞋子<b> （<?php echo count($items_bag)?>）</b></h4>
<?php foreach ($items_bag as $item) : ?>
<a class="own-items item-icons" href="<?php echo Yii::app()->createUrl('game/equip', array('id'=>$item->item_id))?>">
    <img src="<?php echo Yii::app()->request->baseUrl ?>/statics/game/icons/shoes/<?php echo $item->translation->filename?>.png" alt="<?php $item->translation->name ?>">
    <div class="item-description">
        <h4>&lt; <?php echo $item->translation->name ?> &gt;</h4>
        <span class="description"><?php echo $item->translation->description ?></span>
        <span>[ 需求等級：LV.<?php echo $item->translation->level?> / 價值：<?php echo $item->translation->price ?> 金幣 ]</span>
        <span>[ 獲取時間：<?php echo Yii::app()->format->datetime($item->created)?> ]</span>
    </div>
</a>
<?php endforeach; ?>

<?php $items_bag = $character_data->getItemsByCategory(6); ?>
<h4 class="item-category">皮膚<b> （<?php echo count($items_bag)?>）</b></h4>
<?php foreach ($items_bag as $item) : ?>
<a class="own-items item-icons" href="<?php echo Yii::app()->createUrl('game/equip', array('id'=>$item->item_id))?>">
    <img src="<?php echo Yii::app()->request->baseUrl ?>/statics/game/icons/skins/<?php echo $item->translation->filename?>.png" alt="<?php $item->translation->name ?>">
    <div class="item-description">
        <h4>&lt; <?php echo $item->translation->name ?> &gt;</h4>
        <span class="description"><?php echo $item->translation->description ?></span>
        <span>[ 需求等級：LV.<?php echo $item->translation->level?> / 價值：<?php echo $item->translation->price ?> 金幣 ]</span>
        <span>[ 獲取時間：<?php echo Yii::app()->format->datetime($item->created)?> ]</span>
    </div>
</a>
<?php endforeach; ?>

<?php $items_bag = $character_data->getItemsByCategory(7); ?>
<h4 class="item-category">其他裝備<b> （<?php echo count($items_bag)?>）</b></h4>
<?php foreach ($items_bag as $item) : ?>
<a class="own-items item-icons" href="<?php echo Yii::app()->createUrl('game/equip', array('id'=>$item->item_id))?>">
    <img src="<?php echo Yii::app()->request->baseUrl ?>/statics/game/icons/others/<?php echo $item->translation->filename?>.png" alt="<?php $item->translation->name ?>">
    <div class="item-description">
        <h4>&lt; <?php echo $item->translation->name ?> &gt;</h4>
        <span class="description"><?php echo $item->translation->description ?></span>
        <span>[ 需求等級：LV.<?php echo $item->translation->level?> / 價值：<?php echo $item->translation->price ?> 金幣 ]</span>
        <span>[ 獲取時間：<?php echo Yii::app()->format->datetime($item->created)?> ]</span>
    </div>
</a>
<?php endforeach; ?>










<?php 
        // $items_bag = $character_data->getItemsByCategory(1);        
        // echo '<span>您目前的頭髮 <b> (' . count($items_bag) . ')</b></h4>';
        // foreach ($items_bag as $row)
        // {
            // echo '<a id="game-icon" href="'.Yii::app()->createUrl('game/equip', array('id'=>$row->item_id)).'">
            // <img src="'.Yii::app()->request->baseUrl.'/statics/game/icons/hair/'.$row->translation->filename.'.png" alt="'.$row->translation->name.'" /></a>';
        // }

        // $counter_two=1;
        // $items_bag = $character_data->getItemsByCategory(2);
        // echo '<table width="100%" border="1">';
        // echo '<th colspan="1">您目前的臉飾 <b> (' . sizeof($items_bag) . ')</b></th>';

        // foreach ($items_bag as $row)
        // {
            // echo '<tr><td>';
            // echo $counter_two.'>';
            // echo $row->item_id.'><a href="'.Yii::app()->createUrl('game/equip', array('id'=>$row->item_id)).'">'.$row->translation->name.'</a>>'.Yii::app()->format->datetime($row->created);
            // $counter_two++;
            // echo '</td></tr>';
        // }
        // echo '</table>';
        // echo '</br>';
        
        // $counter_two=1;
        // $items_bag = $character_data->getItemsByCategory(3);
        // echo '<table width="100%" border="1">';
        // echo '<th colspan="1">您目前的服裝 <b> (' . sizeof($items_bag) . ')</b></th>';

        // foreach ($items_bag as $row)
        // {
            // echo '<tr><td>';
            // echo $counter_two.'>';
            // echo $row->item_id.'><a href="'.Yii::app()->createUrl('game/equip', array('id'=>$row->item_id)).'">'.$row->translation->name.'</a>>'.Yii::app()->format->datetime($row->created);
            // $counter_two++;
            // echo '</td></tr>';
        // }
        // echo '</table>';
        // echo '</br>';
        
        // $counter_two=1;
        // $items_bag = $character_data->getItemsByCategory(4);
        // echo '<table width="100%" border="1">';
        // echo '<th colspan="1">您目前的褲子 <b> (' . sizeof($items_bag) . ')</b></th>';

        // foreach ($items_bag as $row)
        // {
            // echo '<tr><td>';
            // echo $counter_two.'>';
            // echo $row->item_id.'><a href="'.Yii::app()->createUrl('game/equip', array('id'=>$row->item_id)).'">'.$row->translation->name.'</a>>'.Yii::app()->format->datetime($row->created);
            // $counter_two++;
            // echo '</td></tr>';
        // }
        // echo '</table>';
        // echo '</br>';
        
        // $counter_two=1;
        // $items_bag = $character_data->getItemsByCategory(5);
        // echo '<table width="100%" border="1">';
        // echo '<th colspan="1">您目前的鞋子 <b> (' . sizeof($items_bag) . ')</b></th>';

        // foreach ($items_bag as $row)
        // {
            // echo '<tr><td>';
            // echo $counter_two.'>';
            // echo $row->item_id.'><a href="'.Yii::app()->createUrl('game/equip', array('id'=>$row->item_id)).'">'.$row->translation->name.'</a>>'.Yii::app()->format->datetime($row->created);
            // $counter_two++;
            // echo '</td></tr>';
        // }
        // echo '</table>';
        // echo '</br>';
        
        // $counter_two=1;
        // $items_bag = $character_data->getItemsByCategory(6);
        // echo '<table width="100%" border="1">';
        // echo '<th colspan="1">您目前的皮膚 <b> (' . sizeof($items_bag) . ')</b></th>';

        // foreach ($items_bag as $row)
        // {
            // echo '<tr><td>';
            // echo $counter_two.'>';
            // echo $row->item_id.'><a href="'.Yii::app()->createUrl('game/equip', array('id'=>$row->item_id)).'">'.$row->translation->name.'</a>>'.Yii::app()->format->datetime($row->created);
            // $counter_two++;
            // echo '</td></tr>';
        // }
        // echo '</table>';
        // echo '</br>';
        
        // $counter_two=1;
        // $items_bag = $character_data->getItemsByCategory(7);
        // echo '<table width="100%" border="1">';
        // echo '<th colspan="1">您目前的其他道具 <b> (' . sizeof($items_bag) . ')</b></th>';

        // foreach ($items_bag as $row)
        // {
            // echo '<tr><td>';
            // echo $counter_two.'>';
            // echo $row->item_id.'><a href="'.Yii::app()->createUrl('game/equip', array('id'=>$row->item_id)).'">'.$row->translation->name.'</a>>'.Yii::app()->format->datetime($row->created);
            // $counter_two++;
            // echo '</td></tr>';
        // }
        // echo '</table>';
        // echo '</br>';

?>