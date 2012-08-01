<?php $this->beginWidget('system.web.widgets.CClipWidget', array('id' => 'script')); ?>
<script type="text/javascript">
jQuery(document).ready(function()
{
    $('a.calendar-hide-event').click(function()
    {
        var id = $(this).attr('href').replace('#', '');
        var li = $(this).parent();
        $.confirm({
            message: '你真的想要隱藏事件嗎？',
            confirmed: function(result)
            {
                if ( result === true )
                {
                    $.post(
                        window.location.href,
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
                            }
                        }
                    );
                }
            }
        });
        return false;
    });
    
    $('a.calendar-show-event').click(function()
    {
        var id = $(this).attr('href').replace('#', '');
        var li = $(this).parent();
        $.post(
            decodeURIComponent('<?php echo Yii::app()->createAbsoluteUrl('calendar/showevent'); ?>'),
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
                }
            }
        );
    });
});
</script>
<?php $this->endWidget();?>
<ul>
<?php foreach ( $events as $event ) : ?>
    <li>
        <span><?php echo $event->name; ?></span>
        <a class="calendar-show-event" href="#<?php echo $event->id; ?>" title="復原事件">復原事件</a>
<?php if ( $event->calendar->getIsPersonal() && $event->calendar->getIsOwner() ) : ?>
        <a class="calendar-hide-event" href="#<?php echo $event->id; ?>" title="刪除事件">刪除事件</a>
<?php endif; ?>
    </li>
<?php endforeach; ?>
</ul>
<a href="<?php echo Yii::app()->createUrl('calendar/view');?>">返回</a>