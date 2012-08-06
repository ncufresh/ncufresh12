<?php
    if( $fid == 1 || $fid == 2)
    {
        $back_url = Yii::app()->createUrl('forum/index');
    }
    else
    {
        $back_url = Yii::app()->createUrl('forum/forumlist');
    }
?>
<div id="forum-forum-top">
    <a id="forum-forum-backlink" href="<?php echo $back_url; ?>">回上一頁</a>
</div>
<div id="forum-forum-top2">
    
    <?php $this->widget('Pager', array(
        'url'       => 'forum/forum',
        'pager'     => $page_status,
        'parameters'=> array('fid' => $fid, 'sort' => $sort, 'category' => $current_category)
    )); 
    ?>
    <select class="sort-list">
<?php if ( $sort == 'create' ) : ?>
      <option value="create" selected="selected">依發表時間</option>
<?php else : ?>
      <option value="create">依發表時間</option>
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
<?php
/*綜合討論 + 管理學院*/
if ( $fid == 1 || $fid == 18 || $fid == 19 || $fid == 20 || $fid == 21)
{
    $forum_color = '';
}
/*社團討論 + 文學院*/
else if ( $fid == 2 || $fid == 3 || $fid == 4 || $fid == 5 )
{
    $forum_color = 'purple';
}
/*工學院*/
else if ( $fid == 6 || $fid == 7 || $fid == 8 )
{
    $forum_color = 'green';
}
/*資電院*/
else if ( $fid == 9 || $fid == 10 || $fid == 11 )
{
    $forum_color = 'yellow';
}
/*理學院*/
else if ( $fid == 12 || $fid == 13 || $fid == 14 || $fid == 15 || $fid == 16 || $fid == 17 )
{
    $forum_color = 'blue';
}
/*地科學院*/
else if ( $fid == 22 || $fid == 23 )
{
    $forum_color = 'orange';
}
?>
<div id="forum-forum-body" class="<?php echo $forum_color; ?>">
    <div id="create-article">
        <a href="<?php echo Yii::app()->createUrl('forum/create', array('fid' => $fid));?>">發表文章</a>
    </div>
    <div class="category-lists">
    <ul id="labels">
        <li class="<?php echo ( $current_category == 0 ) ? 'selected' : 'un-selected'; ?>">
            <a class="change-category" href='<?php echo Yii::app()->createUrl('forum/forum', array('fid' => $fid, 'sort' => $sort, 'category' => 0));?>'>全部</a>
        </li>
        <?php
        foreach ( $category->article_categories as $each ) : 
        ?>
            <li class="<?php echo ( $current_category == $each->id ) ? 'selected' : 'un-selected'; ?>">
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
            if ( $current_page == 1 ):
            foreach($sticky_articles as $each):
            ?>
            <tr class="table-body">
                <td class="head"></td>
                <td class="category">置頂</td>
                <td class="title">
                    <a href="<?php echo $each->url?>">
                        <?php
                        if(mb_strlen($each->title) > mb_strlen(mb_substr($each->title,0,10))) 
                        {
                            echo mb_substr($each->title,0,10).'...'; 
                        }
                        else
                        {
                            echo $each->title;
                        }?>
                    </a>
                    <?php if( $category->getIsMaster() ): ?>
                    <a href="#<?php echo $each->id;?>" class="article-delete" >刪除</a>
                    <form enctype="multipart/form-data" action="<?php echo Yii::app()->createUrl('forum/delete'); ?>" method="POST" class="form-delete">
                    <input class="delete-input" type="hidden" name="delete" value=""/>
                    <input type="hidden" name="token" value="<?php echo Yii::app()->security->getToken(); ?>" />
                    </form>
                    <?php endif; ?>
                </td>
                <td class="author"><?php echo User::model()->findByPK($each->author_id)->profile->nickname; ?></td>
                <td class="reply"><span><?php echo $each->replies_count;?></span></td>
                <td class="popularity"><span><?php echo $each->viewed;?></span></td>
                <td class="time"><?php echo $each->created; ?></td>
            </tr>
            <?php
            endforeach;
            endif;
            ?>
            <?php
            foreach($model as $each):
            ?>
            <tr class="table-body">
                <td class="head"></td>
                <td class="category"><?php echo $each->category_name->name.' '; ?></td>
                <td class="title">
                    <a href="<?php echo $each->url?>">
                        <?php
                        if(mb_strlen($each->title) > mb_strlen(mb_substr($each->title,0,10))) 
                        {
                            echo mb_substr($each->title,0,10).'...';
                        }
                        else
                        {
                            echo $each->title;
                        }?>
                    </a>
                    <?php if( $category->getIsMaster() ): ?>
                    <a href="#<?php echo $each->id;?>" class="article-delete" >刪除</a>
                    <form enctype="multipart/form-data" action="<?php echo Yii::app()->createUrl('forum/delete'); ?>" method="POST" class="form-delete">
                    <input class="delete-input" type="hidden" name="delete" value=""/>
                    <input type="hidden" name="token" value="<?php echo Yii::app()->security->getToken(); ?>" />
                    </form>
                    <?php endif; ?>
                </td>
                <td class="author"><?php echo User::model()->findByPK($each->author_id)->profile->nickname; ?></td>
                <td class="reply"><span><?php echo $each->replies_count;?></span></td>
                <td class="popularity"><span><?php echo $each->viewed;?></span></td>
                <td class="time"><?php echo $each->created; ?></td>
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