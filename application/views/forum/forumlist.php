系所列表<br />
<?php
    // $a = $list[0];
    // echo $a->name;
    foreach ( $list as $enrty )
    {
        echo CHtml::link($enrty->name, $enrty->url) . '<br />';
    }
?>