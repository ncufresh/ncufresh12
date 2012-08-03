<div id="readme-notice" class="readme-background">
    <div class="readme-view"></div>
    <a href="<?php echo Yii::app()->createUrl('readme/index'); ?>" id="notice-back" class="readme-back" title="回上一頁"></a>
    <div id="read-notice-menu" class="readme-menu">
        <p>相關須知</p>
        <ul class="readme-menu-index">
<?php for ( $x = 0 ; $x < $size ; ++$x ) : ?>
            <li tab="<?php echo $tab[$x]; ?>" page="notice"><?php echo $index[$x]; ?></li>
<?php endfor; ?>
        </ul>
    </div>
</div>