<script type="text/javascript">
jQuery(document).ready(function()
{
    jQuery('.news-delete-link').click(function()
    {
        var link = jQuery(this).attr('href');
        var dialog = $('.news-dialog');
        dialog.text('確定刪除此篇文章？')
            .dialog({
                buttons: { 
                    "是": function()
                    {
                        location = link;
                    }, 
                    "否": function()
                    {
                        dialog.dialog('close');
                    }
                },
                dialogClass: 'news-dialog-warp',
            });   
        return false;
    });

    jQuery('.news-back-link').click(function()
    {
        window.location = $.configures.newsIndexUrl;
        return false;
    });
});
</script>
<h1>管理最新消息</h1>
<a href="<?php echo Yii::app()->createUrl('news/create') ;?>" title="新增文章">新增文章</a>
<table class="news-table">
    <tbody>
        <?php foreach ( $news as $entry ) : ?>
            <tr>
                <td><?php echo CHtml::link($entry->title, $entry->url);?></td>
                <td><a href="<?php echo Yii::app()->createUrl('news/update', array('id' => $entry->id) ); ?>" title="編輯">編輯</a></td>
                <td><a class="news-delete-link" href="<?php echo Yii::app()->createUrl('news/delete', array('id' => $entry->id) ); ?>" title="刪除">刪除</a></td>
                <td><?php echo $entry->updated; ?></td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>

<ul>
<?php if ( $page_status['prev_page'] !== null ) : ?>
	<li><a href="<?php echo Yii::app()->createUrl('news/index', array('page' => $page_status['prev_page'])); ?>" title="上一頁">上一頁</a></li>
<?php endif; ?>
<?php for ( $i = $page_status['first_page']; $i <= $page_status['last_page']; ++$i ) : ?>
	<?php if ( $i == $page_status['current_page'] ) : ?>
		<li><?php echo $i; ?></li>
	<?php else : ?>
		<li><?php echo CHtml::link($i, Yii::app()->createUrl('news/index', array('page' => $i))); ?></li>
	<?php endif; ?>
<?php endfor; ?>
<?php if ( $page_status['next_page'] !== null ) : ?>
	<li><a href="<?php echo Yii::app()->createUrl('news/index', array('page' => $page_status['next_page'])); ?>" title="下一頁">下一頁</a></li>
<?php endif; ?>
</ul>
<a class="news-back-link" href="#" title="返回">返回</a>
<div class="news-dialog"></div>
