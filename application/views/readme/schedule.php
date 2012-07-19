行事曆
<a href="index.html">上一頁</a>
<?php
    echo $model->title;
    echo $model->content;
?>

<form action="<?php echo Yii::app()->createUrl('readme/update'); ?>" method="POST">
    <input name="token" value="<?php echo Yii::app()->security->getToken(); ?>" type="hidden" />
    <button id="form-schedule-button" type="submit"><?php if ( $model->status ) : ?>Simomo<?php else : ?>Dimomo<?php endif; ?></button>
</form>