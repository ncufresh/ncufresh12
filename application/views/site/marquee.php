<?php $this->beginWidget('system.web.widgets.CClipWidget', array('id' => 'style')); ?>
<style type="text/css">
#admin-marquee form input
{
    height: 30px;
    width: 320px;
}

#admin-marquee form button
{
    background: url('<?php echo Yii::app()->request->baseUrl; ?>/statics/images/admin_marquee_add.png');
    cursor: pointer;
    height: 40px;
    text-indent: -100000%;
    width: 72px;
}

#admin-marquee table
{
    background: #FFFFFF;
    border-spacing: 0;
    border-radius: 10px;
    margin: 20px 0;
    padding: 10px;
    width: 100%;
}

#admin-marquee table input
{
    border: none;
    background: #DCE4ED;
    display: block;
    height: 20px;
    line-height: 20px;
    padding: 15px 0;
    text-indent: 15px;
    width: 100%;
}

#admin-marquee th
{
    background: #DCE4ED;
    height: 40px;
    line-height: 40px;
    margin: 20px 0;
}

#admin-marquee th:first-child
{
    border-radius: 10px 0 0 10px;
    width: 60%;
}

#admin-marquee th:last-child
{
    border-radius: 0 10px 10px 0;
    width: 30%;
}

#admin-marquee td
{
    /*background: #FFFFFF;*/
    height: 20px;
    line-height: 20px;
    padding: 10px 0;
}

#admin-marquee td:first-child
{
    text-indent: 15px;
}

#admin-marquee td:not(:first-child)
{
    text-align: center;
}

#admin-marquee a
{
    display: block;
    height: 32px;
    text-indent: -100000%;
    width: 32px;
}

#admin-marquee a:hover
{
    background-color: #CCFFCC;
}

#admin-marquee .marquee-edit-button
{
    background: url('<?php echo Yii::app()->request->baseUrl; ?>/statics/images/admin_marquee_edit.png');
}

#admin-marquee .marquee-delete-button
{
    background: url('<?php echo Yii::app()->request->baseUrl; ?>/statics/images/admin_marquee_delete.png');
}
</style>
<?php $this->endWidget();?>

<?php $this->beginWidget('system.web.widgets.CClipWidget', array('id' => 'script')); ?>
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
                    $.configures.token = response.token;
                    if ( response.error )
                    {
                        $.alert({
                            message: '更新失敗！請稍後再試一次！'
                        });
                        return false;
                    }
                    var text = jQuery('<td></td>')
                        .attr('id', 'marquee-message-' + id)
                        .addClass('marquee-message-text')
                        .text(response.message)
                        .replaceAll(object);
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
        var element = jQuery(this).parent().parent();

        $.confirm({
            message:            '您真的想要刪除這一筆跑馬燈消息？',
            confirmed:          function(result)
            {
                if ( result )
                {
                    jQuery.post(
                        window.location.href,
                        {
                            marquee:
                            {
                                id: '-' + id
                            },
                            token: $.configures.token
                        },
                        function(response)
                        {
                            $.configures.token = response.token;
                            if ( response.error )
                            {
                                $.alert({
                                    message: '刪除失敗！請稍後再試一次！'
                                });
                                return false;
                            }
                            element.remove();
                        }
                    );
                }
            }
        });
        return false;
    });

    jQuery('.marquee-message-text').live('dblclick', function()
    {
        var id = jQuery(this).attr('id').replace('marquee-message-', '');
        return replacement(id);
    });
});
</script>
<?php $this->endWidget();?>

<div id="admin-marquee">
    <h1>跑馬燈管理</h1>

    <form method="POST">
        <input id="marquee-form-message" name="marquee[message]" type="text" />
        <input name="token" value="<?php echo Yii::app()->security->getToken(); ?>" type="hidden" />
        <button type="submit">新增</button>
    </form>

    <table>
        <thead>
            <tr>
                <th>當前顯示</th>
                <th>修改</th>
                <th>移除</th>
                <th>新增日期</th>
            </tr>
        </thead>
        <tbody>
<?php foreach ( $marquees as $marquee ) : ?>
            <tr>
                <td id="marquee-message-<?php echo $marquee->id; ?>" class="marquee-message-text"><?php echo $marquee->message; ?></td>
                <td>
                    <a class="marquee-edit-button" href="#<?php echo $marquee->id; ?>" title="修改">修</a>
                </td>
                <td>
                    <a class="marquee-delete-button" href="#<?php echo $marquee->id; ?>" title="移除">移</a>
                </td>
                <td><?php echo $marquee->updated; ?></td>
            </tr>
<?php endforeach; ?>
        </tbody>
    </table>
</div>