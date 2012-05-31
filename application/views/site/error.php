<?php $this->pageTitle = Yii::app()->name . ' - 發生錯誤'; ?>

<h2>找不到網頁</h2>

<?php if ( $code == 403 ) : ?>
<form><!-- 登入介面 --></form>
<?php endif; ?>

<div class="error">
<?php echo CHtml::encode($message); ?>
</div>