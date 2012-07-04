<h2>新增文章</h2>
<?php echo CHtml::form('','post',array('enctype'=>'multipart/form-data'));?>
標題<input type="text" name="news[title]" /><br />
內容<textarea name="news[content]" id="news-form-content" cols="30" rows="10"></textarea><br />
<input name="token" value="<?php echo Yii::app()->security->getToekn(); ?>" type="hidden" />
連結名稱:<input type="text" />URL:<input type="text" /><input type="submit" value="v" />
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
<input type="submit" />