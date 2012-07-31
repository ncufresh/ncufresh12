<?php // <style type="text/css">
    // div.game-shop
    // {
        // position: relative;
    // }
    // div.game-shop a
    // {
        
    // }
    // div.game-shop:hover span
    // {
        // display: block;
    // }
    // div.game-shop span
    // {
        // position: absolute;
        // width: 200px;
        // height: 100px;
        // top: 0px;
        // left: -10px;
        // background: red;
        // display: none;
    // }
// </style> ?>
<h1> 可購買列表 </h1>
<h3> LV.<?php echo $level ?> / <?php echo $money ?> 金幣</h3>
<h2> <頭髮> </h2>
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