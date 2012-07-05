<h1><?php echo $news->title; ?></h1>
<p>作者<?php echo $news->author->username;?></p>
<p>時間<?php echo date('Y/m/d', $news->updated )?></p>
<a href="<?php echo Yii::app()->createUrl('news/update', array('id' => $news->id));?>">編輯文章</a>
<p><?php echo $news->content; ?></p>


<?php if( !empty( $news->urls ) ):?>
<h3>相關連結</h3>
<?php endif;?>
<?php foreach($news->urls as $url): ?>
	<a href="<?php echo $url->link;?>"><?php echo $url->name;?></a><br />
<?php endforeach; ?>

<?php if( !empty($files) ):?>
<h3>附加檔案</h3>
<?php endif;?>
<?php foreach( $files as $filename => $file_url ):?>
	<a href="<?php echo $file_url;?>"><?php echo $filename;?></a><br />
<?php endforeach; ?>
<a href="<?php echo Yii::app()->createUrl('news/index', array('page' => $currentPage));?>">返回</a>
