文章<br />
<?php
echo "title: ".$article->title.'<br/>';
echo "content: ".$article->content.'<br/>';
echo CHtml::link("回上一頁", Yii::app()->createUrl('forum/forum', array('fid'=>$_GET['fid']))) . '<br />';
$com = $comments->findAll('article_id='.$article->id);
foreach($com as $each)
    echo $each -> content . '<br/>';
?>
<form enctype="multipart/form-data" action="<?php echo Yii::app()->createUrl('forum/comment'); ?>" method="POST"> 
<input type="text" name="comment[content]" />
<input type="hidden" name="comment[aid]" value="<?php echo $_GET['id']; ?>" />
<input type="submit" value="推文" />
<br/>
<br/>
<?php
echo CHtml::link("回覆文章", Yii::app()->createUrl('forum/reply', array('aid'=>$article->id))) . '<br />';
?>
回文要做字數最低限制?<br/>
<?php
$rep = $reply->findAll('article_id='.$article->id);
foreach ($rep as $each)
    echo '作者: '.$each->author_id.' 內容: '.$each -> content. '<br/>';
?>
<fb:comments xid="12345678"></fb:comments>