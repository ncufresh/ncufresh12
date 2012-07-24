<script type="text/javascript">
function mmMenuScroll(offset)
{
    if ( typeof(mmMenuScroll.mousein) == 'undefined' )
    {
        mmMenuScroll.mousein = false;
    }
    if ( typeof(mmMenuScroll.margin_top_max) == 'undefined' )
    {
        mmMenuScroll.margin_top_max = 0;
    }
    if ( typeof(mmMenuScroll.margin_top_min) == 'undefined' )
    {
        mmMenuScroll.margin_top_min = -100;
    }
    var margin_top = parseInt(jQuery('#mm-menu-items').css('margin-top'));
    if ( margin_top + offset > mmMenuScroll.margin_top_max )
    {
        margin_top = mmMenuScroll.margin_top_max;
        mmMenuScroll.mousein = false;
        jQuery('#mm-menu-items').css('margin-top', margin_top);
    }
    if ( margin_top + offset < mmMenuScroll.margin_top_min )
    {
        margin_top = mmMenuScroll.margin_top_min ;
        mmMenuScroll.mousein = false;
        jQuery('#mm-menu-items').css('margin-top', margin_top);
    }

    if ( mmMenuScroll.mousein )
    {
        jQuery('#mm-menu-items').css('margin-top', margin_top + offset);
        setTimeout('mmMenuScroll(' + offset + ')', 30);
    }
    else
    {
        return;
    }
}

jQuery(document).ready(function()
{
    jQuery('#mm-menu a').each(function(index, element)
    {
        var youtube_img_src = 'http://img.youtube.com/vi/:id/0.jpg';
        var video_img_id = jQuery(this).attr('href').substr(1);
        var video_title = jQuery('<span></span>').text(jQuery(this).text());
        var video_img = jQuery('<img />')
            .attr('src', youtube_img_src.replace(':id', video_img_id));
        jQuery(this).html(video_title).append(video_img);
    });

    jQuery('#mm-menu-items').css('height', jQuery('#mm-menu a').length * jQuery('#mm-menu a').first().css('height'));
    
    jQuery('#mm-menu a').click(function()
    {
        var url = $.configures.multimediaYoutubeUrl.replace(':v', jQuery(this).attr('href').substr(1));
        jQuery('#mm-video-frame').attr('src', url);
        return false;
    });
    jQuery('#mm-menu a').eq($.random(0, jQuery('#mm-menu a').length - 1)).click();

    var srcoll_offset = 10;
    mmMenuScroll.margin_top_max = 0;
    mmMenuScroll.margin_top_min = parseInt(jQuery('#mm-menu').css('height')) - parseInt(jQuery('#mm-menu-items').css('height'));

    jQuery('.mm-menu-up').mouseenter(function()
    {
        mmMenuScroll.mousein = true;
        mmMenuScroll(srcoll_offset);
    }).mouseleave(function()
    {
        mmMenuScroll.mousein = false;
    });

    jQuery('.mm-menu-down').mouseenter(function()
    {
        mmMenuScroll.mousein = true;
        mmMenuScroll(-1 * srcoll_offset);
    }).mouseleave(function()
    {
        mmMenuScroll.mousein = false;
    });
});
</script>
<div id="mm-container">
    <div id="mm-sidebar">
        <div id="mm-menu">
            <button class="mm-menu-up">UP</button>
            <button class="mm-menu-down">DOWN</button>
            <div id="mm-menu-items">
                <a href="#3Aoy5hodu1Y" title="Inception">TDKR</a>
                <a href="#66TuSJo4dZM" title="Inception">Inception</a>
                <a href="#ZRmWLqrJkz4" title="Resident Evil 5">Resident Evil 5</a>
                <a href="#FNQowwwwYa0" title="Iron Man 2">Iron Man 2</a>
                <a href="#E7a5LcTckfg" title="Incredible Hulk">Incredible Hulk</a>
                <a href="#YpRyJBoEiMg" title="Grenade- Bruno">Grenade- Bruno</a>
                <a href="#BSLPH9d-jsI" title="Skyrim">Skyrim</a>
                <a href="#tY9DnBNJFTI" title="The Avengers">The Avengers</a>
                <a href="#JOddp-nlNvQ" title="Thor">Thor</a>
            </div>
        </div>
        <div id="mm-player">我是投影機</div>
    </div>
    <div id="mm-content">
        <div id="mm-video">
            <div class="loading"></div>
            <iframe id="mm-video-frame" name="videoframe" width="100%" height="100%" src="about:blank" frameborder="0" allowfullscreen></iframe>    
        </div>
        <div id="mm-introduction">
            <div class="text">我是影片介紹</div>
            <div class="pic">我是圖片</div>
        </div>
    </div>
</div>