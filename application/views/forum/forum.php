<script>
$(document).ready(function (){
    $('.article-delete').click(function (){
        $('.form-delete input').attr('value', $(this).attr('href').replace('#', ''));
        if(confirm("刪除文章?")){
            $('.form-delete').submit();            
        }
        return false;
    });
});
</script>
文章列表<br />
<?php
    echo $fid . '<br />';
    echo CHtml::link('發表文章', Yii::app()->createUrl('forum/create', array('fid' => $fid))) . '<br />';
    //if ( ! empty($model) ) echo 'hi'.'<br/>';
    
    foreach($model as $each){
        //echo $each->title.'<br/>';
        echo CHtml::link($each->title, $each->url).'&nbsp';
        echo $each->id;
        ?>
        <a href="#<?php echo $each->id;?>" class="article-delete" >刪除</a>
        <br/>
        <?php
    }
    
?>
<form enctype="multipart/form-data" action="<?php echo Yii::app()->createUrl('forum/delete'); ?>" method="POST" class="form-delete">
<input type="hidden" name="delete" value=""/>
</form>