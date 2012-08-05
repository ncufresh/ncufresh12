<div id="readme-fresh" class="background">
    <div class="readme-view"></div>
    <a href="<?php echo Yii::app()->createUrl('readme/index'); ?>" id="fresh-back" class="back" title="回上一頁"></a>
    <div id="read-fresh-menu" class="readme-menu">
        <h5>新生區</h5>
		<div class="arrow-right"></div>
        <ul class="readme-menu-index">
<?php for ( $x = 0 ; $x < $size ; ++$x ) : ?>
            <li tab="<?php echo $tab[$x]; ?>" page="freshman"><?php echo $index[$x]; ?></li>
<?php endfor; ?>
        </ul>
		<ul class="menu-index">
		</ul>
    </div>
</div>