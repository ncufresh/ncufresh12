<?php Yii::app()->clientScript->registerCoreScript('jquery.ui'); ?>
<h1>管理最新消息</h1>
<a href="<?php echo Yii::app()->createUrl('news/create') ;?>">新增文章</a><br />
<table class="news-table">
	<tbody>
		<?php foreach($news as $each):?>
			<tr>
				<td><?php echo CHtml::link($each->title, $each->url);?></td>
				<td><a href="<?php echo Yii::app()->createUrl('news/update', array( 'id' => $each->id) ); ?>">編輯</a></td>
				<td><a class="news-delete-link" href="<?php echo Yii::app()->createUrl('news/delete', array( 'id' => $each->id) ); ?>">刪除</a></td>
				<td><?php echo date('Y/m/d H:i:s', $each->updated )?></td>
			</tr>
		<?php endforeach ?>
	</tbody>
</table>

<ul>
<?php if($pageStatus['prevPage']!==null): ?>
        <li><a href="<?php echo Yii::app()->createUrl('news/admin', array('page'=>$pageStatus['prevPage'])) ;?>">上一頁</a></li>
<?php endif; ?>
<?php for($i = $pageStatus['firstPage']; $i <= $pageStatus['lastPage']; $i++): ?>
    
        <?php if($i == $pageStatus['currentPage']): ?>
            <li><?php echo $i;?></li>
        <?php else: ?>
            <li><?php echo CHtml::link($i, Yii::app()->createUrl('news/admin', array('page'=>$i))); ?></li>
		<?php endif;?>
<?php endfor; ?>
<?php if($pageStatus['nextPage']!==null): ?>
        <li><a href="<?php echo Yii::app()->createUrl('news/admin', array('page'=>$pageStatus['nextPage'])) ;?>">下一頁</a></li>
<?php endif; ?>
</ul>
<a class="news-back-link" href="#">返回</a>
<div class="news-dialog"></div>
