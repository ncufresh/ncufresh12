最新消息內文
<h1><?php echo $news->title; ?></h1>
<p><?php echo $news->content; ?></p>
<p>時間<?php echo date('Y/m/d', $news->updated )?></p>
<p>作者<?php echo $news->author_id;?></p>
<a href="<?php echo Yii::app()->createUrl('news/index', array('page' => $currentPage));?>">回目錄</a><br />
<a href=""></a>
<?php 
if( $dir !== null ){
	while($entry = $dir->read()):
		if( $entry == '.' || $entry == '..') continue;
?>
		 <a href="<?php echo Yii::app()->baseUrl . DIRECTORY_SEPARATOR . $dir->path . DIRECTORY_SEPARATOR .iconv("big5", "utf-8",  $entry);?>"><?php echo iconv("big5", "utf-8",  $entry) ;?></a><br />	
<?php
	endwhile;
	$dir->close();
}
?>