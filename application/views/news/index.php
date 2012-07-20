<script type="text/javascript">
jQuery(document).ready(function()
{
    jQuery('.news-back-link').click(function()
    {
        window.location = $.configures.newsIndexUrl;
        return false;
    });
});
</script>
<h1>最新消息</h1>
<table class="news-table">
    <tbody>
        <?php foreach ( $news as $entry ) : ?>
            <tr>
                <td><?php echo CHtml::link($entry->title, $entry->url);?></td>
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
<?php if ( Yii::app()->user->getIsAdmin() ) : ?>
<a href="<?php echo Yii::app()->createUrl('news/admin'); ?>" title="管理文章">管理文章</a>
<?php endif; ?>
<a class="news-back-link" href="#" title="返回">返回</a>