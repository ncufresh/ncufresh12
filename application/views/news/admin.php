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
<?php if ( $pageStatus['prevPage'] !== null ) : ?>
        <li><a href="<?php echo Yii::app()->createUrl('news/admin', array('page' => $pageStatus['prevPage'])) ;?>" title="上一頁">上一頁</a></li>
<?php endif; ?>
<?php for ( $i = $pageStatus['firstPage'] ; $i <= $pageStatus['lastPage'] ; ++$i ) : ?>
    
        <?php if ( $i == $pageStatus['currentPage'] ): ?>
            <li><?php echo $i;?></li>
        <?php else: ?>
            <li><?php echo CHtml::link($i, Yii::app()->createUrl('news/admin', array('page' => $i))); ?></li>
        <?php endif;?>
<?php endfor; ?>
<?php if ( $pageStatus['nextPage'] !== null ): ?>
        <li><a href="<?php echo Yii::app()->createUrl('news/admin', array('page' => $pageStatus['nextPage'])) ;?>" title="下一頁">下一頁</a></li>
<?php endif; ?>
</ul>
<a class="news-back-link" href="#" title="返回">返回</a>
<div class="news-dialog"></div>
