(function($)
{
    $.extend({
        random: function(min, max)
        {
            return Math.floor(Math.random() * (max - min + 1) + min);
        },
        cookie: function(key, value, settings) {
            var options = $.extend({
            }, settings);

            if (
                arguments.length > 1
             && (
                 ! /Object/.test(Object.prototype.toString.call(value))
              || value === null
              || value === undefined
                )
            ) {
                if ( value === null || value === undefined ) options.expires = -1;

                if ( typeof options.expires === 'number' )
                {
                    var days = options.expires;
                    var t = options.expires = new Date();
                    t.setDate(t.getDate() + days);
                }

                value = String(value);

                return (document.cookie = [
                    encodeURIComponent(key),
                    '=',
                    options.raw
                  ? value
                  : encodeURIComponent(value),
                    options.expires
                  ? '; expires=' + options.expires.toUTCString()
                  : '',
                    options.path
                  ? '; path=' + options.path
                  : '',
                    options.domain
                  ? '; domain=' + options.domain
                  : '',
                    options.secure
                  ? '; secure'
                  : ''
                ].join(''));
            }

            var decode = options.raw ? function(raw)
            {
                return raw;
            } : decodeURIComponent;

            var pairs = document.cookie.split('; ');

            options = value || {};

            for ( var i = 0, pair ; pair = pairs[i] && pairs[i].split('=') ; ++i )
            {
                if ( decode(pair[0]) === key ) return decode(pair[1] || '');
            }

            return null;
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
        },
        chat: function(settings)
        {
            var options = $.extend({
                speed:                  500,
                chatListHeight:         200,
                chatListId:             'chatlist',
                chatDialogClass:        'chat-dialog',
                unknownIcon:            'unknown.png'
            }, settings);
            var list = $('<div></div>')
                .attr('id', options.chatListId)
                .insertBefore($(this));
            var openChatList = function()
            {
                list.animate({
                    height: options.chatListHeight
                }, options.speed);
                $.getJSON(
                    $.configures.chatFriendsListUrl,
                    function(response)
                    {
                        for ( var key in response )
                        {
                            var data = response[key];
                            var entry = $('<div></div>')
                                .attr('chat:id', data.id)
                                .addClass('friend-list-entry')
                                .click(function()
                                {
                                    openChatDialog($(this).attr('chat:id'));
                                })
                                .appendTo(list);
                            var icon = $('<img></img>')
                                .attr(
                                    'src',
                                    data.icon
                                  ? data.icon
                                  : options.unknownIcon
                                )
                                .appendTo(entry);
                            var name = $('<p>')
                                .text(data.name)
                                .appendTo(entry);
                        }
                    }
                );
            }
            var openChatDialog = function(id)
            {
                var dialog;
                var left = list.position().left
                         + list.outerWidth(true)
                         - list.innerWidth();
                var url = decodeURIComponent(
                        $.configures.chatReceiveMessageUrl
                    )
                    .replace(':id', id);
                $('.' + options.chatDialogClass).each(function(index)
                {
                    if ( $(this).attr('chat:id') == id ) dialog = $(this);
                    $(this).css({
                        left: left - $(this).outerWidth(true) * (index + 1)
                    });
                });
                if ( ! dialog )
                {
                    dialog = $('<div></div>')
                        .attr('chat:id', id)
                        .addClass(options.chatDialogClass)
                        .insertBefore(list);
                    dialog.css({
                        left: left - dialog.outerWidth(true) * $('.' + options.chatDialogClass).length
                    });
                }
                return dialog;
            };  
            (function()
            {
                var url = decodeURIComponent($.configures.chatRetrieveMessageUrl);
                $.getJSON(url, function(response)
                {
                    for ( var key in response )
                    {
                        var data = response[key];
                        var dialog = openChatDialog(data.id);
                        dialog.html(dialog.html() + '<br />' + data.sender + ':' + data.message);
                    }
                });
                setTimeout(arguments.callee, 3000);
                return true;
            })();
            return this.each(function()
            {
                $(this).click(function()
                {
                    openChatList();
                    $(this).fadeOut();
                    return true;
                });
            });
        }
    });

    $(document).ready(function()
    {
        if ( $('#header') ) $('#header').star();

        if ( $('#marquee') ) $('#marquee').marquee();

        if ( $('#chat') ) $('#chat').chat();

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
		
		$('#mm-menu a').each(function(index, element){
			$(this).html('<span>'+$(this).text()+'</span>');
			$(this).append('<img src="http://img.youtube.com/vi/' + $(this).attr('href').substr(1) + '/0.jpg" />')
		});
		
		$('#mm-menu-items').css('height', $('#mm-menu a').length * 150);
		
		$('#mm-menu a').click(function(){
			$('#mm-video-frame').attr('src', '/ncufresh12/multimedia/youtube.html?video_id=' + $(this).attr('href').substr(1));
			return false;
		});
		
		mmMenuScroll.margin_top_max = 0;
		mmMenuScroll.margin_top_min = parseInt($('#mm-menu').css('height')) - parseInt($('#mm-menu-items').css('height'));
		$('.mm-menu-up').mouseenter(function(){
			mmMenuScroll.mousein = true;
			mmMenuScroll(+10);
		}).mouseleave(function(){
			mmMenuScroll.mousein = false;
		});	
		
		$('.mm-menu-down').mouseenter(function(){
			mmMenuScroll.mousein = true;
			mmMenuScroll(-10);
		}).mouseleave(function(){
			mmMenuScroll.mousein = false;
		});
    });
})(jQuery);

function mmMenuScroll(offset)
{
	if( typeof(mmMenuScroll.mousein) == 'undefined' )
		mmMenuScroll.mousein = false;
	if( typeof(mmMenuScroll.margin_top_max) == 'undefined' )
		mmMenuScroll.margin_top_max = 0;
	if( typeof(mmMenuScroll.margin_top_min) == 'undefined' )
		mmMenuScroll.margin_top_min = -100;
	var margin_top = parseInt($('#mm-menu-items').css('margin-top'));
	if( margin_top + offset > mmMenuScroll.margin_top_max )
	{
		margin_top = mmMenuScroll.margin_top_max;
		mmMenuScroll.mousein = false;
		$('#mm-menu-items').css('margin-top', margin_top);
	}
	if( margin_top + offset < mmMenuScroll.margin_top_min )
	{
		margin_top = mmMenuScroll.margin_top_min ;
		mmMenuScroll.mousein = false;
		$('#mm-menu-items').css('margin-top', margin_top);
	}

	if( mmMenuScroll.mousein )
	{
		$('#mm-menu-items').css('margin-top', margin_top + offset);
		setTimeout( "mmMenuScroll("+offset+")", 30 );
	}
	else
		return;
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