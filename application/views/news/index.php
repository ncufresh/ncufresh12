<h1>最新消息</h1>
<table class="news-table">
	<tbody>
		<?php foreach($news as $each):?>
			<tr>
				<td><?php echo CHtml::link($each->title, $each->url);?></td>
				<td><?php echo date('Y/m/d H:i:s', $each->updated )?></td>
			</tr>
		<?php endforeach ?>
	</tbody>
</table>
<ul>
<?php if($pageStatus['prevPage']!==null): ?>
        <li><a href="<?php echo Yii::app()->createUrl('news/index', array('page'=>$pageStatus['prevPage'])) ;?>">上一頁</a></li>
<?php endif; ?>
<?php for($i = $pageStatus['firstPage']; $i <= $pageStatus['lastPage']; $i++): ?>
    
        <?php if($i == $pageStatus['currentPage']): ?>
            <li><?php echo $i;?></li>
        <?php else: ?>
            <li><?php echo CHtml::link($i, Yii::app()->createUrl('news/index', array('page'=>$i))); ?></li>
		<?php endif;?>
<?php endfor; ?>
<?php if($pageStatus['nextPage']!==null): ?>
        <li><a href="<?php echo Yii::app()->createUrl('news/index', array('page'=>$pageStatus['nextPage'])) ;?>">下一頁</a></li>
<?php endif; ?>
</ul>
<?php if(Yii::app()->user->isAdmin): ?>
<a href="<?php echo Yii::app()->createUrl('news/admin'); ?>">管理文章</a>
<?php endif; ?>
<a class="news-back-link" href="#">返回</a>