<h1><?php echo $news->title; ?></h1>
<p>作者:<?php echo $news->author->username;?></p>
<p>時間:<?php echo $news->updated; ?></p>
<?php if(Yii::app()->user->isAdmin):?>
<a href="<?php echo Yii::app()->createUrl('news/update', array('id' => $news->id));?>">編輯文章</a>
<?php endif;?>
<p><?php echo $news->content; ?></p>


<?php if( !empty( $news->urls ) ):?>
<h2>相關連結</h2>
<?php endif;?>
<?php foreach($news->urls as $url): ?>
	<a href="<?php echo $url->link;?>"><?php echo $url->name;?></a><br />
<?php endforeach; ?>

<?php if( !empty($files) ):?>
<h2>附加檔案</h2>
<?php endif;?>
<?php foreach( $files as $filename => $file_url ):?>
	<a href="<?php echo $file_url;?>"><?php echo $filename;?></a><br />
<?php endforeach; ?>
<a class="news-back-link" href="#">返回</a>
