<?php $this->beginWidget('system.web.widgets.CClipWidget', array('id' => 'script')); ?>
<script>
(function($){
    $(document).ready(function (){
        $('.article-delete').click(function (){
            $('.form-delete input').attr('value', $(this).attr('href').replace('#', ''));
            if(confirm("刪除文章?")){
                $('.form-delete').submit();            
            }
            return false;
        });
        $("#sort_list").change(function() {
            var url = decodeURIComponent('<?php echo Yii::app()->createUrl('forum/forum', array('fid' => $fid, 'sort' => ':sort', 'category' => $_GET['category']));?>');
            window.location = url.replace(':sort', $(this).val());
        });
        /* Dimo大大貢獻的使用jquery替換資料
        $('.category1').click(function(){
            $.getJSON('<?php echo Yii::app()->createUrl('forum/forum', array('fid' => $fid, 'sort' => $sort, 'category' => '4'));?>', 
                function(data){
                    var ul = $('<ul></ul>');
                    for( var key in data.content )
                    {
                        ul.append($('<li></li>').text(data.content[key]));
                    }
                    $('.articles').html(ul);
                });
                
            return false;
        });
        */
    });
})(jQuery);
</script>
<?php $this->endWidget();?>
文章列表<br />
<select id="sort_list">
  <option value="create" <?php if($sort=='create') echo 'SELECTED';?>>依發表時間</option>
  <option value="update" <?php if($sort=='update') echo 'SELECTED';?>>依最新回覆</option>
  <option value="reply"  <?php if($sort=='reply') echo 'SELECTED';?>>依回應數量</option>
  <option value="viewed" <?php if($sort=='viewed') echo 'SELECTED';?>>依點閱人氣</option>
</select>
<br/>
<a class="change-category" href='<?php echo Yii::app()->createUrl('forum/forum', array('fid' => $fid, 'sort' => $sort, 'category' => 0));?>'>全部</a>
    <?php
    foreach ( $category->article_categories as $each ) : 
    ?>
        <a class="change-category" href='<?php echo Yii::app()->createUrl('forum/forum', array('fid' => $fid, 'sort' => $sort, 'category' => $each->id));?>'><?php echo $each->name;?></a>
    <?php
    endforeach;
    echo $fid . '<br />';
    ?>
    <a href="<?php echo Yii::app()->createUrl('forum/create', array('fid' => $fid));?>">發表文章</a><br/>
    <?php
    foreach($model as $each):
        echo $each->category_name->name.' '; 
    ?>
        <a href="<?php echo $each->url?>"><?php echo $each->title; ?></a>
        <?php
        echo $each->id.' ';
        echo $each->replies_count.' ';
        echo $each->viewed_times;
        if($is_master):
        ?>
        <a href="#<?php echo $each->id;?>" class="article-delete" >刪除</a>
        <br/>
    <?php
        else:
            echo '<br/>';
        endif;
    endforeach;
    ?>
時間顯示(!?)
<br/>
<?php $this->widget('Pager', array(
    'url'       => 'forum/forum',
    'pager'     => $page_status,
    'parameters'=> array('fid' => $fid, 'sort' => $sort, 'category' => $current_category)
)); ?>
<form enctype="multipart/form-data" action="<?php echo Yii::app()->createUrl('forum/delete'); ?>" method="POST" class="form-delete">
<input type="hidden" name="delete" value=""/>
<input type="hidden" name="token" value="<?php echo Yii::app()->security->getToken(); ?>" />
</form>