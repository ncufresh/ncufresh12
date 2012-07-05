(function($)
{
    $.extend({
        random: function(min, max)
        {
            return Math.floor(Math.random() * (max - min + 1) + min);
        }
    });

    $.fn.extend({
        marquee: function(settings)
        {
            return this.each(function()
            {
                var options = $.extend({
                    speed:                  1000,
                    duration:               500
                }, settings);
                var items = $(this).children('li');
                var animation = function()
                {
                    var position = parseInt(
                        items.css('top'),
                        10
                    ) - items.height();
                    if ( position <= -1 * items.length * items.height() )
                    {
                        position = 0;
                    }
                    items.animate({
                        top: position
                    }, options.duration);
                    timer = setTimeout(arguments.callee, options.speed);
                };
                var timer = setTimeout(animation, options.speed);

                $(this).hover(function()
                {
                    clearTimeout(timer);
                }, function()
                {
                    timer = setTimeout(animation, options.speed);
                });

				 items.css({
					top: 0
				});
            });
        },
        star: function(settings)
        {
            return this.each(function()
            {
                var options = $.extend({
                    speed:                  2000,
                    minDensity:             0.02,
                    maxDensity:             0.05,
                    minSize:                1,
                    maxSize:                3,
                    backgroundColor:        '#FFFFFF'
                }, settings);
                var width = $(document).width();
                var height = $(this).height();
                var number = $.random(
                    width * options.minDensity,
                    width * options.maxDensity
                );
                var object = $(this);
                var generator = function()
                {
                    object.children('span').remove();
                    for ( var n = 0 ; n < number ; ++n )
                    {
                        var x = $.random(0, width);
                        var y = $.random(0, height);
                        var s = $.random(options.minSize, options.maxSize);

                        $('<span></span>').css({
                            WebkitBorderRadius: s,
                            borderRadius: s,
                            background: options.backgroundColor,
                            height: s,
                            left: x,
                            position: 'absolute',
                            top: y,
                            width: s
                        }).prependTo(object);
                    }
                    setTimeout(arguments.callee, options.speed);
                };
                setTimeout(generator, 0);
            });
        }
    });

    $(document).ready(function()
        {
        if ( $('#header') ) $('#header').star();

        if ( $('#marquee') ) $('#marquee').marquee();

        $('form input').each(function()
        {
            var input = $(this);
            var label = $('label[for="' + $(this).attr('id') + '"]');
            if ( label.length )
            {
                var update = function()
                {
                    if ( input.val() != '' )
                    {
                        label.css({
                            display: 'none'
                        });
                    } else
                    {
                        label.css({
                            display: 'block'
                        });
                    }
                };
                label.css({
                    cursor: 'text',
                    display: 'block'
                }).click(function()
                {
                    input.focus();
                });
                input.focusout(function()
                {
                    update();
                })
                update();  
            } 
        });

        $("#news-url-button").click(function()
        {
            createNewsUrl();
            return false;
        });

        $(".news-cancel-button").click(function()
        {
            var yes = '<a class="dialog-yes" href="#">是</a>';
            var no = '<a class="dialog-no" href="#">否</a>';
            var dialog = $('#news-dialog');
            dialog.dialog();
            dialog.html('確定取消編輯此篇文章？<br />' + yes + no);
            $('.dialog-yes').click(function()
            {
                history.back();
                return false;
            });
            $('.dialog-no').click(function()
            {
                dialog.dialog('close');
                return false;
            });
            
            $('#news-window').dialog();
            return false;
        });

        $('.news-delete-link').click(function()
        {
            var link = $(this).attr('href');
            var yes = '<a class="dialog-yes" href="#">是</a>';
            var no = '<a class="dialog-no" href="#">否</a>';
            var dialog = $('#news-dialog');
            dialog.dialog();
            dialog.html('確定刪除此篇文章？<br />' + yes + no);
            $('.dialog-yes').click(function()
            {
                location.href = link;
                return false;
            });
            $('.dialog-no').click(function()
            {
                dialog.dialog('close');
                return false;
            });

            $('#news-window').dialog();
            return false;
        });
		
		$('.news-back-link').click(function()
		{
			history.back();
			return false;
		});
    });
})(jQuery);

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

    var link = '<div id="news-url-row-' + counter + '"><a id="news-url-link-' + counter + '" href="' + news_url + '">' + news_url_alias + '</a><a id="news-url-delete-' + counter + '" href="#">x</a></div>';
    var input = '<input id="news-url-data-' + counter + '" type="text" name="news[news_urls][]" value="' + news_url + '" /><input id="news-url-alias-data-' + counter + '" type="text" name="news[news_urls_alias][]" value="' + news_url_alias + '" />';

    $('#news-url-result').append(link);
    $('#news-url-data-warp').append(input);
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