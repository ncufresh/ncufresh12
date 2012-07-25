<h1>目前使用者ID:<?php echo Yii::app()->user->getId()?> </h1>
<h1>觀看使用者ID:<?php echo $user_id;?></h1>
<?php
// print_r($achievements);
foreach($achievements as $achievement)
{
    echo $achievement['name'].' => '.$achievement['description'].'<br/>';
}

?>


<img src="../statics/game/gamesystem.png">

<h1>小遊戲</h1>
