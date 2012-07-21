/**
 * Utilities
 */
(function($)
{
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
})(jQuery);

/**
 * Mousewheel
 */
(function($)
{
    var types = ['DOMMouseScroll', 'mousewheel'];

    var handler = function(event) {
        var orgEvent = event || window.event, args = [].slice.call(arguments, 1);
        var delta = 0;
        var deltaX = 0;
        var deltaY = 0;
        var returnValue = true;

        event = $.event.fix(orgEvent);
        event.type = 'mousewheel';

        if ( orgEvent.wheelDelta ) delta = orgEvent.wheelDelta / 120;
        if ( orgEvent.detail ) delta = -1 * orgEvent.detail / 3;

        deltaY = delta;

        if (
            orgEvent.axis !== undefined
         && orgEvent.axis === orgEvent.HORIZONTAL_AXIS
        )
        {
            deltaY = 0;
            deltaX = -1 * delta;
        }

        if ( orgEvent.wheelDeltaY !== undefined )
        {
            deltaY = orgEvent.wheelDeltaY / 120;
        }
        if ( orgEvent.wheelDeltaX !== undefined )
        {
            deltaX = -1 * orgEvent.wheelDeltaX / 120;
        }

        args.unshift(event, delta, deltaX, deltaY);
        return ($.event.dispatch || $.event.handle).apply(this, args);
    }

    if ( $.event.fixHooks )
    {
        for ( var i = types.length ; i ; )
        {
            $.event.fixHooks[types[--i]] = $.event.mouseHooks;
        }
    }

    $.event.special.mousewheel = {
        setup: function()
        {
            if ( this.addEventListener )
            {
                for ( var i = types.length ; i ; )
                {
                    this.addEventListener(types[--i], handler, false);
                }
            }
            else
            {
                this.onmousewheel = handler;
            }
        },
        teardown: function()
        {
            if ( this.removeEventListener )
            {
                for ( var i = types.length ; i ; )
                {
                    this.removeEventListener(types[--i], handler, false);
                }
            }
            else
            {
                this.onmousewheel = null;
            }
        }
    };

    $.fn.extend({
        mousewheel: function(fn)
        {
            return fn ? this.bind('mousewheel', fn) : this.trigger('mousewheel');
        },
        unmousewheel: function(fn)
        {
            return this.unbind('mousewheel', fn);
        }
    });
})(jQuery);

/**
 * Pull
 */
