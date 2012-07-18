發表文章<br />
<?php
    echo $fid . '<br />';
    foreach ( $category->article_categories as $entry )
    {
            echo $entry->name . ' ';
            echo $entry->id . '<br />';
    }
?>

<form enctype="multipart/form-data" action="<?php echo Yii::app()->createUrl('forum/create?fid=' . $fid)?>" method="POST" class="MultiFile-intercepted">
標題<input type="text" name="forum[title]" />
內容<textarea name="forum[content]" id="forum-form-content" cols="30" rows="10"></textarea>
分類
<select name="forum[category]">
    <?php foreach ( $category->article_categories as $entry ) : ?>
        <option value="<?php echo $entry->id; ?>"><?php echo $entry->name; ?></option>
    <?php endforeach; ?>
</select>
<input type="hidden" name="forum[fid]" value="<?php echo $fid; ?>" />
<input type="submit" value="發佈" />

<input class="news-cancel-button" type="button" value="取消" />
<input type="hidden" name="token" value="<?php echo Yii::app()->security->getToken(); ?>" />
</form>