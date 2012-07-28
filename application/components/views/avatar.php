<div class="avatar">
<?php foreach ( $components as $name => $path ) : ?>
    <img src="<?php echo Yii::app()->baseUrl; ?>/statics/game/<?php echo $path;?>" alt="<?php echo $name; ?>" />
<?php endforeach; ?>
</div>