<div id="readme-reschool" class="readme-background">
    <div class="readme-view"></div>
    <a href="<?php echo Yii::app()->createUrl('readme/index'); ?>" id="reschool-back" class="readme-back" title="回上一頁"></a>
    <div id="read-reschool-menu" class="readme-menu">
        <h5>復學區</h5>
        <ul class="readme-menu-index">
<?php for ( $x = 0 ; $x < $size ; ++$x ) : ?>
            <li tab="<?php echo $tab[$x]; ?>" page="reschool"><?php echo $index[$x]; ?></li>
<?php endfor; ?>
        </ul>
		<ul class="menu-index">
		</ul>
    </div>
</div>