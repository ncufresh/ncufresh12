<?php $this->beginWidget('system.web.widgets.CClipWidget', array('id' => 'style')); ?>
<style type="text/css">
#admin-news
{
    background: black;
}

#admin-news .header
{
    height: 35px;
}

#admin-news h2
{
    display: block;
    float: left;
    margin: 5px 0 0 0;
}

#admin-news .header .pager
{
    margin: 10px 0 0 0;
}

#admin-news table
{
    background: #eef2f6;
    border-spacing: 0;
    border-radius: 10px;
    margin: 20px 0;
    padding: 10px;
    width: 100%;
}

#admin-news th
{
    background: #dce4ed;
    height: 40px;
    line-height: 40px;
    margin: 20px 0;
}

#admin-news th:first-child
{
    border-radius: 10px 0 0 10px;
    width: 60%;
}

#admin-news th:last-child
{
    border-radius: 0 10px 10px 0;
    width: 30%;
}

#admin-news td
{
    height: 20px;
    line-height: 20px;
    padding: 5px 0;
}

#admin-news td:first-child
{
    text-indent: 15px;
}

#admin-news td:not(:first-child)
{
    text-align: center;
}

#admin-news a.news-edit-link,
#admin-news a.news-delete-link
{
    display: block;
    height: 32px;
    text-indent: -100000%;
    width: 32px;
}

#admin-news a.news-edit-link:hover,
#admin-news a.news-delete-link:hover
{
    background-color: #CCFFCC;
}

#admin-news a.news-edit-link
{
    background: url('<?php echo Yii::app()->request->baseUrl; ?>/statics/images/admin_marquee_edit.png');
}

#admin-news a.news-delete-link
{
    background: url('<?php echo Yii::app()->request->baseUrl; ?>/statics/images/admin_marquee_delete.png');
}

#admin-news a.news-create-link
{
    width: 95px;
    height: 35px;
    background: #fff;
    border-radius: 10px;
    -webkit-border-radius: 10px;
    display: block;
    line-height: 35px;
    text-align: center;
    float: left;
    margin-left: 20px;
}

#admin-news a.news-back-link,
#admin-news a.news-home
{
    margin-top: 10px;
}

#admin-news a.news-back-link
{
    float: right;
}

#admin-news a.news-home
{
    float: right;
    clear: both;
}
]
</style>
<?php $this->endWidget();?>
<?php $this->beginWidget('system.web.widgets.CClipWidget', array('id' => 'script')); ?>
<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('.news-delete-link').click(function()
        {
            var link = jQuery(this).attr('href');
            jQuery.confirm({ 
                message: '確定刪除此篇文章？' ,
                confirmed: function(result)
                {
                    if ( result ) window.location = link; 
                    return false
                }
            });
            return false;
        });
    });
</script>
<?php $this->endWidget();?>
<div id="admin-news">
    <div class="header">
        <h2>管理最新消息</h2>
        <a class="news-create-link" href="<?php echo Yii::app()->createUrl('news/create') ;?>" title="新增文章">新增文章</a>
        <?php $this->widget('Pager', array(
            'url'       => 'news/admin',
            'pager'     => $page_status
        )); ?>
    </div>
    <table>
        <thead>
            <tr>
                <th>文章標題</th>
                <th>編輯</th>
                <th>移除</th>
                <th>最後修改日期</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ( $news as $entry ) : ?>
            <tr>
                <td><?php echo CHtml::link($entry->title, $entry->url);?></td>
                <td><a class="news-edit-link" href="<?php echo Yii::app()->createUrl('news/update', array('id' => $entry->id) ); ?>" title="編輯">編輯</a></td>
                <td><a class="news-delete-link" href="<?php echo Yii::app()->createUrl('news/delete', array('id' => $entry->id) ); ?>" title="刪除">刪除</a></td>
                <td><?php echo $entry->updated; ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <?php $this->widget('Pager', array(
        'url'       => 'news/admin',
        'pager'     => $page_status
    )); ?>
    <a class="news-home" href="<?php echo Yii::app()->baseUrl; ?>" title="回首頁">[回首頁]</a>
    <a class="news-back-link" href="<?php echo Yii::app()->createUrl('news/index'); ?>" title="文章列表">[文章列表]</a>
</div>
<div class="news-dialog"></div>