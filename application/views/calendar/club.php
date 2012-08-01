<?php $this->beginWidget('system.web.widgets.CClipWidget', array('id' => 'script')); ?>
<script type="text/javascript">
jQuery(document).ready(function()
{
    var calendar = $.calendar({
        calendar_container: '#club-calendar .left',
        events_container:   '#club-calendar .right',
        date_container:     '#club-calendar .date',
        prompt:             '#club-calendar .prompt',
        eventsUrl:           $.configures.calendarEventsUrl + '?club=true'
    });
    $('a.calendar-hide-event').live('click', function()
    {
        var id = $(this).attr('href').replace('#', '');
        var self = this;
        $.confirm({
            confirmed: function(result)
            {
                if ( result )
                {
                    $.post(
                        '<?php echo Yii::app()->createAbsoluteUrl('calendar/clubrecycle');?>',
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
                                $(self).parents('li').remove();
                                calendar.updateData();
                            }
                        }
                    );
                }
            },
            message: '刪除將無法復原，您確定要刪除嗎？'
        });
        return false;
    });
});
</script>
<?php $this->endWidget();?>
<div id="club-calendar"  class="calendar">
    <div class="left"></div>
    <h3 class="date"></h3>
    <div class="right">
    </div>
    <a href="<?php echo Yii::app()->createUrl('calendar/createclubevent');?>">新增</a>
    <div class="prompt">
        <ul>
        </ul>
        <i></i>
    </div>
</div>


