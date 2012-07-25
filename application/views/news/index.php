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

<?php $this->widget('Pager', array(
    'url'       => 'news/index',
    'pager'     => $page_status
)); ?>

<?php if ( Yii::app()->user->getIsAdmin() ) : ?>
<a href="<?php echo Yii::app()->createUrl('news/admin'); ?>" title="管理文章">管理文章</a>
<?php endif; ?>
<a class="news-back-link" href="#" title="返回">返回</a>