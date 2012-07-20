<?php
echo $aid = $_GET['aid'];
?>
<form enctype="multipart/form-data" action="<?php echo Yii::app()->createUrl('forum/reply', array('aid'=>$aid)); ?>" method="POST" class="MultiFile-intercepted">
內容<textarea name="reply[content]" id="forum-form-content" cols="30" rows="10"></textarea>
<input type="hidden" name="reply[$aid]" value="<?php echo $aid; ?>" />
<input type="submit" value="回文" />
</form>