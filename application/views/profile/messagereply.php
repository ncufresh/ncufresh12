<h1>論壇回覆</h1>
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
                    <a href="#">Hehey</a>
                    <span><?php echo $reply->content; ?></span>
                </td>
                <td><?php echo Yii::app()->format->datetime($reply->create_time); ?></td>
            </tr>
<?php endforeach;?>
        </tbody>
        <div>
        </div>
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
<?php echo Yii::app()->format->datetime($comment->create_time); ?>
            </td>
        </tr>
<?php endforeach;?>
    </table>
    <form enctype="multipart/form-data" action="<?php echo Yii::app()->createUrl('forum/comment'); ?>" method="POST"> 
        <input type="hidden" name="token" value="echo Yii::app()->security->getToken(); ?>" />
        <input type="text" name="comment[content]" />
        <input type="hidden" name="comment[aid]" value="<?php echo $article->id; ?>" />
        <input type="submit" value="推文" class="button-push" />
        <button type="button" class="button-back" ></button>
    </form>
    </div>
</div>
