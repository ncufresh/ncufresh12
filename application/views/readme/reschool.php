<div id="readme-reschool">
    <div class="readme-view"></div>
    <a href="<?php echo Yii::app()->createUrl('readme/index'); ?>" id="reschool-back" class="readme-back"></a>
    <div id="read-reschool-menu" class="readme-menu">
        <p>復學區</p>
        <ul id="readme-index2" class="readme-menu-index">
<?php for ( $x = 0 ; $x < $size ; ++$x ) : ?>
            <li tab="<?php echo $tab[$x]; ?>" page="reschool"><?php echo $index[$x]; ?></li>
<?php endfor; ?>
        </ul>
    </div>
</div>