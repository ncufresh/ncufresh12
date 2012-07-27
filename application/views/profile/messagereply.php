<h1>MyMessage_Reply</h1>
<div class="profile-message-reply" >
<table class="message-data">
    <tr>
        <td class="article-title">標題:</td>
        <td class="showarticle"><?php echo $article->title; ?></td>
    </tr>
    <tr>
        <td class="article-title">內容:</td>
        <td class="showarticle"><?php echo $article->content; ?></td>
    </tr>
</table>
<span class="form-friends-sort-title">回覆</span>
<table class="message-reply">
    <tr>
        <th>姓名:</th>
        <th>內容:</th>
        <th>時間:</th>
    </tr>
    <tr>
        <td >
        <ul id="reply">
<?php foreach ($replys as $reply) : ?>
            <li>
<?php echo Profile::model()->findByPk($reply->author_id)->name; ?>
            </li>
<?php endforeach;?>
        </ul>
        </td>
        <td>
        <ul id="reply">
<?php foreach ($replys as $reply) : ?>
            <li> <a href="#">
            <h3>按我吧^^</h3>
            <sapn>
<?php echo $reply->content; ?>
            </span>
            </a> 
            </li>
<?php endforeach;?>
        </ul>
        </td>
        <td>
        <ul id="reply">
<?php foreach ($replys as $reply) : ?>
            <li>
<?php echo Yii::app()->format->datetime($reply->create_time); ?>
            </li>
<?php endforeach;?>
        </ul>
        </td>
    </tr>
</table>
<span class="form-friends-sort-title" >推文</span>
<table class="message-reply">
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
        <input type="text" name="comment[content]" />
        <input type="hidden" name="comment[aid]" value="<?php echo $comment->article_id; ?>" />
        <input type="submit" value="推文" />
        <input type="hidden" name="token" value="echo Yii::app()->security->getToken(); ?>" />
    </form>
</div>
<button>
<a href="<?php echo Yii::app()->createUrl('profile/message') ; ?>" title="我的文章">BACK</a>
</button>