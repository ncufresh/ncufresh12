<?php $this->beginWidget('system.web.widgets.CClipWidget', array('id' => 'script')); ?>
<script type="text/javascript">
jQuery(document).ready(function()
{
    jQuery.extend({
        configures: 
        {
            newsAdminUrl: '<?php echo Yii::app()->createUrl('news/admin'); ?>',
        }
    });
});
</script>
<?php $this->endWidget();?>
<?php $this->beginWidget('system.web.widgets.CClipWidget', array('id' => 'script')); ?>
<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('.news-cancel-button').click(function()
        {
            var dialog = jQuery('.news-dialog');
            if(confirm('確定取消編輯此篇文章？'))
            {
                window.location = '<?php echo Yii::app()->createUrl('news/admin')?>';
            }
            return false;
        });
    });
</script>
<?php $this->endWidget();?>
<h1>編輯文章</h1>
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
<?php if ( ! empty($news->urls) ) : ?>
    <p>相關連結</p>
<?php endif; ?>
<?php foreach ( $news->urls as $url ) : ?>
    <a href="<?php echo $url->link; ?>" title="<?php echo $url->name; ?>"><?php echo $url->name; ?></a>
<?php endforeach; ?>

<?php if ( ! empty($files) ) : ?>
    <p>附加檔案</p>
<?php endif; ?>
<?php foreach ( $files as $filename => $file_url ) : ?>
    <a href="<?php echo $file_url; ?>" title="<?php echo $filename; ?>"><?php echo $filename; ?></a>
<?php endforeach; ?>
    <input name="token" value="<?php echo Yii::app()->security->getToken(); ?>" type="hidden" />
    <button type="submit">發佈</button>
    <button class="news-cancel-button">取消</button>
</form>
<div class="news-dialog"></div>