<div id="readme-notice">
    <div id="readme-view"></div>
    <a href="<?php echo Yii::app()->createUrl('readme/index'); ?>" id="notice-back" class="readme-back"></a>
    <div id="read-notice-menu" class="readme-menu">
        <p>相關事項</p>
        <ul id="readme-index3" class="readme-menu-index">
<?php for ( $x = 0 ; $x < $size ; ++$x ) : ?>
            <li tab="<?php echo $tab[$x]; ?>" page="notice"><?php echo $index[$x]; ?></li>
<?php endfor; ?>
        </ul>
    </div>
</div>