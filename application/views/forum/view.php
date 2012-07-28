<div id="forum-view-top">
    <a id="forum-view-backlink"href="<?php echo Yii::app()->createUrl('forum/forum', array('fid'=>$_GET['fid']));?>">回上一頁</a>
</div>
<div id="forum-view-top2">
    
    <?php 
    //[not yet]
    $this->widget('Pager', array(
        'url'       => 'forum/forum',
        'pager'     => 1,
    )); ?>
    <a id="forum-view-replylink" href="<?php echo Yii::app()->createUrl('forum/reply', array('aid'=>$article->id));?>"></a>
</div>
<div id="forum-view-body">
    <div class="forum-view-profile">
        <div class="profile-pic"></div>
        <div class="profile-name"></div>
        <div class="profile-id"></div>
        <div class="profile-department"></div>
    </div>
    <div class="forum-view-title"></div>
    <div id="forum-view-content"></div>
    <div class="hululu"></div>
    <div class="forum-view-comments"></div>
</div>
<div id="forum-view-replies">
    <div class="forum-view-profile">
        <div class="profile-pic"></div>
        <div class="profile-name"></div>
        <div class="profile-id"></div>
        <div class="profile-department"></div>
    </div>
    <div class="reply-content">
        <div class="hululu"></div>
    </div>
</div>
<div id="forum-view-footer">
</div>
<?php
echo "title: ".$article->title.'<br/>';
echo "content: ".$article->content.'<br/>';
?>

<?php
$com = $comments->findAll('article_id='.$article->id);
foreach($com as $each)
    echo $each -> content . '<br/>';
/*登入才可以推文*/
if(Yii::app()->user->getIsMember()):
?>
<form id="forum-comment" enctype="multipart/form-data" action="<?php echo Yii::app()->createUrl('forum/comment'); ?>" method="POST"> 
<input id="forum-comment-text" type="text" maxlength="30" name="comment[content]" />
<input type="hidden" name="comment[aid]" value="<?php echo $_GET['id']; ?>" />
<input type="submit" value="推文" />
<input type="hidden" name="token" value="<?php echo Yii::app()->security->getToken(); ?>" />
</form>
<div id="counter"></div>
<?php
endif;
?>
<br/>
<br/>


<?php
$rep = $reply->findAll('article_id='.$article->id);
foreach ($rep as $each)
    echo '作者: '.$each->author_id.' 內容: '.$each -> content. '<br/>';
?>
<fb:comments xid="12345678"></fb:comments>
