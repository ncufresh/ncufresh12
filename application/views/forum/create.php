<?php $this->beginWidget('system.web.widgets.CClipWidget', array('id' => 'script')); ?>
<script>
(function($){
    $(document).ready(function (){
        var title_num = 20;
        var content_num = 10;
        //$("#text-number-check").append("You have  <strong>"+ characters+"</strong> characters remaining");
        //var  remaining ;
        //check_title=1;
        counter=[];
        function check_submit(){
            $("#send").attr('disabled','');
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
        $("#title").keydown(function(){
            if($(this).val().length > title_num){
                counter[0]=0;
                $(this).val($(this).val().substr(0, title_num));
                if(check_submit()==false)
                    $("#send").attr('disabled','');
            }
            else if($(this).val().length < title_num && $(this).val().length > 0){
                counter[0]=1;
                $("#text-number-check").html("<strong>"+check_submit()+"</strong>");
                if(check_submit()==true)
                    $("#send").removeAttr('disabled');
            }
        });
        $("#form-forum-content").keydown(function(){
            if($(this).val().length < content_num){
                counter[1]=0;
                $(this).val($(this).val().substr(0, content_num));
                if(check_submit()==false)
                    $("#send").attr('disabled','');
            }
            else{
                counter[1]=1;
                $("#text-number-check").html("<strong>"+check_submit()+"</strong>");
                if(check_submit()==true)
                    $("#send").removeAttr('disabled');
            }
        });
    });
})(jQuery);
</script>
<?php $this->endWidget();?>
發表文章<br />
<div id="text-number-check"></div>
<?php
    echo $fid . '<br />';
    foreach ( $category->article_categories as $entry )
    {
            echo $entry->name . ' ';
            echo $entry->id . '<br />';
    }
?>

<form enctype="multipart/form-data" action="<?php echo Yii::app()->createUrl('forum/create', array('fid' => $fid)); ?>" method="POST" class="MultiFile-intercepted">
標題<input id="title" type="text" name="forum[title]" />
內容<textarea id="form-forum-content" name="forum[content]" cols="30" rows="10"></textarea>
<br/>
分類
<select name="forum[category]">
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
<button type="submit" id="send" disabled>發佈</button>
<button class="article-cancel-button" type="reset">取消</button>
<input type="hidden" name="token" value="<?php echo Yii::app()->security->getToken(); ?>" />
</form>
