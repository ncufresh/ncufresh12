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

<?php $this->widget('Pager', array(
    'url'       => 'news/index',
    'pager'     => $page_status
)); ?>

<a class="news-back-link" href="#" title="返回">返回</a>
<div class="news-dialog"></div>
