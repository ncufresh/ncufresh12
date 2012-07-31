<div id="readme-fresh">
    <div id="readme-view"></div>
    <a href="<?php echo Yii::app()->createUrl('readme/index'); ?>" id="fresh-back" class="readme-back"></a>
    <div id="read-fresh-menu" class="readme-menu">
        <p>新生區</p>
        <ul id="readme-index1" class="readme-menu-index">
<?php for ( $x = 0 ; $x < $size ; ++$x ) : ?>
            <li tab="<?php echo $tab[$x]; ?>" page="freshman"><?php echo $index[$x]; ?></li>
<?php endfor; ?>
        </ul>
    </div>
</div>