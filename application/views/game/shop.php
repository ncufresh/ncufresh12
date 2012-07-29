<style type="text/css">
    div.game-shop
    {
        position: relative;
    }
    div.game-shop a
    {
        
    }
    div.game-shop:hover span
    {
        display: block;
    }
    div.game-shop span
    {
        position: absolute;
        width: 200px;
        height: 100px;
        top: 0px;
        left: -10px;
        background: red;
        display: none;
    }
</style>
<h1> 可購買列表 </h1>
<?php $array = Item::model()->getBuyItems(20, 1); 
$counter=0;
foreach($array as $row)
{
    $counter++;
    echo '<div class="game-shop">';
    echo '<a href="#'.$row->id.'">'.$counter.'->'.$row->id.'->'.$row->name.'->'.$row->price.'->LV.'.$row->level.'</br></a>';
    echo '<span>'.$row->description.'</span>';
    echo '</div>'; 
}?>
</br>
<?php $array = Item::model()->getBuyItems(1, 2); 
$counter=0;
foreach($array as $row)
{
    $counter++;
    echo '<a href="#'.$row->id.'">'.$counter.'->'.$row->id.'->'.$row->name.'->'.$row->price.'</br></a>';
}?>
</br>
<?php $array = Item::model()->getBuyItems(1, 3); 
$counter=0;
foreach($array as $row)
{
    $counter++;
    echo '<a href="#'.$row->id.'">'.$counter.'->'.$row->id.'->'.$row->name.'->'.$row->price.'</br></a>';
}?>
</br>
<?php $array = Item::model()->getBuyItems(1, 4); 
$counter=0;
foreach($array as $row)
{
    $counter++;
    echo '<a href="#'.$row->id.'">'.$counter.'->'.$row->id.'->'.$row->name.'->'.$row->price.'</br></a>';
}?>
</br>
<?php $array = Item::model()->getBuyItems(1, 5); 
$counter=0;
foreach($array as $row)
{
    $counter++;
    echo '<a href="#'.$row->id.'">'.$counter.'->'.$row->id.'->'.$row->name.'->'.$row->price.'</br></a>';
}?>
</br>
<?php $array = Item::model()->getBuyItems(1, 6); 
$counter=0;
foreach($array as $row)
{
    $counter++;
    echo '<a href="#'.$row->id.'">'.$counter.'->'.$row->id.'->'.$row->name.'->'.$row->price.'</br></a>';
}?>

<?php $array = Item::model()->getBuyItems(1, 7); 
$counter=0;
foreach($array as $row)
{
    $counter++;
    echo $counter.'->'.$row->id.'->'.$row->name.'</br>';
}?>