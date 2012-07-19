<h2>新增文章</h2>
<form enctype="multipart/form-data" action="<?php echo Yii::app()->createUrl('news/create')?>" method="POST" class="MultiFile-intercepted">
標題<input type="text" name="news[title]" /><br />
內容<textarea name="news[content]" id="news-form-content" cols="30" rows="10"></textarea><br />
<span>附加連結與檔案</span>
<div id="news-url-warp">連結名稱:<input type="text" id="news-url-alias-input"/>URL:<input type="text" id="news-url-input"/><button id="news-url-button">v</button>
    <div id="news-url-data-warp" style="display:none">
    </div>
</div>
<div id="news-url-result"></div>

<?php $this->widget('CMultiFileUpload', array(
    'name' => 'news_files',
    'accept' => 'doc|pdf|docx|txt|xls|xlsx',
    'duplicate' => '檔案重複', // useful, i think
    'denied' => '不允許的格式', // useful, i think
    'remove' => 'x',
      'options'=>array(
         'afterFileSelect'=>'function(e, v, m)
         { 
            checkFileSize("news_files");
         }',
      ),
)); ?>
<button type="submit">發佈</button>
<button class="news-cancel-button">取消</button>
<input name="token" value="<?php echo Yii::app()->security->getToken(); ?>" type="hidden" />
</form>
<?php foreach ( $errors as $key => $error ) : ?>
    <b><?php echo $key . ':' . $error[0]; ?></b><br />
<?php endforeach; ?>
<div class="news-dialog"></div>