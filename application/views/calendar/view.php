<?php $this->beginWidget('system.web.widgets.CClipWidget', array('id' => 'script')); ?>
<script type="text/javascript">
jQuery(document).ready(function()
{
    var calendar = $.calendar({
        calendar_container: '#personal-calendar .left',
        events_container:   '#personal-calendar .right',
        date_container:     '#personal-calendar .date',
        prompt:             '#personal-calendar .prompt',
        eventsUrl:           $.configures.calendarEventsUrl
    });
    $('a.calendar-hide-event').live('click', function()
    {
        var id = $(this).attr('href').replace('#', '');
        var self = this;
        var li = $(this).parents('li');
        var ul = li.parent();
        var div = ul.parent();
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
                    li.remove();
                    if ( $.trim(ul.html()) == '' ) div.remove();
                    calendar.updateData($.configures.calendarEventsUrl);
                }
            }
        );
        return false;
    });
});
</script>
<?php $this->endWidget();?>
<div id="personal-calendar" class="calendar">
    <div class="left"></div>
    <h4 class="date"></h4>
    <div class="right">
    </div>
    <a class="calendar-subscript-button calendar-buttons" href="<?php echo Yii::app()->createUrl('calendar/subscript');?>" title="訂閱行事曆">訂閱</a>
    <a class="calendar-hide-button calendar-buttons" href="<?php echo Yii::app()->createUrl('calendar/recycle');?>" title="回收桶">回收</a>
    <a class="calendar-create-button calendar-buttons" href="<?php echo Yii::app()->createUrl('calendar/createevent');?>" title="新增一筆行程">新增</a>
    <div class="prompt">
        <ul>
        </ul>
        <i></i>
    </div>
</div>

