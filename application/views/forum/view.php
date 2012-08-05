<div id="forum-view-top">
    <a id="forum-view-backlink"href="<?php echo Yii::app()->createUrl('forum/forum', array('fid'=>$_GET['fid']));?>">回上一頁</a>
</div>
<div id="forum-view-top2">
    <?php
    $this->widget('Pager', array(
        'url'       => 'forum/view',
        'pager'     => $page_status,
        'parameters'=> array('fid' => $fid, 'id' => $article->id)
    )); ?>
    <a id="forum-view-replylink" href="<?php echo Yii::app()->createUrl('forum/reply', array('aid'=>$article->id));?>"></a>
    <span class="fb">
        <fb:like layout="button_count" show_faces="false" action="like" colorscheme="light"></fb:like>
    </span>
</div>
<?php
/*綜合討論 + 管理學院*/
if ( $fid == 1 || $fid == 18 || $fid == 19 || $fid == 20 || $fid == 21)
{
    $forum_color = 'pink';
}
/*社團討論 + 文學院*/
else if ( $fid == 2 || $fid == 3 || $fid == 4 || $fid == 5 )
{
    $forum_color = 'purple';
}
/*工學院*/
else if ( $fid == 6 || $fid == 7 || $fid == 8 )
{
    $forum_color = 'green';
}
/*資電院*/
else if ( $fid == 9 || $fid == 10 || $fid == 11 )
{
    $forum_color = '';
}
/*理學院*/
else if ( $fid == 12 || $fid == 13 || $fid == 14 || $fid == 15 || $fid == 16 || $fid == 17 )
{
    $forum_color = 'blue';
}
/*地科學院*/
else if ( $fid == 22 || $fid == 23 )
{
    $forum_color = 'orange';
}
?>
<div id="forum-view-body" class="<?php echo $forum_color; ?>">
    <div class="forum-view-profile">
        <div class="profile-pic">
        <?php $this->widget('Avatar', array(
            'id'        => $article->author_id,
            'link'      => true
        )); ?>
        </div>
        <div class="profile-name">暱稱：<?php echo User::model()->findByPK($article->author_id)->profile->nickname; ?></div>
        <div class="profile-department">系所：<?php echo User::model()->findByPK($article->author_id)->profile->mydepartment->abbreviation;?></div>
<?php   if ( ! Yii::app()->user->isguest && Yii::app()->user->id != $article->author_id ) :
            $relation = Friend::model()->friendRelation($article->author_id);
?>
        <div class="profile-add-friend">
            <?php if ( $relation === Friend::IS_NOT_FRIEND ) : ?>
            <a class="add-friend" href="#<?php echo $article->author_id;?>">+加為好友+</a>
            <?php elseif ( $relation === Friend::IS_SEND_REQUEST ) : ?>
            <span>已送出邀請</span>
            <?php elseif ( $relation === Friend::IS_FRIEND ) : ?>
            <span>已加為好友</span>
            <?php elseif ( $relation === Friend::IS_RECEIVERED_REQUEST ) : ?>
            <span>已收到邀請</span>
            <?php endif; ?>
        </div>
<?php endif; ?>
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
    <form id="form-comment" enctype="multipart/form-data" action="<?php echo Yii::app()->createUrl('forum/comment'); ?>" method="POST">
    <input class="forum-comment-text" type="text" maxlength="28" name="comment[content]" />
    <input type="hidden" name="comment[article_id]" value="<?php echo $_GET['id']; ?>" />
    <input type="hidden" name="token" value="<?php echo Yii::app()->security->getToken(); ?>" />
    </form>
    <?php
    endif;
    ?>
</div>
<?php
//$rep = $article->replies;
foreach ($replies as $each):
?>
<div id="forum-view-replies" class="<?php echo $forum_color; ?>">
    <div class="forum-view-profile">
        <div class="profile-pic">
        <?php $this->widget('Avatar', array(
            'id'        => $each->author_id,
            'link'      => true
        )); ?>
        </div>
        <div class="profile-name">暱稱：<?php echo User::model()->findByPK($each->author_id)->profile->nickname; ?></div>
        <div class="profile-department">系所：<?php echo User::model()->findByPK($each->author_id)->profile->mydepartment->abbreviation;?></div>
<?php   if ( ! Yii::app()->user->isguest && Yii::app()->user->id != $each->author_id ) :
            $relation = Friend::model()->friendRelation($each->author_id);
?>
        <div class="profile-add-friend">
            <?php if ( $relation === Friend::IS_NOT_FRIEND ) : ?>
            <a class="add-friend" href="#<?php echo $each->author_id;?>">+加為好友+</a>
            <?php elseif ( $relation === Friend::IS_SEND_REQUEST ) : ?>
            <span>已送出邀請</span>
            <?php elseif ( $relation === Friend::IS_FRIEND ) : ?>
            <span>已加為好友</span>
            <?php elseif ( $relation === Friend::IS_RECEIVERED_REQUEST ) : ?>
            <span>已收到邀請</span>
            <?php endif; ?>
        </div>
<?php endif; ?>
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
    <?php
    $this->widget('Pager', array(
        'url'       => 'forum/view',
        'pager'     => $page_status,
        'parameters'=> array('fid' => $fid, 'id' => $article->id)
    )); ?>
</div>