(function($)
{
    $.pull = {};

    $.pull.options = {
        onlinecounter:          null,
        browseredcounter:       null,
        counterAnimationSpeed:  50,
        minimumAnimationTimes:  4,
        interval:               5000
    };

    $.pull.start = function(options)
    {
        $.pull.options = $.extend($.pull.options, options);
        $.getJSON(
            $.configures.pullUrl,
            {
                lasttime: $.configures.lasttime
            },
            function(response)
            {
                $.configures.lasttime = response.lasttime;
                if ( response.counter )
                {
                    if ( $.pull.options.onlinecounter )
                    {
                        $.pull.options.onlinecounter.text(
                            response.counter.online
                        );
                    }
                    if ( $.pull.options.browseredcounter )
                    {
                        var browsered = response.counter.browsered;
                        var browseredText = browsered.toString();
                        var current = $.pull.options.browseredcounter.text();
                        if ( current == '0' )
                        {
                            for ( var i = 1; i < browseredText.length; i++)
                            {
                                current += '0';
                            }
                        }
                        var temp = '';
                        var run = false;
                        var timer = setInterval(function()
                        {
                            for ( var i = 0; i < browseredText.length; i++)
                            {
                                temp = '';
                                if ( browseredText.charAt(i) != current.charAt(i) )
                                {
                                    for ( var j = 0; j < browseredText.length; j++)
                                    {
                                        if ( j != i)
                                        {
                                            temp += current.charAt(j);
                                        }
                                        else
                                        {
                                            temp += $.random(0, 9).toString();
                                        }
                                    }
                                    current = temp;
                                    run = true;
                                }
                            }
                            if ( run == false )
                            {
                                current = browsered;
                                clearInterval(timer);
                            }
                            $.pull.options.browseredcounter.text(current);
                        }, $.pull.options.counterAnimationSpeed);
                    }
                }
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
        $.pull.timer = setTimeout(arguments.callee, $.pull.options.interval);
    };

    $.pull.pause = function()
    {
        $.pull.timer = clearTimeout($.pull.timer);
    };

    $.pull.restart = function()
    {
        $.pull.timer = setTimeout($.pull.start, $.pull.options.interval);
    };
})(jQuery);

/**
 * Chat
 */
(function($)
{
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
			var search = $('<input />')
				.attr('type', 'text')
				.attr('id', $.chat.options.friendListSearchId)
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
            search.appendTo(list);
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
		var wrap = list.children('#'+$.chat.options.friendListEntriesWrapId);
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
                .appendTo(wrap);
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
                .scroll(function()
                {
                    alert('!');
                })
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
            display.scrollable();
        }
        return dialog;
    };

    $.fn.chat.showChatDialog = function(id)
    {
        var dialog = $.fn.chat.createChatDialog(id);
		dialog.animate({
			bottom: 0
		}, $.chat.options.animationSpeed).attr('chat:show', 'true');
		$.fn.chat.updateChatDialogsPosition();
        return dialog;
    };

    $.fn.chat.updateChatDialog = function(id, data)
    {
        var exists;
        var dialog = $.fn.chat.createChatDialog(id);
        dialog.find('.' + $.chat.options.chatDisplayClass)
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
			bottom: -172
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
                    message: message
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
})(jQuery);

/**
 * Sprite
 */
(function($)
{
    $.fn.sprite = function(options)
    {
        options = $.extend({
            horizontalFrames:       4,
            verticalFrames:         4, 
            FrameXDimension:        128,
            FrameYDimension:        128,
            interval:               200
        }, options);
        return $(this).each(function()
        {
            var sprite = $(this);
            sprite.css({
                backgroundPosition: '0px 0px'
            });
            setInterval(function()
            {
                var position = sprite.css('background-position').split(' ');
                var left = $.integer(position[0]);
                var top = $.integer(position[1]);
                var ml = options.FrameXDimension * options.horizontalFrames;
                var mt = options.FrameYDimension * options.verticalFrames;

                left -= options.FrameXDimension;
                if ( left <= -1 * ml )
                {
                    top -= options.FrameYDimension;
                    left = 0;
                }
                if ( top <= -1 * mt ) top = 0;

                sprite.css({
                    backgroundPosition: left + 'px ' + top + 'px'
                });
            }, options.interval);
        });
    };
})(jQuery);

/**
 * Highlight
 */
(function($)
{
    $.fn.highlight = function(color, duration)
    {
        var original = this.css('background-color');
        this.stop().css("background-color", color || '#FFFF9C').animate({
            backgroundColor: original
        }, duration || 1000);
    };
})(jQuery);

/**
 * Scrollable
 */
(function($)
{
    $.fn.scrollable = function(options)
    {
        return this.each(function()
        {
            var active = false;
            var inside = false;
            var options = $.extend({
                scrollableClass:        false,
                fadeInDuration:         'slow',
                fadeOutDuration:        'slow',
                wheelSpeed:             6
            }, options);
            var scrollContainer = $('<div></div>')
                .addClass('scroll-container')
                .mouseenter(function()
                {
                    var scrollAreaHeight = scrollArea.height();
                    var scrollContainerHeight = scrollContainer.height();
                    var height = 0;
                    if ( scrollAreaHeight > scrollContainerHeight )
                    {
                        height = scrollContainerHeight
                               * scrollContainerHeight
                               / scrollAreaHeight;
                    }
                    scrollBar
                        .stop(true, true)
                        .fadeIn(options.fadeInDuration);
                    scrollDragable.css({
                        height: height
                    })
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
                .mousewheel(function(event, delta)
                {
                    var top = $.integer(scrollDragable.css('top'));
                    var multiplier =
                        2
                      * options.wheelSpeed
                      * (scrollContainer.height() - scrollDragable.height())
                      / $(this).outerHeight();
                    updateScrollDragable(top - delta * multiplier);
                    return false;
                })
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
                        updateScrollDragable(top + event.screenY - y);
                    };
                    $('html')
                        .bind('mouseup', stop)
                        .bind('mouseleave', stop)
                        .bind('mousemove', update);
                    active = true;
                    return false;
                })
                .appendTo(scrollTrack);
            var updateScrollDragable = function(position)
            {
                var maximun = (
                    scrollContainer.height()
                  - scrollDragable.height()
                  );
                var scale = (
                        scrollArea.height()
                      - scrollContainer.height()
                    ) / (
                        scrollContainer.height()
                      - scrollDragable.height()
                    ) * -1;
                if ( position <= 0 ) position = 0;
                if ( position >= maximun ) position = maximun;
                scrollDragable.css({
                    top: position
                });
                scrollArea.css({
                    top: position * scale
                });
            };
            if ( options.scrollableClass )
            {
                scrollContainer.addClass(options.scrollableClass);
            }
        });
    };
})(jQuery);

