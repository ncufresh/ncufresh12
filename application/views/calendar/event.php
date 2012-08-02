<?php $this->beginWidget('system.web.widgets.CClipWidget', array('id' => 'script')); ?>
<script type="text/javascript">
jQuery(document).ready(function()
{
    $('#calendar-event div.container').scrollable({
        scrollableClass:    false
    });
    console.log($('#calendar-event div.container'));
});
</script>
<?php $this->endWidget();?>
<div id="calendar-event">
    <h4><?php echo $event->name; ?></h4>
    <h5><?php echo $event->start; ?>~<?php echo $event->end; ?></h5>
    <div class="container">
        <p><?php echo $event->description; ?></p>
    </div>
    <a class="back" href="<?php echo Yii::app()->createUrl('calendar/view');?>" title="返回">返回</a>
</div>