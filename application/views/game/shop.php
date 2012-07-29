<h1> 可購買列表 </h1>
<?php $array = Item::model()->getBuyItems(1, 1); 
$counter=0;
foreach($array as $row)
{
    $counter++;
    echo $counter.'->'.$row->id.'->'.$row->name.'</br>';
}?>
</br>
<?php $array = Item::model()->getBuyItems(1, 2); 
$counter=0;
foreach($array as $row)
{
    $counter++;
    echo $counter.'->'.$row->id.'->'.$row->name.'</br>';
}?>
</br>
<?php $array = Item::model()->getBuyItems(1, 3); 
$counter=0;
foreach($array as $row)
{
    $counter++;
    echo $counter.'->'.$row->id.'->'.$row->name.'</br>';
}?>
</br>
<?php $array = Item::model()->getBuyItems(1, 4); 
$counter=0;
foreach($array as $row)
{
    $counter++;
    echo $counter.'->'.$row->id.'->'.$row->name.'</br>';
}?>
</br>
<?php $array = Item::model()->getBuyItems(1, 5); 
$counter=0;
foreach($array as $row)
{
    $counter++;
    echo $counter.'->'.$row->id.'->'.$row->name.'</br>';
}?>
</br>
<?php $array = Item::model()->getBuyItems(1, 6); 
$counter=0;
foreach($array as $row)
{
    $counter++;
    echo $counter.'->'.$row->id.'->'.$row->name.'</br>';
}?>

<?php $array = Item::model()->getBuyItems(1, 7); 
$counter=0;
foreach($array as $row)
{
    $counter++;
    echo $counter.'->'.$row->id.'->'.$row->name.'</br>';
}?>