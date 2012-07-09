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
        },
        integer: function(value)
        {
            return parseInt(value, 10);
        }
    });

    $.fn.extend({
        highlight: function(color, duration) {
            var original = this.css('background-color');
            this.stop().css("background-color", color || '#FFFF9C').animate({
                backgroundColor: original
            }, duration || 1000);
        },
        scrollable: function(settings)
        {
            return this.each(function()
            {
                var active = false;
                var inside = false;
                var options = $.extend({
                    scrollableClass:        false,
                    fadeInDuration:         'slow',
                    fadeOutDuration:        'slow',
                }, settings);
                var scrollContainer = $('<div></div>')
                    .addClass('scroll-container')
                    .css({
                        height: $(this).outerHeight(),
                        width: $(this).outerWidth()
                    })
                    .mouseenter(function()
                    {
                        scrollBar
                            .stop(true, true)
                            .fadeIn(options.fadeInDuration);
                        inside = true;
                    })
                    .mouseleave(function()
                    {
                        if ( ! active )
                        {
                            scrollBar
                                .stop(true, true)
                                .fadeOut(options.fadeInDuration);
                        }
                        inside = false;
                    })
                    .insertAfter($(this));
                var scrollArea = $('<div></div>')
                    .addClass('scroll-area')
                    .insertBefore($(this))
                    .wrapInner($(this))
                    .appendTo(scrollContainer);
                var scrollBar = $('<div></div>')
                    .addClass('scroll-bar')
                    .insertAfter(scrollArea);
                var scrollTrack = $('<div></div>')
                    .addClass('scroll-track')
                    .appendTo(scrollBar);
                var scrollDragable = $('<div></div>')
                    .addClass('scroll-dragable')
                    .css({
                        height: scrollArea.height() - scrollContainer.height()
                    })
                    .mousedown(function(event)
                    {
                        var y = event.screenY;
                        var scroll = $(this);
                        var top = $.integer(scroll.css('top'));
                        var stop = function()
                        {
                            $('html')
                                .unbind('mouseup', stop)
                                .unbind('mousemove', update);
                            if ( ! inside )
                            {
                                scrollBar.stop(true, true)
                                    .fadeOut(options.fadeInDuration);
                            }
                            active = false;
                        };
                        var update = function(event)
                        {
                            var maximun = (
                                scrollContainer.height()
                              - scroll.height()
                              );
                            var position = top + event.screenY - y;
                            var scale = (
                                    scrollArea.height()
                                  - scrollContainer.height()
                                ) / (
                                    scrollContainer.height()
                                  - scroll.height()
                                ) * -1;
                            if ( position <= 0 ) position = 0;
                            if ( position >= maximun ) position = maximun;
                            scroll.css({
                                top: position
                            });
                            scrollArea.css({
                                top: position * scale
                            });
                        };
                        $('html')
                            .bind('mouseup', stop)
                            .bind('mouseleave', stop)
                            .bind('mousemove', update);
                        active = true;
                        return false;
                    })
                    .appendTo(scrollTrack);
                if ( options.scrollableClass )
                {
                    scrollContainer.addClass(options.scrollableClass);
                }
            });
        },
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
                    var position = $.integer(items.css('top')) - items.height();
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
                chatDisplayClass:       'chat-display',
                chatInputClass:         'chat-input',
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
                var display;
                var char_input;
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
                    display = $('<div></div>')
                        .addClass(options.chatDisplayClass)
                        .appendTo( dialog ); 
                    char_input = $('<input />')
                        .addClass(options.chatInputClass)
                        .appendTo( dialog ).keydown(function(event)
                        {
                            if(event.which==13)
                            {
                                sendMessage(id, $(this).val());
                                $(this).val('');
                            }
                        });
                      
                    
                }
                return dialog;
            };
            var sendMessage = function(id, message)
            {  
                $.ajax({
                    url: $.configures.chatSendMessageUrl,
                    type: 'POST',
                    data: {
                        chat: {
                            receiver_id: id,
                            message: message,
                        },
                        token: $.configures.chatToken,
                    },
                    dataType: 'json',
                    success: function(response)
                    {
                        $.configures.chatToken = response.token;
                        var dialog = openChatDialog(id);
                        var display = dialog.children('.'+options.chatDisplayClass);
                        display.html(display.html() + '<br />' + response.me + ':' + response.message);
                    },
                    error: function(request)
                    {
                        alert(request.responseText);
                    },
                });
                
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
                        var display = dialog.children('.'+options.chatDisplayClass);
                        display.html(display.html() + '<br />' + data.sender + ':' + data.message);
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
            var dialog = $('.news-dialog');
            dialog.text('確定取消編輯此篇文章？')
                .dialog({
                    buttons: { 
                        "是": function(){ location = $.configures.newsAdminUrl; }, 
                        "否": function() {dialog.dialog('close');}
                    },
                    dialogClass: 'news-dialog-warp',
                });      
            return false;
        });

        $('.news-delete-link').click(function()
        {
			var link = $(this).attr('href');
            var dialog = $('.news-dialog');
            dialog.text('確定刪除此篇文章？')
                .dialog({
                    buttons: { 
                        "是": function(){ location = link }, 
                        "否": function() {dialog.dialog('close');}
                    },
                    dialogClass: 'news-dialog-warp',
                });   
            return false;
        });
		
		$('.news-back-link').click(function()
		{
			window.location = decodeURIComponent($.configures.newsIndexUrl);
			return false;
		});
		
		$('#mm-menu a').each(function(index, element){
            var youtube_img_src = 'http://img.youtube.com/vi/:id/0.jpg';
            var video_img_id = $(this).attr('href').substr(1);
            var video_title = $('<span></span>').text($(this).text());
            var video_img = $('<img />')
                .attr('src', youtube_img_src.replace(':id', video_img_id));
            $(this).html(video_title).append(video_img);
		});
		
		$('#mm-menu-items').css('height', $('#mm-menu a').length * 150);
		
		$('#mm-menu a').click(function(){
            var url = decodeURIComponent($.configures.multimediaYoutubeUrl)
                .replace(':id', $(this).attr('href').substr(1));
			$('#mm-video-frame').attr('src', url);
			return false;
		});
		$('#mm-menu a').eq($.random(0, $('#mm-menu a').length - 1)).click();
        
        var srcoll_offset = 10;
		mmMenuScroll.margin_top_max = 0;
		mmMenuScroll.margin_top_min = parseInt($('#mm-menu').css('height')) - parseInt($('#mm-menu-items').css('height'));
        
		$('.mm-menu-up').mouseenter(function(){
			mmMenuScroll.mousein = true;
			mmMenuScroll(srcoll_offset);
		}).mouseleave(function(){
			mmMenuScroll.mousein = false;
		});	
        
		$('.mm-menu-down').mouseenter(function(){
			mmMenuScroll.mousein = true;
			mmMenuScroll(-1 * srcoll_offset);
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