/**
 * Marquee
 */
(function($)
{
    $.fn.marquee = function(options)
    {
        return this.each(function()
        {
            var options = $.extend({
                speed:                  2000,
                duration:               500
            }, options);
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
            };
            var timer = setInterval(animation, options.speed);

            $(this).hover(function()
            {
                clearInterval(timer);
            }, function()
            {
                timer = setInterval(animation, options.speed);
            });

            items.css({
                top: 0
            });
        });
    };
})(jQuery);

/**
 * Star
 */
(function($)
{
    $.fn.star = function(options)
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
            }, options);
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
    };
})(jQuery);

/**
 * indexCalendar
 */
(function($)
{
    $.fn.indexCalendar = function(options)
    {
        var options = $.extend({ 
        }, options);
        var top = $(this).children('.calendar-top');
       
        if ( options.isMember )
        {
            top.removeClass('calendar-top-all-nologin');
            top.addClass('calendar-top-all-login');
        }
        else
        {
            $(this).find('#calendar-personal').css('cursor', 'default');
        }
        return this.children('.calendar-top')
            .children('a')
            .click(function()
        {
            var id = $(this).attr('id');
            if ( id == 'calendar-all' )
            {
                top.removeClass('calendar-top-personal');
                if ( options.isMember )
                {
                    top.addClass('calendar-top-all-login');
                }
                else
                {
                    top.addClass('calendar-top-all-nologin');
                }
            }
            else if ( id == 'calendar-personal' )
            {
                if ( options.isMember )
                {
                    top.removeClass('calendar-top-all-login');
                    top.addClass('calendar-top-personal');
                }
            }
            return false;
        });
    };
})(jQuery);

/**
 * Main
 */
(function($)
{
    $(document).ready(function()
    {
        $.configures.lasttime = 0;

        $.configures.sequence = $.random(0, 1000);

        if ( $('#header') ) $('#header').star();

        if ( $('#chat') ) $('#chat').chat();

        $('.loading').sprite();

        $('#form-sidebar-register').click(function()
        {
            window.location.href = $.configures.registerUrl;
            return false;
        });

        $('form input, form textarea').each(function()
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

        $.pull.start({
            onlinecounter: $('#header .online'),
            browseredcounter: $('#header .browsered')
        });
    });

    google.load('search', '1', {
         language: 'zh_TW'
    });

    google.setOnLoadCallback(function()
    {
        google.search.CustomSearchControl.attachAutoCompletion(
            $.configures.googleSearchAppId,
            document.getElementById('form-search-query'),
            'search'
        );
    });

    if ( $.configures.facebookEnable )
    {
        $('<script></script>')
            .attr('id', 'facebook-jssdk')
            .attr('async', 'async')
            .attr('type', 'text/javascript')
            .attr('src', '//connect.facebook.net/zh_TW/all.js')
            .insertBefore($('script').first());

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
