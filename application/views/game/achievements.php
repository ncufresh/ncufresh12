<?php
// print_r($achievements);
foreach($achievements as $achievement)
{
    echo $achievement['name'].'</br> => '.$achievement['description'].'<br/><br/>';
}

?>