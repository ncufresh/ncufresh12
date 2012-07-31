<?php $this->beginWidget('system.web.widgets.CClipWidget', array('id' => 'script')); ?>
<script type="text/javascript">
jQuery(document).ready(function()
{
    $('#personal-calendar .left').calendar();
    // $('#personal-calendar .right').calendarEvents(3);

    $('a.calendar-hide-event').live('click', function()
    {
        var id = $(this).attr('href').replace('#', '');
        $.post(
            $.configures.calendarHideEventUrl,
            {
                calendar:
                {
                    id: id
                },
                token: $.configures.token
            },
            function(response)
            {
                $.configures.token = response.token;
                if ( $.errors(response.errors) )
                {
                    window.location.reload();
                }
            }
        );
        return false;
    });
});
</script>
<?php $this->endWidget();?>
<div id="personal-calendar">
    <div class="left"></div>
    <h3 class="date"></h3>
    <div class="right">
        <div>
            <h4>全校</h4>
            <ul class="general"></ul>
        </div>
        <div>
            <h4>個人</h4>
            <ul class="personal"></ul>
        </div>
        <div>
            <h4>社團</h4>
            <ul class="clubs"></ul>
        </div>
    </div>
    <a href="<?php echo Yii::app()->createUrl('calendar/createevent');?>">新增</a>
    <a href="<?php echo Yii::app()->createUrl('calendar/subscript');?>">訂閱</a>
    <a href="<?php echo Yii::app()->createUrl('calendar/recycle');?>">垃圾桶</a>
</div>
