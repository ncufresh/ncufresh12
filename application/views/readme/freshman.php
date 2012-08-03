<div id="readme-fresh" class="readme-background">
    <div class="readme-view"></div>
    <a href="<?php echo Yii::app()->createUrl('readme/index'); ?>" id="fresh-back" class="readme-back" title="回上一頁"></a>
    <div id="read-freshman-menu" class="readme-menu">
        <p>新生區</p>
        <ul class="readme-menu-index">
<?php for ( $x = 0 ; $x < $size ; ++$x ) : ?>
            <li tab="<?php echo $tab[$x]; ?>" page="freshman"><?php echo $index[$x]; ?></li>
<?php endfor; ?>
        </ul>
    </div>
</div>