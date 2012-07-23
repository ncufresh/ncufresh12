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
$(document).ready(function (){
    $("#sort_list").change(function() {
        var url = decodeURIComponent('<?php echo Yii::app()->createUrl('forum/forum', array('fid' => $fid, 'sort' => ':sort'));?>');
        window.location = url.replace(':sort', $(this).val());
    });
});
</script>
文章列表<br />
<select id="sort_list">
  <option value="create" <?php if($sort=='create') echo 'SELECTED';?>>依發表時間</option>
  <option value="update" <?php if($sort=='update') echo 'SELECTED';?>>依最新回覆</option>
  <option value="reply"  <?php if($sort=='reply') echo 'SELECTED';?>>依回應數量</option>
</select>
<br/>
<?php
    echo $fid . '<br />';
    echo CHtml::link('發表文章', Yii::app()->createUrl('forum/create', array('fid' => $fid))) . '<br />';
    //if ( ! empty($model) ) echo 'hi'.'<br/>';
    
    foreach($model as $each){
        //echo $each->title.'<br/>';
        echo CHtml::link($each->title, $each->url).'&nbsp';
        echo $each->id.' ';
        echo $each->replies_count;
        ?>
        <a href="#<?php echo $each->id;?>" class="article-delete" >刪除</a>
        <br/>
        <?php
    }
    
?>
時間顯示(!?)

<form enctype="multipart/form-data" action="<?php echo Yii::app()->createUrl('forum/delete'); ?>" method="POST" class="form-delete">
<input type="hidden" name="delete" value=""/>
</form>