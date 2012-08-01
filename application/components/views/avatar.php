<div class="avatar">
<?php if ( $link ) : ?>
    <a href="<?php echo Yii::app()->createUrl('game/index', array('id' => $id)); ?>" title="查看個人資料">
<?php endif; ?>
<?php foreach ( $components as $name => $path ) : ?>
        <img src="<?php echo Yii::app()->baseUrl; ?>/statics/game/<?php echo $path;?>" alt="<?php echo $name; ?>" />
<?php endforeach; ?>
<?php if ( $link ) : ?>
    </a>
<?php endif; ?>
</div>