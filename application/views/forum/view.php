文章<br />
<?php

//推文限制登入才可以

echo "title: ".$article->title.'<br/>';
echo "content: ".$article->content.'<br/>';
?>

<a href="<?php echo Yii::app()->createUrl('forum/forum', array('fid'=>$_GET['fid']));?>">回上一頁</a><br/>
<?php
$com = $comments->findAll('article_id='.$article->id);
foreach($com as $each)
    echo $each -> content . '<br/>';
?>
<form enctype="multipart/form-data" action="<?php echo Yii::app()->createUrl('forum/comment'); ?>" method="POST"> 
<input type="text" name="comment[content]" />
<input type="hidden" name="comment[aid]" value="<?php echo $_GET['id']; ?>" />
<input type="submit" value="推文" />
<input type="hidden" name="token" value="<?php echo Yii::app()->security->getToken(); ?>" />
</form>
<br/>
<br/>
<a href="<?php echo Yii::app()->createUrl('forum/reply', array('aid'=>$article->id));?>">回覆文章</a><br/>
回文要做字數最低限制?<br/>
<?php
$rep = $reply->findAll('article_id='.$article->id);
foreach ($rep as $each)
    echo '作者: '.$each->author_id.' 內容: '.$each -> content. '<br/>';
?>
<fb:comments xid="12345678"></fb:comments>