<style type="text/css">
.news-create #form-news-content
{
    width: 80%;
    height: 250px;
    resize: none;
}
</style>
<?php $this->beginWidget('system.web.widgets.CClipWidget', array('id' => 'script')); ?>
<script type="text/javascript" src="<?php echo Yii::app()->baseUrl . '/statics/scripts/jquery.multifile.js'; ?>"></script>
<?php $this->endWidget();?>
<div class="news-create">
    <h2 class="news-title">新增文章</h2>
    <form enctype="multipart/form-data" action="<?php echo Yii::app()->createUrl('news/create')?>" method="POST" class="MultiFile-intercepted">
        <dl>
            <dt>
                <label for="form-news-title">標題</label>
            </dt>
            <dd>
                <input id="form-news-title" type="text" name="news[title]" />
            </dd>
        </dl>
        <dl>
            <dt>
                <label for="form-news-content">內容</label>
            </dt>
            <dd>
                <textarea id="form-news-content" name="news[content]" cols="30" rows="10"></textarea>
            </dd>
        </dl>
        <p>附加連結與檔案</p>
        <div id="news-url-warp">連結名稱:<input type="text" id="news-url-alias-input"/>URL:<input type="text" id="news-url-input"/><button id="news-url-button">v</button>
            <div id="news-url-data-warp" style="display:none">
            </div>
        </div>
        <div id="news-url-result">
        </div>
        <input id="news-files" type="file" name="news_files[]" />
        <button class="news-button" type="submit">發佈</button>
        <button class="news-cancel-button news-button">取消</button>
        <input name="token" value="<?php echo Yii::app()->security->getToken(); ?>" type="hidden" />
    </form>
</div>
<div class="news-dialog"></div>