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
            var url = decodeURIComponent('<?php echo Yii::app()->createUrl('forum/forum', array('fid' => $fid, 'sort' => ':sort', 'category' => isset($_GET['category'])?:0));?>');
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
<div id="forum-forum-top">
    <a id="forum-forum-backlink"href="#">回上一頁</a>
</div>
<div id="forum-forum-top2">
    
    <?php $this->widget('Pager', array(
        'url'       => 'forum/forum',
        'pager'     => $page_status,
        'parameters'=> array('fid' => $fid, 'sort' => $sort, 'category_id' => $current_category)
    )); 
    ?>
    <select id="sort_list">
<?php if ( $sort == 'create' ) : ?>
      <option value="create" selected="selected">依發表時間</option>
<?php else : ?>
      <option value="create">依發表時間</option>
<?php endif; ?>
<?php if ( $sort == 'update' ) : ?>
      <option value="update" selected="selected">依最新回覆</option>
<?php else : ?>
      <option value="update">依最新回覆</option>
<?php endif; ?>
<?php if ( $sort == 'reply' ) : ?>
      <option value="reply" selected="selected">依回應數量</option>
<?php else : ?>
      <option value="reply">依回應數量</option>
<?php endif; ?>
<?php if ( $sort == 'viewed' ) : ?>
      <option value="viewed" selected="selected">依點閱人氣</option>
<?php else : ?>
      <option value="viewed">依點閱人氣</option>
<?php endif; ?>
    </select>
</div>
<div id="forum-forum-body">
    <div id="create-article">
        <a href="<?php echo Yii::app()->createUrl('forum/create', array('fid' => $fid));?>">發表文章</a>
    </div>
    <div class="category-lists">
    <ul id="labels">
        <li class="un-selected">
            <a class="change-category" href='<?php echo Yii::app()->createUrl('forum/forum', array('fid' => $fid, 'sort' => $sort, 'category_id' => 0));?>'>全部</a>
        </li>
        <?php
        foreach ( $category->article_categories as $each ) : 
        ?>
            <li class="un-selected">
                <a class="change-category" href='<?php echo Yii::app()->createUrl('forum/forum', array('fid' => $fid, 'sort' => $sort, 'category' => $each->id));?>'><?php echo $each->name;?></a>
            </li>
        <?php
        endforeach;
        ?>
    </ul>
    </div>
    <div >
    <table id="body-table" cellpadding="0" cellspacing="0">
        <thead>
            <tr class="table-title">
                <th class="head"></th>
                <th class="category">分類</th>
                <th class="title">標題</th>
                <th class="author">作者</th>
                <th class="reply">回應</th>
                <th class="popularity">人氣</th>
                <th class="time">發表時間</th>
                <th class="tail"></th>
            </tr>
        </thead>
        
        <tbody>
            <?php
            foreach($model as $each):
                
            ?>
            <tr class="table-body">
                <td class="head"></td>
                <td class="category"><?php echo $each->category_name->name.' '; ?></td>
                <td class="title"><a href="<?php echo $each->url?>"><?php echo $each->title; ?></a></td>
                <td class="author"></td>
                <td class="reply"><span><?php echo $each->replies_count.' ';?></span></td>
                <td class="popularity"><span><?php echo $each->viewed;?></span></td>
                <td class="time"></td>
            </tr>
            <?php
            endforeach;
            ?>
        </tbody>
        <tfoot class="table-foot">
            <tr>
                <td class="head"></td>
                <td class="category"></td>
                <td class="title"></td>
                <td class="author"></td>
                <td class="reply"></td>
                <td class="popularity"></td>
                <td class="time"></td>
                <td class="tail"></td>
            </tr>
        </tfoot>
    </table>
    </div>
</div>
<div id="forum-forum-footer">
    <?php $this->widget('Pager', array(
        'url'       => 'forum/forum',
        'pager'     => $page_status,
        'parameters'=> array('fid' => $fid, 'sort' => $sort, 'category' => $current_category)
    )); 
    ?>
</div>
<br/>

    
    
    <?php
    foreach($model as $each):
        echo $each->category_name->name.' '; 
    ?>
        
        <a href="<?php echo $each->url?>"><?php echo $each->title; ?></a>
        <?php
        echo $each->id.' ';
        echo $each->replies_count.' ';
        echo $each->viewed;
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