﻿發表文章<br />
<?php
	echo $fid.'<br />';
	foreach($category->article_categories as $each){
			echo $each->name.' ';
			echo $each->id.'<br />';
	}
?>

<form enctype="multipart/form-data" action="<?php echo Yii::app()->createUrl('forum/create?fid='.$fid)?>" method="post" class="MultiFile-intercepted">
標題<input type="text" name="forum[title]" /><br />
內容<textarea name="forum[content]" id="forum-form-content" cols="30" rows="10"></textarea><br />
分類
<select name="forum[category]">
	<?php foreach($category->article_categories as $each):?>
		<option value="<?php echo $each->id?>"><?php echo $each->name?></option>
	<?php endforeach; ?>
</select><br />
<input type="hidden" name="forum[fid]" value="<?php echo $fid;?>" />
<input type="submit" value="發佈" />

<input class="news-cancel-button" type="button" value="取消" />
<input type="hidden" name="token" value="<?php echo Yii::app()->security->getToken(); ?>" />
</form>