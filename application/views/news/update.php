<style type="text/css">
input, textarea
{
    margin: 0;
    outline: 0;
}
#news-update #form-news-content
{
    height: 250px;
    resize: none;
}

input.MultiFile-applied
{
    height: 22px;
    margin: 5px 0;
}

#news-url-button
{
    background: #fff url('<?php echo Yii::app()->baseUrl;?>/statics/images/news_add_url_button.png') no-repeat;
    width: 20px;
    height: 20px;
    text-indent: -10000%;
    padding: 0;
    margin: 5px 0;
}

#news-url-button:hover
{
    background-color: #ffffcc;
}

.news-button
{
    width: 60px;
    height: 30px;
    line-height: 30px;
    text-align: center;
    margin: 5px;
    padding: 0;
}

label.appendix
{
    color: #666666;
    font-size: 14pt;
    display: block;
    height: 19px;
    padding: 15px 0;
}

.news-commit-button
{
    margin-left: 600px;
    color: red;
}

.news-cancel-button
{
    color: blue;
}

div#news-url-result, div.MultiFile-list
{
    background-color: #ffffcc;
    -webkit-border-radius: 5px;
    border-radius: 5px;
}

div.news-url-row, div.MultiFile-label
{
    width: auto;
    height: 30px;
    line-height: 30px;
    margin: 10px 0 0 10px;
}

a.news-url-link,
a.news-url-delete,
a.MultiFile-remove
{
    display: block;
    float: left;
}

a.news-url-link
{

}
</style>
<?php $this->beginWidget('system.web.widgets.CClipWidget', array('id' => 'script')); ?>
<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('.news-cancel-button').click(function()
        {
            jQuery.confirm({
                message: '確定取消編輯此篇文章？',
                confirmed: function(result)
                {
                    if ( result ) window.location = '<?php echo Yii::app()->createUrl('news/admin')?>';
                    return false;
                }
            });
            return false;
        });
    });
</script>
<?php $this->endWidget();?>
<div id="news-update">
    <h2>編輯文章</h2>
    <form enctype="multipart/form-data" action="<?php echo Yii::app()->createUrl('news/update', array('id' => $news->id) ); ?>" method="POST" class="MultiFile-intercepted">
        <dl>
            <dt>
                <label for="form-news-title">標題</label>
            </dt>
            <dd>
                <input id="form-news-title" type="text" name="news[title]" value="<?php echo $news->title; ?>"/>
            </dd>
        </dl>
        <dl>
            <dt>
                <label for="form-news-content">內容</label>
            </dt>
            <dd>
                <textarea id="form-news-content" name="news[content]"><?php echo $news->content; ?></textarea>
            </dd>
        </dl>
        <?php if ( ! empty($news->urls) || ! empty($files) ) : ?>
            <label class="appendix" >附加連結與檔案</label>
            <div id="news-url-result">
                <?php foreach ( $news->urls as $url ) : ?>
                    <div class="news-url-row">
                        <a href="<?php echo $url->link; ?>" title="<?php echo $url->name; ?>"><?php echo $url->name; ?></a>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="MultiFile-list">
                <?php foreach ( $files as $filename => $file_url ) : ?>
                    <div class="MultiFile-label">
                        <a href="<?php echo $file_url; ?>" title="<?php echo $filename; ?>"><?php echo $filename; ?></a>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <input name="token" value="<?php echo Yii::app()->security->getToken(); ?>" type="hidden" />
        <button class="news-commit-button news-button" type="submit">發佈</button>
        <button class="news-cancel-button news-button">取消</button>
    </form>
</div>