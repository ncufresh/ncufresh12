<script type="text/javascript">
function checkFileSize(name)
{
    if ( typeof checkFileSize.counter == 'undefined' )
    {
        checkFileSize.counter = 0;
    }
    var id;
    if ( checkFileSize.counter == 0 )
    {
        id = name;
    }
    else
    {
        id = name + '_F' + checkFileSize.counter;
    }
    checkFileSize.counter++;
    var f = document.getElementById(id);
    var file_size = 0;
    if ( $.browser.msie )
    {
        var img = new Image();
        img.onload = function()
        {
            file_size = this.fileSize;
        };
        img.src = f.value;
    }
    else
    {
        file_size = f.files.item(0).size;
    }
    $('.MultiFile-label:last').append( ' (' + Math.ceil(file_size/1024) + ' KB)');
}

jQuery(document).ready(function()
{
    jQuery.extend({
        configures: 
        {
            newsAdminUrl: '<?php echo Yii::app()->createUrl('news/admin'); ?>',
        }
    });

    jQuery('#news-url-button').click(function()
    {
        createNewsUrl();
        return false;
    });

    jQuery('.news-cancel-button').click(function()
    {
        var dialog = jQuery('.news-dialog');
        dialog.text('確定取消編輯此篇文章？')
            .dialog({
                buttons: { 
                    "是": function()
                    {
                        location = $.configures.newsAdminUrl;
                    }, 
                    "否": function()
                    {
                        dialog.dialog('close');
                    }
                },
                dialogClass: 'news-dialog-warp',
            });      
        return false;
    });
});
</script>
<h1>新增文章</h1>
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
	<?php $this->widget('CMultiFileUpload', array(
		'name' => 'news_files',
		'accept' => 'doc|pdf|docx|txt|xls|xlsx',
		'duplicate' => '檔案重複',
		'denied' => '不允許的格式',
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