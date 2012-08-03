<h4>論壇回覆</h4>
<div class="profile-message-reply" >
    <ul id="self-message">
        <li class="article-title">標題:<li >
        <li id="article-content-title"><?php echo $article->title; ?></li>
        <li class="article-title">內容:</li>
        <li id="article-content">
        <div class="self-messages"><?php echo $article->content; ?></div>
        <li>
        
    </ul>
    <div class="allmessages">
    <span class="reply-title">回覆</span>
    <table class="profile-comments">
        <thead>
            <tr>
                <th>姓名:</th>
                <th>內容:</th>
                <th>時間:</th>
            </tr>
        </thead>
        <tbody>
<?php foreach ($replys as $reply) : ?>
            <tr>
                <td><?php echo Profile::model()->findByPk($reply->author_id)->name; ?></td>
                <td class="reply-content">
                    <a href="#">人家回我....啥哩</a>
                    <span><?php echo $reply->content ?></span>
                    <br />
                    <span>....<a href="<?php echo $article->getUrl(); ?>">完整閱讀<a></span>
                </td>
                <td><?php echo $reply->created; ?></td>
            </tr>
<?php endforeach;?>
        </tbody>
    </table>
    <span class="reply-title">推文</span>
    <table>
        <tr>
            <th>姓名:</th>
            <th>內容:</th>
            <th>時間:</th>
        </tr>
<?php foreach ($comments as $comment) : ?>
        <tr>
            <td>
<?php echo Profile::model()->findByPk($comment->author_id)->name; ?>
            </td>
            <td>
<?php echo $comment->content; ?>
            </td>
            <td>
<?php echo $comment->created; ?>
            </td>
        </tr>
<?php endforeach;?>
    </table>
    <form id="forum-comment" enctype="multipart/form-data" action="<?php echo Yii::app()->createUrl('forum/comment'); ?>" method="POST"> 
        <input id="forum-comment-text" type="text" maxlength="32" name="comment[content]" />
        <input type="hidden" name="comment[article_id]" value="<?php echo $article->id; ?>" />
        <button type="submit" id="button-push"></button>
        <a href="<?php echo Yii::app()->createUrl('profile/message'); ?>" id="button-back-reply"></a>
        <input type="hidden" name="token" value="<?php echo Yii::app()->security->getToken(); ?>" />
    </form>
    </div>
</div>
