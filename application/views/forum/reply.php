<?php
$aid = $_GET['aid'];
?>
<form id="forum-reply-form" enctype="multipart/form-data" action="<?php echo Yii::app()->createUrl('forum/reply', array('aid'=>$aid)); ?>" method="POST">
<dl>
        <dt>
            <label for="forum-form-content">內容</label>
        </dt>
        <dd>
            <textarea name="reply[content]" id="forum-form-content" cols="30" rows="40"></textarea>
        </dd>
    </dl>
<input type="hidden" name="reply[$aid]" value="<?php echo $aid; ?>" />
<!-- Button 請參考News擺放的位置 !>
<input type="submit" value="回文" />
<input type="hidden" name="token" value="<?php echo Yii::app()->security->getToken(); ?>" />
</form>