<?php $this->beginWidget('system.web.widgets.CClipWidget', array('id' => 'script')); ?>
<script type="text/javascript">
    $('#personal-calendar .left').calendar();
    $('#personal-calendar .right').calendarEvent(1);
</script>
<?php $this->endWidget();?>
<div id="personal-calendar">
<div class="left"></div>
<div class="right"></div>
</div>
