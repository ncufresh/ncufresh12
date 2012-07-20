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

jQuery(document).ready(function()
{
    jQuery('.news-back-link').click(function()
    {
        window.location = $.configures.newsIndexUrl;
        return false;
    });
});
</script>
<h1><?php echo $news->title; ?></h1>
<p>作者:<?php echo $news->author->username; ?></p>
<p>時間:<?php echo $news->updated; ?></p>
<?php if ( Yii::app()->user->getIsAdmin() ) : ?>
<a href="<?php echo Yii::app()->createUrl('news/update', array('id' => $news->id)); ?>" title="編輯文章">編輯文章</a>
<?php endif;?>
<p><?php echo $news->content; ?></p>


<?php if ( ! empty($news->urls) ) : ?>
<p>相關連結</p>
<?php endif; ?>
<?php foreach ( $news->urls as $url ) : ?>
    <a href="<?php echo $url->link; ?>" title="<?php echo $url->name; ?>"><?php echo $url->name; ?></a>
<?php endforeach; ?>

<?php if( !empty($files) ):?>
<p>附加檔案</p>
<?php endif; ?>
<?php foreach ( $files as $filename => $file_url ) : ?>
    <a href="<?php echo $file_url; ?>" title="<?php echo $filename; ?>"><?php echo $filename; ?></a>
<?php endforeach; ?>
<a class="news-back-link" href="#" title="返回">返回</a>
