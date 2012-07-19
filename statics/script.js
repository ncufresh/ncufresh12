google.load('search', '1', {
     language: 'zh_TW'
});

google.setOnLoadCallback(function()
{
    google.search.CustomSearchControl.attachAutoCompletion(
        '011017124764723419863:mdibrr3n-py',
        document.getElementById('form-search-query'),
        'search'
    );
});

(function($)
{
    $.pull = {};

    $.pull.interval = 5000;

    $.pull.start = function()
    {
        $.getJSON(
            $.configures.pullUrl,
            {
                lasttime: $.configures.lasttime
            },
            function(response)
            {
                $.configures.lasttime = response.lasttime;
                if ( response.friends )
                {
                    $.fn.chat.updateFriendList(response.friends);
                }
                if ( response.messages )
                {
                    for ( var key in response.messages )
                    {
                        var data = response.messages[key];
                        $.fn.chat.updateChatDialog(data.id, data);
                    }
                }
            }
        );
        $.pull.timer = setTimeout(arguments.callee, $.pull.interval);
    };

    $.pull.pause = function()
    {
        $.pull.timer = clearTimeout($.pull.timer);
    };

    $.pull.restart = function()
    {
        $.pull.timer = setTimeout($.pull.start, $.pull.interval);
    };

    $.chat = {};

    $.fn.chat = function(options)
    {
        $.chat.options = $.extend({
            animationSpeed:         500,
            chatId:                 'chat',
            friendListId:           'chat-friend-list',
			friendListEntriesWrapId:'chat-friend-list-entries-wrap',	
			friendListSearchId:		'chat-friend-list-search',
			chatTitleClass:			'chat-title',
            chatDialogClass:        'chat-dialog',
            chatDisplayClass:       'chat-display',
            chatFormClass:          'chat-form',
            chatInputClass:         'chat-input',
            unknownIcon:            'unknown.png'
        }, options);
        return $(this).click(function()
        {
            $.fn.chat.openFriendList();
            return true;
        });
    };

    $.fn.chat.createFriendList = function()
    {
        var list = $('#' + $.chat.options.friendListId);
        if ( list.length == 0 )
        {
            list = $('<div></div>')
                .attr('id', $.chat.options.friendListId)
                .appendTo($('body'));
			title = $('<span></span>')
				.text('Chat Room')
				.click(function()
				{
					$.fn.chat.closeFriendList();
				})
				.appendTo(list);
			display = $('<div></div>')
				.attr('id', $.chat.options.friendListEntriesWrapId)
				.appendTo(list);
			search = $('<input />')
				.attr('type', 'text')
				.attr('id', $.chat.options.friendListSearchId)
				.appendTo(list);
        }
        return list;
    };

    $.fn.chat.openFriendList = function()
    {
        var list = $.fn.chat.createFriendList();
        list.animate({
            height: list.css('max-height')
        }, $.chat.options.animationSpeed);
        $('#' + $.chat.options.chatId).fadeOut();
        return list;
    };

    $.fn.chat.updateFriendList = function(response)
    {
        var list = $.fn.chat.createFriendList();
		var list_wrap = list.children('#'+$.chat.options.friendListEntriesWrapId);
        for ( var key in response )
        {
            var data = response[key];
            var entry = $('<div></div>')
                .attr('chat:id', data.id)
                .addClass('friend-list-entry')
                .click(function()
                {
                    $.fn.chat.showChatDialog($(this).attr('chat:id'));
                })
                .appendTo(list_wrap);
            var icon = $('<img />')
                .attr(
                    'src',
                    data.icon ? data.icon : $.chat.options.unknownIcon
                )
                .appendTo(entry);
            var name = $('<p>')
                .text(data.name)
                .appendTo(entry);
        }
        return list;
    };
	
    $.fn.chat.closeFriendList = function()
    {
        var list = $.fn.chat.createFriendList();
		$('#' + $.chat.options.chatId).fadeIn();
		list.animate({
            height: 0
        }, $.chat.options.animationSpeed);
    };
	
	$.fn.chat.updateChatDialogsPosition = function()
	{
        var list = $.fn.chat.createFriendList();
        var left = list.position().left
                 + list.outerWidth(true)
                 - list.innerWidth();
        $('.' + $.chat.options.chatDialogClass).each(function(index)
        {
            $(this).css({
                left: left - $(this).outerWidth(true) * (index + 1)
            });
        });
	}
	
    $.fn.chat.createChatDialog = function(id)
    {
        var list = $.fn.chat.createFriendList();
        var left = list.position().left
                 + list.outerWidth(true)
                 - list.innerWidth();
        var size = 1;
        var dialog = null;
        $('.' + $.chat.options.chatDialogClass).each(function(index)
        {
            if ( $(this).attr('chat:id') == id ) dialog = $(this);
            $(this).css({
                left: left - $(this).outerWidth(true) * (index + 1)
            });
            size++;
        });
        if ( ! dialog )
        {	
			var title = $('<div></div>')
				.addClass($.chat.options.chatTitleClass)
				.append('<span></span>')
				.append('<p></p>')
				.append('<button></button>')
				.click(function()
				{
					if ( dialog.attr('chat:show') == 'true' )
					{
						$.fn.chat.hideChatDialog(dialog.attr('chat:id'));
					}
					else
					{
						$.fn.chat.showChatDialog(dialog.attr('chat:id'));
					}
					
				});
            var display = $('<div></div>')
                .addClass($.chat.options.chatDisplayClass);
            var input = $('<input />')
                .addClass($.chat.options.chatInputClass);
            var form = $('<form></form>')
                .addClass($.chat.options.chatFormClass)
                .submit(function()
                {
                    $.fn.chat.sendMessage(id, input.val());
                    input.val('');
                    return false;
                })
                .append(input);
            dialog = $('<div></div>')
                .attr('chat:id', id)
				.attr('chat:show', 'true')
                .addClass($.chat.options.chatDialogClass)
                .append(title)
				.append(display)
                .append(form)
                .insertBefore(list);
            dialog.css({
                left: left - dialog.outerWidth(true) * size
            });
			title.children('span').addClass('offline');
			$('.friend-list-entry').each(function(index)
			{
				if($(this).attr('chat:id') == id)
				{
					title.children('p').text($(this).children('p').text());
					title.children('span').removeClass('offline');
				}
			});
			title.children('button').click(function()
			{
				$.fn.chat.closeChatDialog(dialog.attr('chat:id'));
			});
        }
        return dialog;
    };

    $.fn.chat.showChatDialog = function(id)
    {
        var dialog = $.fn.chat.createChatDialog(id);
		dialog.animate({
			bottom: 0,
		}, $.chat.options.animationSpeed).attr('chat:show', 'true');
		$.fn.chat.updateChatDialogsPosition();
        return dialog;
    };

    $.fn.chat.updateChatDialog = function(id, data)
    {
        var exists;
        var dialog = $.fn.chat.createChatDialog(id);
        dialog.children('.' + $.chat.options.chatDisplayClass)
            .each(function()
            {
                $(this).children('p').each(function()
                {
                    if ( $(this).attr('chat:uuid') == data.uuid ) exists = true;
                });
                if ( ! exists )
                {
                    $('<p></p>')
                        .attr('chat:uuid', data.uuid)
                        .text(data.sender + ':' + data.message)
                        .appendTo($(this));
                }
                $(this)
                    .stop()
                    .animate({
                        scrollTop: this.scrollHeight
                    }, 1000);
            }
        );
        return dialog;
    };

    $.fn.chat.hideChatDialog = function(id)
    {
        var dialog = $.fn.chat.createChatDialog(id);
		dialog.animate({
			bottom: -172,
		}, $.chat.options.animationSpeed).attr('chat:show', 'false');
		$.fn.chat.updateChatDialogsPosition();
        return dialog;
    };

    $.fn.chat.closeChatDialog = function(id)
    {
        $.fn.chat.createChatDialog(id).remove();
		$.fn.chat.updateChatDialogsPosition();
    };
		
    $.fn.chat.sendMessage = function(id, message)
    {
        $.post(
            $.configures.chatSendMessageUrl,
            {
                chat: {
                    receiver_id: id,
                    message: message,
                },
                token: $.configures.token,
                lasttime: $.configures.lasttime,
                sequence: $.configures.sequence++
            },
            function(response)
            {
                $.pull.pause();
                $.configures.token = response.token;
                $.configures.lasttime = response.lasttime;
                for ( var key in response.messages )
                {
                    var data = response.messages[key];
                    $.fn.chat.updateChatDialog(data.id, data);
                }
                $.pull.restart();
            }
        );
    };

    $.fn.loading = function(options)
    {
        options = $.extend({
            horizontalFrames:       4,
            verticalFrames:         4,
            FrameXDimension:        128,
            FrameYDimension:        128,
            interval:               100,
        }, options);
        return $(this).each(function()
        {
            var loading = $(this);
            loading.css({
                backgroundPosition: '0px 0px'
            });
            setInterval(function()
            {
                var position = loading.css('background-position').split(' ');
                var left = $.integer(position[0]);
                var top = $.integer(position[1]);
                var ml = options.FrameXDimension * options.horizontalFrames;
                var mt = options.FrameYDimension * options.verticalFrames;

                left -= options.FrameXDimension;
                if ( top < -1 * mt ) top = 0;

                if ( left < -1 * ml )
                {
                    top -= options.FrameYDimension;
                    left = 0;
                }

                loading.css({
                    backgroundPosition: left + 'px ' + top + 'px'
                });
            }, options.interval);
        });
    };

    $.extend({
        random: function(min, max)
        {
            return Math.floor(Math.random() * (max - min + 1) + min);
        },
        cookie: function(key, value, settings)
        {
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
        highlight: function(color, duration)
        {
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
    });

    $(document).ready(function()
    {
        $.configures.lasttime = 0;

        $.configures.sequence = $.random(0, 1000);

        if ( $.configures.facebookEnable )
        {
            $('<script></script>')
                .attr('id', 'facebook-jssdk')
                .attr('async', 'async')
                .attr('type', 'text/javascript')
                .attr('src', '//connect.facebook.net/zh_TW/all.js')
                .insertBefore($('script').first());
        }

        if ( $('#header') ) $('#header').star();

        if ( $('#chat') ) $('#chat').chat();

        $('.loading').loading();

        $('#form-sidebar-register').click(function()
        {
            window.location.href = $.configures.registerUrl;
            return false;
        });

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

        $('.news-delete-link').click(function()
        {
            var link = $(this).attr('href');
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

        $('.news-back-link').click(function()
        {
            window.location = decodeURIComponent($.configures.newsIndexUrl);
            return false;
        });

        $('#mm-menu a').each(function(index, element)
        {
            var youtube_img_src = 'http://img.youtube.com/vi/:id/0.jpg';
            var video_img_id = $(this).attr('href').substr(1);
            var video_title = $('<span></span>').text($(this).text());
            var video_img = $('<img />')
                .attr('src', youtube_img_src.replace(':id', video_img_id));
            $(this).html(video_title).append(video_img);
        });

        $('#mm-menu-items').css('height', $('#mm-menu a').length * $('#mm-menu a').first().css('height'));
        
        $('#mm-menu a').click(function()
        {
            var url = $.configures.multimediaYoutubeUrl.replace(':id', $(this).attr('href').substr(1));
            $('#mm-video-frame').attr('src', url);
            return false;
        });
        $('#mm-menu a').eq($.random(0, $('#mm-menu a').length - 1)).click();

        var srcoll_offset = 10;
        mmMenuScroll.margin_top_max = 0;
        mmMenuScroll.margin_top_min = parseInt($('#mm-menu').css('height')) - parseInt($('#mm-menu-items').css('height'));

        $('.mm-menu-up').mouseenter(function()
        {
            mmMenuScroll.mousein = true;
            mmMenuScroll(srcoll_offset);
        }).mouseleave(function()
        {
            mmMenuScroll.mousein = false;
        });

        $('.mm-menu-down').mouseenter(function()
        {
            mmMenuScroll.mousein = true;
            mmMenuScroll(-1 * srcoll_offset);
        }).mouseleave(function()
        {
            mmMenuScroll.mousein = false;
        });

        inin_about();

		$('.nculife-food .dialog').click(function()
        {
			$('#nculife-dialog').dialog(
            {
				dialogClass: 'nculife-dialog',
				height: 500,
				width: 700,
				modal: true,
				show: 
                {
                    effect: 'explode',
                    direction: 'down'
                }
			});
	
		});

		$('#haha1').click(function()
        {
			var url = 'index.html';
			// alert(url);
			$.ajax(
            {
				type: 'GET',
				url: '/ncufresh12/nculife/foodContent.html',
				data:
                {
					id: 1
				},
				dataType: 'html',
				success: function(data)
                { 
					$('#nculife-cv').html(data);
				},
			});	
			return false;
		});		
		$('#haha2').click(function()
        {
			var url = 'index.html';
			// alert(url);
			$.ajax(
            {
				type: 'GET',
				url: '/ncufresh12/nculife/foodContent.html',
				data:
                {
					id: 2
				},
				dataType: 'html',
				success: function(data)
                { 
					$('#nculife-cv').html(data);
				},
			});
			return false;
		});

        $.pull.start();
    });

    if ( $.configures.facebookEnable )
    {
        window.fbAsyncInit = function()
        {
            var like = $('<div></div>')
                .attr('id', 'fb-like')
                .appendTo($('#fb-root'));

            $('<fb:like></fb:like>')
                .attr('href', window.location.href)
                .attr('data-send', 'false')
                .attr('data-layout', 'button_count')
                .attr('data-show-faces', 'false')
                .appendTo(like);

            FB.init({
                appId:      $.configures.facebookAppId,
                channelUrl: $.configures.facebookChannelUrl,
                status:     true,
                cookie:     true,
                xfbml:      true
            });
        };
    }
})(jQuery);

function inin_about()
{
    var about_what_photo_index = 0;
    var photoArray=new Array(8);
    photoArray[0]= 'url(\'' + $.configures.staticsUrl + '/about/photo0.png\')';
    photoArray[1]= 'url(\'' + $.configures.staticsUrl + '/about/photo1.png\')';
    photoArray[2]= 'url(\'' + $.configures.staticsUrl + '/about/photo2.png\')';
    photoArray[3]= 'url(\'' + $.configures.staticsUrl + '/about/photo3.png\')';
    photoArray[4]= 'url(\'' + $.configures.staticsUrl + '/about/photo4.png\')';
    photoArray[5]= 'url(\'' + $.configures.staticsUrl + '/about/photo5.png\')';
    photoArray[6]= 'url(\'' + $.configures.staticsUrl + '/about/photo6.png\')';
    photoArray[7]= 'url(\'' + $.configures.staticsUrl + '/about/photo7.png\')';
    $('#about #what-rightUp').mouseenter(function()
    {
        $('#about #what-rightDown').stop().animate({
            height: '50',
        }, 1000);
    }).mouseleave(function()
    {
        $('#about #what-rightDown').stop().animate({
            height: '0',
        }, 1000);
    })  

    $('#about .what-rightDown-small').each(function(index)
    {
        $(this).css('background-image', 'url(\'' + $.configures.staticsUrl + '/about/small_photo' + index + '.png\')');
        $(this).click(function()
        {
            about_what_photo_index = index;
            $('#about #what-image').css('background-image', photoArray[index]);
            /*更換全體照片*/
        });
    });
    
    $('#about .who-block').each(function(index)
    {
        $(this).click(function()
        {
            　/*更換組介紹*/
        }).mouseenter(function()
        { 
            $(this).css("background-color", "green");
        }).mouseleave(function()
        { 
            $(this).css("background-color", "blue");
        });
    });
    
    setInterval(function()
    {
        if(about_what_photo_index<8)
        {
            about_what_photo_index++;
        }
        else
        {
            about_what_photo_index=0;
        }
        $('#about #what-image').css('background-image', photoArray[about_what_photo_index]);
    },1000);
        
}

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
    var margin_top = parseInt($('#mm-menu-items').css('margin-top'));
    if ( margin_top + offset > mmMenuScroll.margin_top_max )
    {
        margin_top = mmMenuScroll.margin_top_max;
        mmMenuScroll.mousein = false;
        $('#mm-menu-items').css('margin-top', margin_top);
    }
    if ( margin_top + offset < mmMenuScroll.margin_top_min )
    {
        margin_top = mmMenuScroll.margin_top_min ;
        mmMenuScroll.mousein = false;
        $('#mm-menu-items').css('margin-top', margin_top);
    }

    if ( mmMenuScroll.mousein )
    {
        $('#mm-menu-items').css('margin-top', margin_top + offset);
        setTimeout('mmMenuScroll(' + offset + ')', 30);
    }
    else
    {
        return;
    }
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