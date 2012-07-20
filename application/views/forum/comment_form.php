<form enctype="multipart/form-data" action="<?php //echo Yii::app()->createUrl('forum/create', array('fid' => $fid)); ?>" method="POST"> 
<input type="text" name="comment[content]" />
<input type="hidden" name="forum[fid]" value="123<?php //echo $fid; ?>" />
<input type="submit" value="推文" />