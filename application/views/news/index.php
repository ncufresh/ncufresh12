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
<?php if ( $pageStatus['prevPage'] !== null ) : ?>
        <li><a href="<?php echo Yii::app()->createUrl('news/index', array('page' => $pageStatus['prevPage'])); ?>" title="上一頁">上一頁</a></li>
<?php endif; ?>
<?php for ( $i = $pageStatus['firstPage']; $i <= $pageStatus['lastPage']; ++$i ) : ?>
        <?php if ( $i == $pageStatus['currentPage'] ) : ?>
            <li><?php echo $i; ?></li>
        <?php else : ?>
            <li><?php echo CHtml::link($i, Yii::app()->createUrl('news/index', array('page' => $i))); ?></li>
        <?php endif; ?>
<?php endfor; ?>
<?php if ( $pageStatus['nextPage'] !== null ) : ?>
        <li><a href="<?php echo Yii::app()->createUrl('news/index', array('page' => $pageStatus['nextPage'])); ?>" title="下一頁">下一頁</a></li>
<?php endif; ?>
</ul>
<?php if ( Yii::app()->user->getIsAdmin() ) : ?>
<a href="<?php echo Yii::app()->createUrl('news/admin'); ?>" title="管理文章">管理文章</a>
<?php endif; ?>
<a class="news-back-link" href="#" title="返回">返回</a>