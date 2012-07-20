行事曆
<a href="index.html">上一頁</a>
<h1>標題:</h1>
    <p><?php echo $model->title;?></p>
<h2>內容:</h2>    
    <p><?php echo $model->content; ?></p>


<form action="<?php echo Yii::app()->createUrl('readme/update'); ?>" method="POST">
    <input name="token" value="<?php echo Yii::app()->security->getToken(); ?>" type="hidden" />
    <button id="form-schedule-button" type="submit"><?php if ( $model->status ) : ?>finish<?php else : ?>unfinish<?php endif; ?></button>
</form>