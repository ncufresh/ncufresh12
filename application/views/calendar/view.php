<style type="text/css">
table
{
    border-collapse: collapse;
}
tbody td
{
    cursor: pointer;
}
</style>
<?php $this->beginWidget('system.web.widgets.CClipWidget', array('id' => 'script')); ?>
<script type="text/javascript">
    $('#personal-calendar .left').calendar();
    // $('#personal-calendar .right').calendarEvents(3);
</script>
<?php $this->endWidget();?>
<div id="personal-calendar">
    <div class="left"></div>
    <div class="date"></div>
    <div class="right">
        <span>全校</span>
        <div class="general"></div>
        <span>個人</span>
        <div class="personal"></div>
        <span>社團</span>
        <div class="clubs"></div>
    </div>
    <a href="<?php echo Yii::app()->createUrl('calendar/createevent');?>">新增</a>
    <a href="<?php echo Yii::app()->createUrl('calendar/subscript');?>">訂閱</a>
    <a href="<?php echo Yii::app()->createUrl('calendar/recycle');?>">垃圾桶</a>
</div>
