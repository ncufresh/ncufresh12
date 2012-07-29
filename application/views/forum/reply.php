<?php $this->beginWidget('system.web.widgets.CClipWidget', array('id' => 'script')); ?>
<script>
(function($){
    $("#forum-reply-content").keydown(function(){
        var content_num = 20;
        /* 若content字數小於10則將submit disable */
        if($(this).val().length < content_num){
            $(".reply-submit").attr('disabled','');
        }
        else{
            $(".reply-submit").removeAttr('disabled');
        }
    });
})(jQuery);
</script>
<?php $this->endWidget();?>
<?php
$aid = $_GET['aid'];
?>
<form id="forum-reply-form" enctype="multipart/form-data" action="<?php echo Yii::app()->createUrl('forum/reply', array('aid'=>$aid)); ?>" method="POST">
<dl>
        <dt>
            <label for="forum-reply-content">須滿10個中文字 20個英文字以上</label>
        </dt>
        <dd>
            <textarea name="reply[content]" id="forum-reply-content" cols="30" rows="40"></textarea>
        </dd>
    </dl>
<input type="hidden" name="reply[$aid]" value="<?php echo $aid; ?>" />

<button class="reply-submit" type="submit" value="回文" disabled>回文</button>
<input type="hidden" name="token" value="<?php echo Yii::app()->security->getToken(); ?>" />
</form>