<h1><?php echo $news->title; ?></h1>
<p>作者:<?php echo $news->author->username; ?></p>
<p>時間:<?php echo $news->updated; ?></p>
<?php if ( Yii::app()->user->getIsAdmin() ) : ?>
<a href="<?php echo Yii::app()->createUrl('news/update', array('id' => $news->id)); ?>" title="編輯文章">編輯文章</a>
<?php endif;?>
<p><?php echo $news->content; ?></p>


<?php if ( ! empty($news->urls) ) : ?>
<p>相關連結</p>
<?php endif; ?>
<?php foreach ( $news->urls as $url ) : ?>
    <a href="<?php echo $url->link; ?>" title="<?php echo $url->name; ?>"><?php echo $url->name; ?></a>
<?php endforeach; ?>

<?php if( ! empty($files) ) : ?>
<p>附加檔案</p>
<?php endif; ?>
<?php foreach ( $files as $filename => $file_url ) : ?>
    <a href="<?php echo $file_url; ?>" title="<?php echo $filename; ?>"><?php echo $filename; ?></a>
<?php endforeach; ?>
<a class="news-back-link" href="#" title="返回">返回</a>
