系所列表<br />
<?php
    foreach ( $list as $each ):
?>
        <a href="<?php echo $each->url;?>"><?php echo $each->name; ?></a><br/>
<?php
    endforeach;
?>