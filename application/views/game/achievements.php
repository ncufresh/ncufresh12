<?php
// print_r($achievements);
foreach($achievements as $achievement)
{
    echo $achievement['name'].' => '.$achievement['description'].'<br/>';
}

?>