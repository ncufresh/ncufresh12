<?php $this->beginWidget('system.web.widgets.CClipWidget', array('id' => 'script')); ?>
<script type="text/javascript">
jQuery(document).ready(function()
{
    $('a.calendar-hide-event').click(function()
    {
        var id = $(this).attr('href').replace('#', '');
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
                                window.location.reload();
                            }
                        }
                    );
                }
            }
        });
        return false;
    });
});
</script>
<?php $this->endWidget();?>
<ul>
<?php foreach ( $events as $event ) : ?>
    <li>
<?php if ( $event->calendar->getIsPersonal() && $event->calendar->getIsOwner() ) : ?>
        <a class="calendar-hide-event" href="#<?php echo $event->id; ?>" title="隱藏事件"><?php echo $event->name; ?></a>
<?php else : ?>
        <?php echo $event->name; ?>
<?php endif; ?>
    </li>
<?php endforeach; ?>
</ul>