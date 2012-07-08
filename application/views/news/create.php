<?php Yii::app()->clientScript->registerCoreScript('jquery.ui'); ?>
<h2>新增文章</h2>
<form enctype="multipart/form-data" action="<?php echo Yii::app()->createUrl('news/create')?>" method="post" class="MultiFile-intercepted">
標題<input type="text" name="news[title]" /><br />
內容<textarea name="news[content]" id="news-form-content" cols="30" rows="10"></textarea><br />
<span>附加連結與檔案</span>
<div id="news-url-warp">連結名稱:<input type="text" id="news-url-alias-input"/>URL:<input type="text" id="news-url-input"/><input id="news-url-button" type="button" value="v"/>
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
         'afterFileSelect'=>'function(e, v, m){ 
			checkFileSize("news_files");
		 }',
      ),
)); ?>
<input type="submit" value="發佈" />
<input class="news-cancel-button" type="button" value="取消" />
<input name="token" value="<?php echo Yii::app()->security->getToekn(); ?>" type="hidden" />
</form>
<div class="news-dialog"></div>