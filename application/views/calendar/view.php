<?php $this->beginWidget('system.web.widgets.CClipWidget', array('id' => 'script')); ?>
<script type="text/javascript">
jQuery(document).ready(function()
{
    $('#personal-calendar .left').calendar();
    // $('#personal-calendar .right').calendarEvents(3);

    $('a.calendar-hide-event').live('click', function()
    {
        var id = $(this).attr('href').replace('#', '');
        var self = this;
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
                    $(self).parents('ul').remove();
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

    </div>
    <a href="<?php echo Yii::app()->createUrl('calendar/createevent');?>">新增</a>
    <a href="<?php echo Yii::app()->createUrl('calendar/subscript');?>">訂閱</a>
    <a href="<?php echo Yii::app()->createUrl('calendar/recycle');?>">垃圾桶</a>
</div>
