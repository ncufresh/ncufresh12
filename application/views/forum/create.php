<?php $this->beginWidget('system.web.widgets.CClipWidget', array('id' => 'script')); ?>
<script>
(function($){
    //$( '#form-create-content' ).ckeditor();
    $(document).ready(function (){
        /* title最多20字元 */
        var title_num = 20;
        /* content最少20字元 */
        var content_num = 20;
        counter=[];
        var content = $('#forum-create-text-number-check').html();
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
                if(check_submit()==false){
                    $("#forum-create-submit").attr('disabled','');
                    $(".form-top p").html(content+" <strong>"+check_submit()+"</strong>");
                }
            }
            else if($(this).val().length < title_num && $(this).val().length > 0){
                counter[0]=1;
                if(!check_submit())
                    $(".form-top p").html(content+" <strong>文章字數須滿10字以上喔!</strong>");
                if(check_submit()==true)
                    $("#forum-create-submit").removeAttr('disabled');
            }
        });
        $("#form-create-content").keydown(function(){
            /* 若content字數小於10則將submit disable */
            if($(this).val().length < content_num){
                counter[1]=0;
                $(this).val($(this).val().substr(0, content_num));
                if(check_submit()==false){
                    $("#forum-create-submit").attr('disabled','');
                    $(".form-top p").html(content+" <strong>文章內容字數不足</strong>");
                }
            }
            else{
                counter[1]=1;
                $("#forum-create-text-number-check").html(content);
                if(check_submit()==true){
                    $("#forum-create-submit").removeAttr('disabled');
                    $(".form-top p").html(content);
                }
            }
        });
        $('.forum-cancel-button').click(function()
        {
            $.confirm({
                message: '確定取消編輯此篇文章？',
                confirmed: function(result)
                {
                    if ( result ) window.location = '<?php echo Yii::app()->createUrl('forum/forum', array('fid' => $fid, 'sort' => 'create'));?>';
                    return false;
                }
            });
            return false;
        });
    });
})(jQuery);
</script>
<?php $this->endWidget();?>

<form id="forum-create-form" enctype="multiprt/form-data" action="<?php echo Yii::app()->createUrl('forum/create', array('fid' => $fid)); ?>" method="POST">
<div class="form-top">
    <p id="forum-create-text-number-check">發表文章</p>
    <dl>
        <dt>
            <label id="forum-create-text-title" for="forum-create-title">標題</label>
        </dt>
        <dd>
            <input id="forum-create-title" type="text" name="forum[title]" maxLength="20"/>
        </dd>
    </dl>
</div>
<div class="form-body">
    
    <dl>
        <dt>
            <label for="forum-create-category"></label>
        </dt>
        <dd>
            <select id="forum-create-category" name="forum[category]">
            <?php foreach ( $category->article_categories as $entry ) : ?>
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
            <textarea id="form-create-content" name="forum[content]" cols="70" rows="10"></textarea>
        </dd>
    </dl>
    <!--置頂-->
    <?php
    if($is_master):
    ?>
        <dl class="article-is-top">
            <dt>
                <label class="top-checkbox" for="form-create-top">置頂</label>
            </dt>
            <dd>
                <input id="form-create-top" type="checkbox" name="forum[is_top]" value="1" />
            </dd>
        </dl>
        
    <input type="hidden" name="forum[is_top]" value="0"/>
    <?php
    endif;
    ?>
</div>
<div class="form-foot">
    <input type="hidden" name="forum[fid]" value="<?php echo $fid; ?>" />
    <button id="forum-create-submit" disabled>發佈</button>
    <button class="forum-cancel-button" type="reset">取消</button>
</div>
<input type="hidden" name="token" value="<?php echo Yii::app()->security->getToken(); ?>" />
</form>