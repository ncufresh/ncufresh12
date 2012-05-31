<?php $this->pageTitle = '最新消息'; ?>

最新消息內文
<h1><?php echo $news->title; ?></h1>
<p><?php echo $news->content; ?></p>
<p>時間<?php echo date('Y/m/d', $news->updated )?></p>
<p>作者<?php echo $news->author_id;?></p>
<a href="<?php echo Yii::app()->createUrl('news/index', array('page' => $currentPage));?>">回目錄</a>