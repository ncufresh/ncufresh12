<form id="forum-create-form" enctype="multiprt/form-data" action="<?php echo Yii::app()->createUrl('forum/create', array('fid' => $fid)); ?>" method="POST">
<div id="forum-create">
<div class="form-top">
    <p id="forum-create-text-number-check">發表文章</p>
    <dl>
        <dt>
            <label id="forum-create-text-title" for="forum-create-title">標題</label>
        </dt>
        <dd>
            <input id="forum-create-title" type="text" name="forum[title]" maxLength="16"/>
        </dd>
    </dl>
</div>
<div class="form-body">
    
    <dl class="select">
        <dt>
            <label for="forum-create-category"></label>
        </dt>
        <dd>
            <select id="forum-create-category" name="forum[category_id]">
<?php 
foreach ( $category->article_categories as $entry ) :
    if ( $category->id == 1 )
    {
        if ( $entry->id == 12 )
        {
            if ( Yii::app()->user->getIsAdmin() ): ?>
                <option value="<?php echo $entry->id; ?>"><?php echo $entry->name; ?></option>
<?php
                continue;
            else:
                continue;
            endif;
        }
    }
?>
                <option value="<?php echo $entry->id; ?>"><?php echo $entry->name; ?></option>
<?php endforeach; ?>
            </select>
        </dd>
    </dl>
    <dl class="content">
        <dt>
            <label for="form-create-content">內容</label>
        </dt>
        <dd>
            <textarea id="form-create-content" name="forum[content]"></textarea>
        </dd>
    </dl>
    <!--置頂-->
    <?php
    if ( $category->getIsMaster() ) :
    ?>
        <dl class="article-is-top checkbox">
            <dt>
                <label for="form-create-top">置頂</label>
            </dt>
            <dd>
                <input id="form-create-top" type="checkbox" name="forum[sticky]" value="1" />
                <label for="form-create-top">置頂</label>
            </dd>
        </dl>
    <?php
    endif;
    ?>
</div>
<div class="form-foot">
    <div class="buttons">
    <input type="hidden" name="token" value="<?php echo Yii::app()->security->getToken(); ?>" />
    <input type="hidden" name="forum[forum_id]" value="<?php echo $fid; ?>" />
    <button id="forum-create-submit" disabled>發佈</button>
    <button class="forum-cancel-button" type="reset">取消</button>
    </div>
</div>
</div>
</form>