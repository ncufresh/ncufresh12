<?php $this->beginWidget('system.web.widgets.CClipWidget', array('id' => 'script')); ?>
<script>
(function($){
    $(document).ready(function (){
        /* title最多20字元 */
        var title_num = 20;
        /* content最少10字元 */
        var content_num = 10;
        counter=[];
        function check_submit(){
            $("#forum-create-submit").attr('disabled','');
            check=0;
            for(i=0;i<2;i++){
                if(counter[i]!=1){
                    return false;
                }
                else if(counter[i]==1)
                    check=1;
            }
            if(check==1)
                return true;
        }
        $("#forum-create-title").keydown(function(){
            /* 若title字數超過20則將submit disable */
            if($(this).val().length > title_num){
                counter[0]=0;
                $(this).val($(this).val().substr(0, title_num));
                if(check_submit()==false)
                    $("#forum-create-submit").attr('disabled','');
            }
            else if($(this).val().length < title_num && $(this).val().length > 0){
                counter[0]=1;
                $("#forum-create-text-number-check").html("<strong>"+check_submit()+"</strong>");
                if(check_submit()==true)
                    $("#forum-create-submit").removeAttr('disabled');
            }
        });
        $("#form-create-content").keydown(function(){
            /* 若content字數小於10則將submit disable */
            if($(this).val().length < content_num){
                counter[1]=0;
                $(this).val($(this).val().substr(0, content_num));
                if(check_submit()==false)
                    $("#forum-create-submit").attr('disabled','');
            }
            else{
                counter[1]=1;
                $("#forum-create-text-number-check").html("<strong>"+check_submit()+"</strong>");
                if(check_submit()==true)
                    $("#forum-create-submit").removeAttr('disabled');
            }
        });
    });
})(jQuery);
</script>
<?php $this->endWidget();?>
發表文章<br />
<div id="forum-create-text-number-check"></div>
<?php
    echo $fid . '<br />';
    foreach ( $category->article_categories as $entry )
    {
            echo $entry->name . ' ';
            echo $entry->id . '<br />';
    }
?>

<form enctype="multiprt/form-data" action="<?php echo Yii::app()->createUrl('forum/create', array('fid' => $fid)); ?>" method="POST" id="forum-create-form">
標題<input id="forum-create-title" type="text" name="forum[title]" />
內容<textarea id="form-create-content" name="forum[content]" cols="30" rows="10"></textarea>
<br/>
分類
<select id="forum-create-category" name="forum[category]">
<?php foreach ( $category->article_categories as $entry ) : ?>
    <option value="<?php echo $entry->id; ?>"><?php echo $entry->name; ?></option>
<?php endforeach; ?>
</select>
<!--置頂-->
<?php
if($is_master):
?>
<input type="checkbox" name="forum[is_top]" value="1">置頂<br>
<input type="hidden" name="forum[is_top]" value="0"/>
<?php
endif;
?>
<input type="hidden" name="forum[fid]" value="<?php echo $fid; ?>" />
<button id="forum-create-submit" disabled>發佈</button>
<button class="forum-create-cancel-button" type="reset">取消</button>
<input type="hidden" name="token" value="<?php echo Yii::app()->security->getToken(); ?>" />
</form>
