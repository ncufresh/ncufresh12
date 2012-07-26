<?php $this->beginWidget('system.web.widgets.CClipWidget', array('id' => 'style')); ?>
<style type="text/css">
.news-create #form-news-content
{
    width: 80%;
    height: 250px;
    resize: none;
}
</style>
<?php $this->endWidget();?>
<?php $this->beginWidget('system.web.widgets.CClipWidget', array('id' => 'script')); ?>
<script type="text/javascript" src="<?php echo Yii::app()->baseUrl . '/statics/scripts/jquery.multifile.js'; ?>"></script>
<script type="text/javascript">
    function createNewsUrl()
    {
        if ( typeof createNewsUrl.counter == 'undefined' )
        {
            createNewsUrl.counter = 0;
        }

        var counter = createNewsUrl.counter;
        var news_url = $('#news-url-input').val();
        var news_url_alias = $('#news-url-alias-input').val();

        if ( news_url=='' || news_url_alias == '' ) return false;

        var row = $('<div></div>')
                    .attr('id', 'news-url-row-' + counter);
        var link = $('<a></a>')
                    .attr('id', 'news-url-link-' + counter )
                    .attr('href', news_url)
                    .append(news_url_alias);
        var delete_link = $('<a></a>')
                    .attr('id', 'news-url-delete-' + counter )
                    .attr('href', '#')
                    .append('x');
        row.append(delete_link).append(link)

        var url_input = $('<input />')
            .attr( 'id', 'news-url-data-' + counter )
            .attr( 'type', 'text')
            .attr( 'name', 'news[news_urls][]')
            .attr( 'value', news_url );
        var url_alias_input = $('<input />')
            .attr( 'id', 'news-url-alias-data-' + counter )
            .attr( 'type', 'text')
            .attr( 'name', 'news[news_urls_alias][]')
            .attr( 'value', news_url_alias );
        $('#news-url-result').append(row);
        $('#news-url-data-warp').append(url_input).append(url_alias_input);
        $('#news-url-delete-' + counter).click(function()
        {
            deleteNewsUrl(counter);
            return false;
        });
        $('#news-url-input').val('');
        $('#news-url-alias-input').val('');
        createNewsUrl.counter++;
    }

    function deleteNewsUrl(id)
    {
        $('#news-url-row-' + id).remove();
        $('#news-url-data-' + id).remove();
        $('#news-url-alias-data-' + id).remove();
        return false;
    }

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
        jQuery('.news-cancel-button').click(function()
        {
            var dialog = jQuery('.news-dialog');
            if(confirm('確定取消編輯此篇文章？'))
            {
                window.location = '<?php echo Yii::app()->createUrl('news/admin')?>';
            }
            return false;
        });

        jQuery('#news-url-button').click(function()
        {
            createNewsUrl();
            return false;
        });

        $(function(){
            if( $('#news-files').length != 0 ){
                $('#news-files').MultiFile({
                    accept:'doc|pdf|docx|txt|xls|xlsx',
                    STRING: {
                        remove:'x',
                        denied:'不允許的格式',
                        duplicate:'檔案重複'
                    },
                    afterFileSelect:function(e, v, m)
                    { 
                        checkFileSize("news-files");
                    },
                });
            }
        });
    });
</script>
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