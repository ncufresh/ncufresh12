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
	
    jQuery('.news-back-link').click(function()
    {
        window.location = $.configures.newsIndexUrl;
        return false;
    });
	
    jQuery('.news-delete-link').click(function()
    {
        var link = jQuery(this).attr('href');
        var dialog = $('.news-dialog');
        dialog.text('確定刪除此篇文章？')
            .dialog({
                buttons: { 
                    "是": function()
                    {
                        location = link;
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

    jQuery('.news-back-link').click(function()
    {
        window.location = $.configures.newsIndexUrl;
        return false;
    });
	    
	jQuery('.news-back-link').click(function()
    {
        window.location = $.configures.newsIndexUrl;
        return false;
    });
    
    $(function(){
        if($('#news_files').length!=0){
            $('#news_files').MultiFile({
                accept:'doc|pdf|docx|txt|xls|xlsx',
                STRING: {
                    remove:'x',
                    denied:'不允許的格式',
                    duplicate:'檔案重複'
                },
                afterFileSelect:function(e, v, m)
                { 
                    checkFileSize("news_files");
                },
            });
        }
    });
});