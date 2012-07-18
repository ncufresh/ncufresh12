<script type="text/javascript">
jQuery(document).ready(function()
{
    var submitAllChanges = function()
    {
        return jQuery('.marquee-message-edit').each(function()
        {
            var id = jQuery(this).attr('id').replace('marquee-edit-', '');
            var object = jQuery(this);
            jQuery.post(
                window.location.href,
                {
                    marquee:
                    {
                        id: id,
                        message: jQuery(this).val(),
                    },
                    token: $.configures.token
                },
                function(response)
                {
                    if ( response.error )
                    {
                        alert('更新失敗！請稍後再試一次！');
                        return false;
                    }
                    var text = jQuery('<td></td>')
                        .attr('id', 'marquee-message-' + id)
                        .addClass('marquee-message-text')
                        .text(response.message)
                        .replaceAll(object);
                    $.configures.token = response.token;
                    text.highlight();
                }
            );
        });
    };

    var replacement = function(id)
    {
        var object = jQuery('#marquee-message-' + id);
        var input = jQuery('<input></input>')
            .attr('id', 'marquee-edit-' + id)
            .addClass('marquee-message-edit')
            .val(object.text())
            .blur(submitAllChanges);
        submitAllChanges();
        object.replaceWith(input).focus();
        return false;
    }

    jQuery('.marquee-edit-button').live('click', function()
    {
        var id = jQuery(this).attr('href').replace('#', '');
        if ( jQuery('#marquee-edit-' + id).length ) return false;
        return replacement(id);
    });

    jQuery('.marquee-delete-button').live('click', function()
    {
        var id = jQuery(this).attr('href').replace('#', '');
        jQuery.post(
            window.location.href,
            {
                marquee:
                {
                    id: id
                },
                token: $.configures.token
            },
            function(response)
            {
                if ( response.error )
                {
                    alert('刪除失敗！請稍後再試一次！');
                    return false;
                }
            }
        );
        return false;
    });

    jQuery('.marquee-message-text').live('dblclick', function()
    {
        var id = jQuery(this).attr('id').replace('marquee-message-', '');
        return replacement(id);
    });
});
</script>

<h1>跑馬燈管理</h1>

<table>
    <thead>
        <tr>
            <th>&nbsp;</th>
            <th>當前顯示</th>
            <th>修改</th>
            <th>移除</th>
            <th>新增日期</th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <td colspan="5">
                <form method="POST">
                    <input id="marquee-form-message" name="marquee[message]" type="text" />
                    <button type="submit">新增</button>
                </form>
            </td>
        </tr>
    </tfoot>
    <tbody>
<?php foreach ( $marquees as $index => $marquee ) : ?>
        <tr>
            <td><?php echo $index + 1; ?></td>
            <td id="marquee-message-<?php echo $marquee->id; ?>" class="marquee-message-text"><?php echo $marquee->message; ?></td>
            <td><a class="marquee-edit-button" href="#<?php echo $marquee->id; ?>" title="修改">修</a></td>
            <td><a class="marquee-delete-button" href="#<?php echo $marquee->id; ?>" title="移除">移</a></td>
            <td><?php echo $marquee->updated; ?></td>
        </tr>
<?php endforeach; ?>
    </tbody>
</table>