文章<br />
<?php
echo "title: ".$article->title.'<br/>';
echo "content: ".$article->content.'<br/>';
echo CHtml::link("回上一頁", Yii::app()->createUrl('forum/forum', array('fid'=>$_GET['fid']))) . '<br />';
//foreach($comments as $each){
    $com = $comments->findAll('article_id='.$article->id);
    foreach($com as $each)
        echo $each -> content . '<br/>';
//}
?>

<form enctype="multipart/form-data" action="<?php echo Yii::app()->createUrl('forum/comment'); ?>" method="POST"> 
<input type="text" name="comment[content]" />
<input type="hidden" name="comment[aid]" value="<?php echo $_GET['id']; ?>" />
<input type="submit" value="推文" />