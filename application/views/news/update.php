<h2>編輯文章</h2>
<form enctype="multipart/form-data" action="<?php echo Yii::app()->createUrl('news/update', array('id'=>$news->id) ); ?>" method="POST" class="MultiFile-intercepted">
標題<input type="text" name="news[title]" value="<?php echo $news->title; ?>"/><br />
內容<textarea name="news[content]" id="news-form-content" cols="30" rows="10"><?php echo $news->content; ?></textarea><br />
<?php if ( ! empty($news->urls) ) : ?>
<h3>相關連結</h3>
<?php endif; ?>
<?php foreach ( $news->urls as $url ) : ?>
    <a href="<?php echo $url->link; ?>" title="<?php echo $url->name; ?>"><?php echo $url->name; ?></a>
<?php endforeach; ?>

<?php if ( ! empty($files) ) : ?>
<h3>附加檔案</h3>
<?php endif; ?>
<?php foreach ( $files as $filename => $file_url ) : ?>
    <a href="<?php echo $file_url; ?>" title="<?php echo $filename; ?>"><?php echo $filename; ?></a>
<?php endforeach; ?>
<input type="submit" value="發佈" />
<input class="news-cancel-button" type="button" value="取消" />
<input name="token" value="<?php echo Yii::app()->security->getToken(); ?>" type="hidden" />
</form>
<div class="news-dialog"></div>