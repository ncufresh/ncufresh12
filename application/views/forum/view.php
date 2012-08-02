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
        <div class="profile-name">暱稱：<?php echo User::model()->findByPK($article->author_id)->profile->nickname; ?></div>
        <div class="profile-department">系所：<?php echo User::model()->findByPK($article->author_id)->profile->mydepartment->abbreviation;?></div>
    </div>
    <div class="forum-view-title"><?php echo $article->title; ?></div>
    
    <div id="forum-view-content"><?php echo $article->content; ?></div>
    <div class="hululu"></div>
    <?php
    $com = $article->comments;
    foreach($com as $each):
    ?>
    <div class="forum-view-comments"><?php echo User::model()->findByPK($each->author_id)->profile->nickname;?>：<?php echo $each -> content; ?></div>
    <?php
    endforeach;
    ?>
    <?php
    /*登入才可以推文*/
    if(Yii::app()->user->getIsMember()):
    ?>
    <form id="forum-comment" enctype="multipart/form-data" action="<?php echo Yii::app()->createUrl('forum/comment'); ?>" method="POST"> 
    <input id="forum-comment-text" type="text" maxlength="32" name="comment[content]" />
    <input type="hidden" name="comment[article_id]" value="<?php echo $_GET['id']; ?>" />
    <button type="submit" value="推文">推文</button>
    <input type="hidden" name="token" value="<?php echo Yii::app()->security->getToken(); ?>" />
    </form>
    <div id="counter"></div>
    <?php
    endif;
    ?>
</div>
<?php
$rep = $article->replies;
foreach ($rep as $each):
?>
<div id="forum-view-replies">
    <div class="forum-view-profile">
        <div class="profile-pic"></div>
        <div class="profile-name"></div>
        <div class="profile-id"></div>
        <div class="profile-department"></div>
    </div>
    <div class="reply-content">
        <?php echo $each -> content;?>
        <div class="hululu"></div>
        
    </div>
</div>
<?php
endforeach;
?>
<div id="forum-view-footer">
</div>