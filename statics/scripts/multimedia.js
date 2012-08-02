(function($)
{
    var mmMenuScroll = function(offset)
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
        var margin_top = parseInt($('#multimedia .items').css('margin-top'));
        if ( margin_top + offset > mmMenuScroll.margin_top_max )
        {
            margin_top = mmMenuScroll.margin_top_max;
            mmMenuScroll.mousein = false;
            $('#multimedia .items').css('margin-top', margin_top);
        }
        if ( margin_top + offset < mmMenuScroll.margin_top_min )
        {
            margin_top = mmMenuScroll.margin_top_min ;
            mmMenuScroll.mousein = false;
            $('#multimedia .items').css('margin-top', margin_top);
        }

        if ( mmMenuScroll.mousein )
        {
            $('#multimedia .items').css('margin-top', margin_top + offset);
            setTimeout(function()
            {
                mmMenuScroll(offset);
            }, 30);
        }
        else
        {
            return;
        }
    };

    $(document).ready(function()
    {
        $('#multimedia .menu a').each(function(index, element)
        {
            var youtube_img_src = 'http://img.youtube.com/vi/:id/0.jpg';
            var video_img_id = $(this).attr('href').substr(1);
            var video_title = $('<span></span>').text($(this).text());
            var video_img = $('<img />')
                .attr('src', youtube_img_src.replace(':id', video_img_id));
            $(this).html(video_title).append(video_img);
        });

        $('#multimedia .items').css('height', $('#multimedia .menu a').length * $('#multimedia .menu a').first().css('height'));
        
        $('#multimedia .menu a').click(function()
        {
            var url = $.configures.multimediaYoutubeUrl.replace(':v', $(this).attr('href').substr(1));
            $('#multimedia-frame').attr('src', url);
            return false;
        });
        $('#multimedia .menu a').eq($.random(0, $('#multimedia .menu a').length - 1)).click();

        var srcoll_offset = 10;
        mmMenuScroll.margin_top_max = 0;
        mmMenuScroll.margin_top_min = parseInt($('#multimedia .menu').css('height')) - parseInt($('#multimedia .items').css('height'));

        $('#multimedia .up').mouseenter(function()
        {
            mmMenuScroll.mousein = true;
            mmMenuScroll(srcoll_offset);
        }).mouseleave(function()
        {
            mmMenuScroll.mousein = false;
        });

        $('#multimedia .down').mouseenter(function()
        {
            mmMenuScroll.mousein = true;
            mmMenuScroll(-1 * srcoll_offset);
        }).mouseleave(function()
        {
            mmMenuScroll.mousein = false;
        });
    });
})(jQuery);