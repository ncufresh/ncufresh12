<h3> LV.<?php echo $level ?> / <?php echo $money ?> 金幣</h3>
<h2> <頭髮> </h2>
<?php $shopping = Item::model()->getBuyItems($level, 1); ?>
<?php foreach ($shopping as $item) : ?>
<a class="item-icons" href="<?php echo Yii::app()->createUrl('game/buy', array('id'=>$item->id))?>">
    <img src="<?php echo Yii::app()->request->baseUrl ?>/statics/game/icon/hairs/<?php echo $item->filename?>.png" alt="<?php $item->name ?>">
    <div class="item-description">
        <h4>&lt; <?php echo $item->name ?> &gt;</h4>
        <span class="description"><?php echo $item->description ?></span>
        <span>需求等級：LV.<?php echo $item->level?> / 價值：<?php echo $item->price ?> 金幣</span>
    </div>
</a>
<?php endforeach; ?>






<?php $array = Item::model()->getBuyItems($level, 1); 
$counter=0;
foreach($array as $row)
{
    $counter++;
    echo '<div class="game-shop">';
    echo '<a href="'.Yii::app()->createUrl('game/buy', array('id'=>$row->id)).'">'.$counter.'->'.$row->id.'->'.$row->name.'->'.$row->price.'->LV.'.$row->level.'</br></a>';
    echo '<span>'.$row->description.'</span>';
    echo '</div>'; 
}?>
</br>
<h2> <臉飾> </h2>
<?php $array = Item::model()->getBuyItems($level, 2); 
$counter=0;
foreach($array as $row)
{
    $counter++;
    echo '<div class="game-shop">';
    echo '<a href="'.Yii::app()->createUrl('game/buy', array('id'=>$row->id)).'">'.$counter.'->'.$row->id.'->'.$row->name.'->'.$row->price.'->LV.'.$row->level.'</br></a>';
    echo '<span>'.$row->description.'</span>';
    echo '</div>'; 
}?>
</br>
<h2> <衣服> </h2>
<?php $array = Item::model()->getBuyItems($level, 3); 
$counter=0;
foreach($array as $row)
{
    $counter++;
    echo '<div class="game-shop">';
    echo '<a href="'.Yii::app()->createUrl('game/buy', array('id'=>$row->id)).'">'.$counter.'->'.$row->id.'->'.$row->name.'->'.$row->price.'->LV.'.$row->level.'</br></a>';
    echo '<span>'.$row->description.'</span>';
    echo '</div>'; 
}?>
</br>
<h2> <褲子> </h2>
<?php $array = Item::model()->getBuyItems($level, 4); 
$counter=0;
foreach($array as $row)
{
    $counter++;
    echo '<div class="game-shop">';
    echo '<a href="'.Yii::app()->createUrl('game/buy', array('id'=>$row->id)).'">'.$counter.'->'.$row->id.'->'.$row->name.'->'.$row->price.'->LV.'.$row->level.'</br></a>';
    echo '<span>'.$row->description.'</span>';
    echo '</div>'; 
}?>
</br>
<h2> <鞋子> </h2>
<?php $array = Item::model()->getBuyItems($level, 5); 
$counter=0;
foreach($array as $row)
{
    $counter++;
    echo '<div class="game-shop">';
    echo '<a href="'.Yii::app()->createUrl('game/buy', array('id'=>$row->id)).'">'.$counter.'->'.$row->id.'->'.$row->name.'->'.$row->price.'->LV.'.$row->level.'</br></a>';
    echo '<span>'.$row->description.'</span>';
    echo '</div>'; 
}?>
</br>
<h2> <皮膚> </h2>
<?php $array = Item::model()->getBuyItems($level, 6); 
$counter=0;
foreach($array as $row)
{
    $counter++;
    echo '<div class="game-shop">';
    echo '<a href="'.Yii::app()->createUrl('game/buy', array('id'=>$row->id)).'">'.$counter.'->'.$row->id.'->'.$row->name.'->'.$row->price.'->LV.'.$row->level.'</br></a>';
    echo '<span>'.$row->description.'</span>';
    echo '</div>'; 
}?>
</br>
<h2> <其他裝備> </h2>
<?php $array = Item::model()->getBuyItems($level, 7); 
$counter=0;
foreach($array as $row)
{
    $counter++;
    echo '<div class="game-shop">';
    echo '<a href="'.Yii::app()->createUrl('game/buy', array('id'=>$row->id)).'">'.$counter.'->'.$row->id.'->'.$row->name.'->'.$row->price.'->LV.'.$row->level.'</br></a>';
    echo '<span>'.$row->description.'</span>';
    echo '</div>'; 
}?>
</br>