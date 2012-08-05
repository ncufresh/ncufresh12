<?php
$aid = $_GET['aid'];
?>
<form id="forum-reply-form" enctype="multipart/form-data" action="<?php echo Yii::app()->createUrl('forum/reply', array('aid'=>$aid)); ?>" method="POST">
<dl>
        <dt>
            <label for="forum-reply-content">須滿10個中文字 20個英文字以上</label>
        </dt>
        <dd>
            <textarea name="reply[content]" id="forum-reply-content"></textarea>
        </dd>
    </dl>
<input type="hidden" name="reply[$aid]" value="<?php echo $aid; ?>" />
<div class="buttons">
    <button class="reply-submit" type="submit" value="回文" disabled>回文</button>
</div>
<input type="hidden" name="token" value="<?php echo Yii::app()->security->getToken(); ?>" />
</form>