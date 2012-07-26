/**
 * Utilities
 */
(function($)
{
    String.prototype.replaceAt = function(index, string)
    {
        return this.substr(0, index) + string + this.substr(index + string.length);
    }

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
        },
        pause: function(miliseconds)
        {
            var date = new Date(); 
            var current = null;
            do {
                current = new Date();
            } while ( current - date < miliseconds);
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
        interval:               5000,
        counterDigitElements:   '0123456789'
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
                        var p = 0;
                        var c = 0;
                        var browsered = response.counter.browsered.toString();
                        var text = $.pull.options.browseredcounter.text();
                        if ( text.length > browsered.length ) text = '';
                        for ( var i = 0 ; i < browsered.length ; ++i )
                        {
                            if ( text[i] != browsered[i] )
                            {
                                text = text.replaceAt(i, '0');
                            }
                        }
                        var timer = setInterval(function()
                        {
                            if ( text === browsered )
                            {
                                clearInterval(timer);
                            }
                            else
                            {
                                if ( text[p] == browsered[p] )
                                {
                                    c = 0;
                                    p++;
                                }
                                else
                                {
                                    c++;
                                }
                                for ( var i = p ; i < browsered.length ; ++i )
                                {
                                    var d = $.pull.options.counterDigitElements[
                                        $.random(
                                            0,
                                            $.pull.options.counterDigitElements.length - 1
                                        )
                                    ].toString();
                                    text = text.replaceAt(i, d);
                                }
                                text = text.replaceAt(p, c.toString());
                                $.pull.options.browseredcounter.text(text);
                            }
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
            friendListSearchId:        'chat-friend-list-search',
            chatTitleClass:            'chat-title',
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
                .data('id', data.id)
                .addClass('friend-list-entry')
                .click(function()
                {
                    $.fn.chat.showChatDialog($(this).data('id'));
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
            if ( $(this).data('id') == id ) dialog = $(this);
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
                    if ( dialog.data('show') )
                    {
                        $.fn.chat.hideChatDialog(dialog.data('id'));
                    }
                    else
                    {
                        $.fn.chat.showChatDialog(dialog.data('id'));
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
                .data('id', id)
                .data('show', true)
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
                if ( $(this).data('id') == id )
                {
                    title.children('p').text($(this).children('p').text());
                    title.children('span').removeClass('offline');
                }
            });
            title.children('button').click(function()
            {
                $.fn.chat.closeChatDialog(dialog.data('id'));
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
        }, $.chat.options.animationSpeed).data('show', true);
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
                    if ( $(this).data('uuid') == data.uuid ) exists = true;
                });
                if ( ! exists )
                {
                    $('<p></p>')
                        .data('uuid', data.uuid)
                        .text(data.sender + ':' + data.message)
                        .appendTo($(this));
                }
                $(this).scrollTo($(this).height());
            }
        );
        return dialog;
    };

    $.fn.chat.hideChatDialog = function(id)
    {
        var dialog = $.fn.chat.createChatDialog(id);
        dialog.animate({
            bottom: -172
        }, $.chat.options.animationSpeed).data('show', false);
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
            frameXDimension:        128,
            frameYDimension:        128,
            interval:               200,
            animated:               function()
            {
                return true;
            }
        }, options);
        return $(this).each(function()
        {
            var sprite = $(this);
            sprite.css({
                backgroundPosition: '0px 0px'
            });
            setInterval(function()
            {
                if ( options.animated() )
                {
                    var position = sprite.css('background-position').split(' ');
                    var left = $.integer(position[0]);
                    var top = $.integer(position[1]);
                    var ml = options.frameXDimension * options.horizontalFrames;
                    var mt = options.frameYDimension * options.verticalFrames;

                    left -= options.frameXDimension;
                    if ( left <= -1 * ml )
                    {
                        top -= options.frameYDimension;
                        left = 0;
                    }
                    if ( top <= -1 * mt ) top = 0;

                    sprite.css({
                        backgroundPosition: left + 'px ' + top + 'px'
                    });
                }
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
            var updateScrollDraggableHeight = function()
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
                scrollDragable.css({
                    height: height
                });
                return height;
            };
            var scrollContainer = $('<div></div>')
                .addClass('scroll-container')
                .mouseenter(function()
                {
                    updateScrollDraggableHeight();
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
                var height = updateScrollDraggableHeight();
                var maximun = scrollContainer.height() - height;
                var scale = (
                        scrollArea.height()
                      - scrollContainer.height()
                    ) / (
                        scrollContainer.height()
                      - height
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
            $.extend($(this).__proto__, {
                scrollTo: updateScrollDragable
            });
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
                object.children('span.star').remove();
                for ( var n = 0 ; n < number ; ++n )
                {
                    var x = $.random(0, width);
                    var y = $.random(0, height);
                    var s = $.random(options.minSize, options.maxSize);

                    $('<span></span>').addClass('star').css({
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
 * Moon
 */
(function($)
{
    $.fn.moon = function(options)
    {
        return this.each(function()
        {
            var options = $.extend({
                horizontalFrames:       5,
                verticalFrames:         6,
                frameXDimension:        160,
                frameYDimension:        160,
                interval:               2880
            }, options);
            var getTimeSeconds = function()
            {
                var date = new Date();
                return date.getHours() * 3600 + date.getMinutes() * 60 + date.getSeconds();
            };
            var t = -1
                  * $.integer(getTimeSeconds() / options.interval)
                  % (options.horizontalFrames * options.verticalFrames);
            var x = t
                  % options.horizontalFrames
                  * options.frameXDimension;
            var y = $.integer(t / options.horizontalFrames)
                  * options.frameYDimension;
            $(this).sprite({
                horizontalFrames:       options.horizontalFrames,
                verticalFrames:         options.verticalFrames,
                frameXDimension:        options.frameXDimension,
                frameYDimension:        options.frameYDimension,
                interval:               1000,
                animated:               function()
                {
                    if ( getTimeSeconds() % options.interval == 0 ) return true;
                    return false;
                }
            }).css({
                backgroundPosition: x + 'px ' + y + 'px'
            });
        });
    };
})(jQuery);

/**
 * Konami
 */
(function($)
{
    $.konami = function(options)
    {
        var options = $.extend({
            code:                   [38, 38, 40, 40, 37, 39, 37, 39, 66, 65],
            interval:               10,
            complete:               function()
            {
                alert('You complete the konami code!');
            }
        }, options);
        var index = 0;
        var interval = options.interval;
        var timer = setInterval(function()
        {
            if ( interval-- <= 0 ) index = 0;
        }, 50);
        $(document).keyup(function(event)
        {
            if (
                event.keyCode != 231
             && event.keyCode == options.code[index]
            )
            {
                interval = options.interval;
                if ( index++ == options.code.length - 1 ) options.complete();
                return true;
            }
            index = 0;
            return true;
        });
    };
})(jQuery);

/**
 * Calendar
 */
(function($)
{
    $.fn.generateTodolist = function(events, options)
    {
        options = $.extend({
            tableClass:  'todolist-table',
            dateText:    '日期',
            eventText:   '事件'
        }, options);
        var table = $('<table></table>').addClass(options.tableClass);
        var thead = $('<thead></thead>');
        var tbody = $('<tbody></tbody>');
        var tr = $('<tr></tr>');
        $('<td></td>').text(options.dateText).appendTo(tr);
        $('<td></td>').text(options.eventText).appendTo(tr);
        tr.appendTo(thead);
        for(var key in events)
        {
            var tr = $('<tr></tr>');
            var td = $('<td></td>').text(events[key][0]);
            var td2 = $('<td></td>').text(events[key][1]);
            tr.append(td).append(td2).appendTo(tbody);
        }
        table.append(thead)
            .append(tbody);
        return table;
    }

    $.fn.generateCalendar = function(options)
    {
        options = $.extend({
            year:        0,
            month:       0,
            tableClass:  'calendar-table', 
            buttonClass: 'calendar-button',
            month_tc:    ['一月', '二月', '三月', '四月', '五月', '六月', '七月', '八月', '九月', '十月', '十一月', '十二月'], 
            month_en:    ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'], 
            dayOfWeek:   ['日', '一', '二', '三', '四', '五', '六'], 
            today:       true,
            left:        false,
            right:       false,
            linkClick:   function(){ return false; },
            leftClick:   function(){ return false; },
            rightClick:  function(){ return false; },
            dayClick:    function(){}
        }, options);
        options.month -= 1;
        var daysInMonth = function(iMonth, iYear)
        {
            return 32 - new Date(iYear, iMonth, 32).getDate();
        }
        var table = $('<table></table>').addClass(options.tableClass);
        var link = $('<a></a>')
            .attr('href', '#')
            .text(options.month_en[options.month]+' '+options.month_tc[options.month])
            .click(options.linkClick);
        var left = $('<a></a>')
            .attr('href','#')
            .text('<<')
            .addClass(options.buttonClass)
            .css({
                left: 0,
                position: 'absolute'
            })
            .click(options.leftClick);
        var right = $('<a></a>')
            .attr('href','#')
            .text('>>')
            .addClass(options.buttonClass)
            .css({
                position: 'absolute',
                right: 0
            })
            .click(options.rightClick);
        var caption = $('<caption></caption>').css({
            position: 'relative'
        }).append(link);
        if ( options.left ) caption.prepend(left);
        if ( options.right ) caption.append(right);
        var thead = $('<thead></thead>');
        var tbody = $('<tbody></tbody>');
        var tr = $('<tr></tr>');
        var date = new Date(options.year, options.month);
        for( var key in options.dayOfWeek )
        {
            var td = $('<td></td>').text(options.dayOfWeek[key]);
            if ( key==0 || key==6 ) td.addClass('weekend');
            td.appendTo(tr);
        }
        tr.appendTo(thead);
        for( var day = 1, position = 0; day <= daysInMonth(options.month, options.year); position++ )
        {
            if ( position%7 == 0 )
            {
                tr = $('<tr></tr>');
                tr.appendTo(tbody);
            }
            var td = $('<td></td>');
            if ( position>=date.getDay() )
            {
                td.text(day).click(options.dayClick);
                if( (new Date()).getDate() == day 
                    && (new Date()).getMonth()==options.month
                    && options.today)
                {
                    td.css({background: '#ace082'});
                }
                ++day;
            }
            td.appendTo(tr);
        }
        return table.append(caption)
            .append(thead)
            .append(tbody);
    }

    $.fn.indexCalendar = function(options)
    {
        var options = $.extend({ 
        }, options);
        var top = $(this).children('.calendar-top');
        var bottom = $('<div></div>')
            .attr('id', 'calendar-August')
            .addClass('calendar-bottom');
        var bottom_wrap = this.children('.calendar-bottom-wrap');
        if ( options.isMember )
        {
            top.removeClass('calendar-top-all-nologin');
            top.addClass('calendar-top-all-login');
        }
        else
        {
            $(this).find('#calendar-personal').css('cursor', 'default');
        }
        var september;
        var august;
        var todolist;
        this.children('.calendar-top')
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
        september = $.fn.generateCalendar({
            year: 2012,
            month: 8,
            left: true,
            leftClick: function()
            {
                september.detach();
                august.prependTo(bottom);
                $.fn.generateCalendar
                return false;
            }
            
        });
        august = $.fn.generateCalendar({
            year: 2012,
            month: 7,
            right: true,
            rightClick: function()
            {
                august.detach();
                september.prependTo(bottom);
                $.fn.generateCalendar
                return false;
            },
            dayClick: function()
            {
                $(this).css('border', '1px solid black');
            }
        }).appendTo(bottom);
        bottom.appendTo(bottom_wrap);
        todolist = $.fn.generateTodolist(
            [
                ['2012/8/6', '資訊網上線'],
                ['2012/8/6', '資訊網上線'],
                ['2012/8/6', '資訊網上線'],
                ['2012/8/6', '資訊網上線']
            ]
        ).appendTo(bottom);
        return this;
    };
})(jQuery);

/**
 * Dialog
 */
(function($){
    $.dialog = {};

    $.fn.dialog = function(options)
    {
        return $(this).each(function()
        {
            this.options =  $.extend({
                width:          $(this).width(),
                heigth:         $(this).height(),
                modal:          true,
                escape:         true,
                closeButton:    true,
                speed:          'fast',
                effect:         'none',
                dialogClass:    'dialog',
                closeText:      'close',
                closeClass:     'dialog-close-button',
                openEffect:     function(speed)
                {
                    $(this).fadeIn(speed);
                },
                closeEffect:    function(speed)
                {
                    $(this).fadeOut(speed);
                },
                onClose:        function() {},
                onOpen:         function() {},
                onCreate:       function() {},
                onDestroy:      function() {}
            }, this.options, options);
            switch ( options )
            {
                case 'close' : 
                    $.fn.dialog.close(this);
                    break;
                case 'destroy' :
                    $.fn.dialog.destroy(this);
                    break;
                case 'open' :
                    $.fn.dialog.open(this);
                    break;
                case 'create' :
                    $.fn.dialog.create(this);
                    break;
                default :
                    $.fn.dialog.open(this);
            }
        });
    }

    $.fn.dialog.open = function(target)
    {
        target.options.onOpen.call(target);
        target.overlay = $('<div></div>').overlay({
            closeOnClick:   ! target.options.modal,
            closeOnEscape:  target.options.escape,
            onBeforeHide:   function()
            {
                target.options.onClose.call(target);
                target.options.closeEffect.call(target, target.options.speed);
                return true;
            }
        }).appendTo($('body'));
        if ( ! $(target).hasClass(target.options.dialogClass) )
        {
            $.fn.dialog.create(target);
        }
        target.options.openEffect.call(target, target.options.speed);
    }     

    $.fn.dialog.close = function(target)
    {
        target.overlay.close();
        target.overlay.remove();
    }

    $.fn.dialog.create = function(target)
    {
        if ( ! $(target).hasClass(target.options.dialogClass) )
        {
            if ( target.options.closeButton )
            {
                var close = $('<a></a>')
                    .attr('href','#')
                    .text(target.options.closeText)
                    .addClass(target.options.closeClass)
                    .click(function()
                    {
                        $.fn.dialog.close(target);
                        return false;
                    });
                $(target).prepend(close);
            }
        }
        target.options.onCreate.call(target);
        $(target)
            .css({
                position: 'absolute',
                top: '50%',
                left: '50%',
                width: target.options.width,
                heigth: target.options.heigth,
                marginLeft: -1 * target.options.width / 2,
                marginTop: -1 * target.options.heigth / 2,
                padding: 0,
                display: 'none',
                zIndex: 1000
            })
            .addClass(target.options.dialogClass)
            .detach()
            .appendTo('body');
    } 

    $.fn.dialog.destroy = function(target)
    {
        target.options.onDestroy.call(target);
        $(target).remove();
    }
})(jQuery);

/**
 * Overlay
 */
(function($)
{
    $.overlay = function(options)
    {
        return $('body').overlay(options);
    };

    $.fn.overlay = function(options)
    {
        return this.each(function()
        {
            this.options = $.extend({
                overlayClass:   'overlay',
                speed:          'fast',
                closeOnClick:   true,
                closeOnEscape:  true,
                onBeforeShow:   function() { return true; },
                onShow:         function() {},
                onAfterShow:    function() {},
                onBeforeHide:   function() { return true; },
                onHide:         function() {},
                onAfterHide:    function() {}
            }, options);

            var overlayClose = (function(object)
            {
                return function()
                {
                    if ( this.options.onBeforeHide.call(this.overlay) )
                    {
                        this.overlay.fadeOut(this.options.speed, function()
                        {
                            object.options.onHide.call(object.overlverlay);
                            object.overlay.remove();
                            object.options.onAfterHide.call(object.overlverlay);
                            $(document).unbind('keyup', closeOnEscape);
                        });
                    }
                    return true;
                };
            })(this);
            var closeOnEscape = (function(object)
            {
                return function(event)
                {
                    if ( event.keyCode == 27 )
                    {
                        if ( object.options.closeOnEscape )
                        {
                            return overlayClose.call(object);
                        }
                    }
                };
            })(this);

            this.overlay = $('<div></div>')
                .addClass(this.options.overlayClass)
                .css({
                    display:            'none'
                })
                .click(function(object)
                {
                    return function()
                    {
                        if ( object.options.closeOnClick )
                        {
                            return overlayClose.call(object);
                        }
                    };
                }(this))
                .fadeIn(this.options.speed, (function(object)
                {
                    return function()
                    {
                        if ( object.options.onBeforeShow.call(object.overlay) )
                        {
                            object.options.onShow.call(object.overlay);
                            object.options.onAfterShow.call(object.overlay);
                        }
                        return true;
                    };
                })(this))
                .appendTo($(this));

            $.extend(this.overlay.__proto__, {
                close: function()
                {
                    return overlayClose.call(this.get(0));
                }
            });
            $(document).bind('keyup', closeOnEscape);
            return this.overlay;
        });
    }
})(jQuery);

/**
 * Lightbox
 */
(function($) {
    $.fn.lightbox = function(options)
    {
        var options = $.extend({
            lightboxId:                 'lightbox',
            lightboxContainerId:        'lightbox-container',
            lightboxBoxId:              'lightbox-box',
            lightboxLoadingId:          'lightbox-loading',
            lightboxImageId:            'lightbox-image',
            lightboxNavigationId:       'lightbox-navigation',
            lightboxPrevId:             'lightbox-prev',
            lightboxNextId:             'lightbox-next',
            lightboxCloseId:            'lightbox-close',
            lightboxDetailsId:          'lightbox-details',
            lightboxCaptionId:          'lightbox-caption',
            lightboxPageId:             'lightbox-page',
            fixedNavigation:            false,
            containerBorderSize:        10,
            containerResizeSpeed:       'slow',
            detailsSlideSpeed:          'fast',
            textImage:                  'Image',
            textOf:                     '/',
            keyToClose:                 'c',
            keyToPrev:                  'p',
            keyToNext:                  'n',
            onBeforeShow:               function() { return true; },
            onShow:                     function() {},
            onAfterShow:                function() {},
            onBeforeHide:               function() { return true; },
            onHide:                     function() {},
            onAfterHide:                function() {}
        }, options);

        var active = 0;

        var images = [];

        var objects = $(this);

        var lightboxInitialize = function()
        {
            if ( options.onBeforeShow() )
            {
                var overlay = $.overlay({
                    onBeforeHide: lightboxClose
                });
                var lightbox = $('<div></div>')
                    .attr('id', options.lightboxId)
                    .click(overlay.close)
                    .appendTo($('body'));
                var box = $('<div></div>')
                    .attr('id', options.lightboxBoxId)
                    .appendTo(lightbox);
                var loading = $('<div></div>')
                    .attr('id', options.lightboxLoadingId)
                    .appendTo(box);
                var image = $('<img />')
                    .attr('id', options.lightboxImageId)
                    .appendTo(box);
                var navigation = $('<div></div>')
                    .attr('id', options.lightboxNavigationId)
                    .appendTo(box);
                var prev = $('<a></a>')
                    .attr('id', options.lightboxPrevId)
                    .attr('href', '#')
                    .appendTo(navigation);
                var next = $('<a></a>')
                    .attr('id', options.lightboxNextId)
                    .attr('href', '#')
                    .appendTo(navigation);
                var details = $('<div></div>')
                    .attr('id', options.lightboxDetailsId)
                    .appendTo(lightbox);
                var caption = $('<span></span>')
                    .attr('id', options.lightboxCaptionId)
                    .appendTo(details);
                var page = $('<span></span>')
                    .attr('id', options.lightboxPageId)
                    .appendTo(details);
                var close = $('<a></a>')
                    .attr('id', options.lightboxCloseId)
                    .attr('href', '#')
                    .click(overlay.close)
                    .appendTo(details);

                active = 0;
                images = [];
                objects.each(function(index)
                {
                    var object = objects.eq(index);
                    images.push(new Array(
                        object.attr('title'),
                        object.attr('href')
                    ));
                });
                while ( images[active][1] != $(this).attr('href') ) active++;

                options.onShow();
                lightbox.css({
                    marginTop: -1 * box.height() / 2,
                    top: '50%'
                });
                lightboxLoadImage();
                options.onAfterShow();
            }
            return false;
        }

        var lightboxPrev = function()
        {
            if ( active != 0 )
            {
                active -= 1;
                lightboxLoadImage();
            }
            return false;
        }

        var lightboxNext = function()
        {
            if ( active != (images.length - 1) )
            {
                active += 1;
                lightboxLoadImage();
            }
            return false;
        }

        var lightboxClose = function()
        {
            if ( options.onBeforeHide() )
            {
                options.onHide();
                $('#' + options.lightboxId).remove();
                options.onAfterHide();
            }
            return true;
        }

        var lightboxLoadImage = function()
        {
            var preloader = new Image();

            if ( ! options.fixedNavigation )
            {
                $('#' + options.lightboxNavigationId + ', #' + options.lightboxPrevId + ', #' + options.lightboxNextId).hide();
            }
            $('#' + options.lightboxImageId + ', #' + options.lightboxDetailsId + ', #' + options.lightboxPageId).hide();

            preloader.onload = function() {
                $('#' + options.lightboxImageId).attr('src', images[active][1]);
                lightboxResize(preloader.width, preloader.height);
            };
            preloader.src = images[active][1];
        };

        var lightboxResize = function(width, height)
        {
            var currentWidth = $('#' + options.lightboxBoxId).width();
            var currentHeight = $('#' + options.lightboxBoxId).height();
            var containerWidth = (width + (options.containerBorderSize * 2));
            var containerHeight = (height + (options.containerBorderSize * 2));
            var differenceWidth = currentWidth - containerWidth;
            var differenceHeight = currentHeight - containerHeight;

            $('#' + options.lightboxId).css({
                marginTop: -1 * containerWidth / 2
            });
            $('#' + options.lightboxDetailsId).css({
                width: width
            });
            $('#' + options.lightboxPrevId + ', #' + options.lightboxNextId).css({
                height: containerHeight
            });
            $('#' + options.lightboxBoxId).animate({
                height: containerHeight,
                width: containerWidth
            }, options.containerResizeSpeed, lightboxShowImage);

            if ( ( differenceWidth == 0 ) && ( differenceHeight == 0 ) )
            {
                $.pause($.browser.msie ? 250 : 100);
            }
        }

        var lightboxShowImage = function()
        {
            $('#' + options.lightboxImageId).fadeIn(function()
            {
                lightboxShowImageDetails();

                $('#' + options.lightboxNavigationId).show();

                if ( active != 0 )
                {
                    $('#' + options.lightboxPrevId)
                        .unbind()
                        .bind('click', lightboxPrev)
                        .show();
                }

                if ( active != (images.length - 1) )
                {
                    $('#' + options.lightboxNextId)
                        .unbind()
                        .bind('click', lightboxNext)
                        .show();
                }
            });

            lightboxPreload();
        };

        var lightboxShowImageDetails = function()
        {
            $('#' + options.lightboxCaptionId).hide();
            if ( images[active][0] )
            {
                $('#' + options.lightboxCaptionId).html(images[active][0]).show();
            }

            if ( images.length > 1 )
            {
                $('#' + options.lightboxPageId).html(
                    options.textImage + ' '
                  + ( active + 1 ) + ' '
                  + options.textOf + ' '
                  + images.length
                ).show();
            }

            $('#' + options.lightboxDetailsId).slideDown(options.detailsSlideSpeed);
        };

        var lightboxPreload = function()
        {
            if ( active > 0 )
            {
                var objPrev = new Image();
                objPrev.src = images[active - 1][1];
            }

            if ( (images.length - 1) > active )
            {
                var objNext = new Image();
                objNext.src = images[active + 1][1];
            }

            lightboxEnableKeyboard();
        };

        var lightboxEnableKeyboard = function()
        {
            $(document).bind('keydown', lightboxKeyboard);
        }

        var lightboxDisableKeyboard = function()
        {
            $(document).unbind('keydown', lightboxKeyboard);
        }

        var lightboxKeyboard = function(event)
        {
            var key = String.fromCharCode(event.keyCode).toLowerCase();
            if (
                (key == options.keyToClose.toLowerCase())
             || (key == 'x')
             || (event.keyCode == 27)
            )
            {
                lightboxClose();
            }
            if (
                (key == options.keyToPrev.toLowerCase())
             || (event.keyCode == 37)
            )
            {
                lightboxPrev();
                lightboxDisableKeyboard();
            }
            if (
                (key == options.keyToNext.toLowerCase())
             || (event.keyCode == 39)
            )
            {
                lightboxNext();
                lightboxDisableKeyboard();
            }
        }

        return this.unbind('click').click(lightboxInitialize);
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

        $('#chat').chat();

        $('#header').star();

        $('#moon').moon();

        $('.loading').sprite();

        $('#form-sidebar-register').click(function()
        {
            window.location.href = $.configures.registerUrl;
            return false;
        });

        $('#sidebar-personal-toggle').click(function()
        {
            var button = $(this);
            if ( button.hasClass('active') )
            {
                $('#sidebar-personal').slideUp(300, function()
                {
                    button.removeClass('active');
                });
            }
            else
            {
                $('#sidebar-personal').slideDown(300, function()
                {
                    button.addClass('active');
                });
            }
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

        $.konami({
            code:                   [38],
            complete:               function()
            {
                var input = 0;
                var input_index = 1;
                var up = 99;
                var down = 0;
                var answer = $.random(1, 99);
                if ( $('#secret').length ) return false;
                var back = $('<div></div>')
                    .attr('id', 'secret')
                    .css({
                    background: 'black',
                    height: '100%',
                    position: 'fixed',
                    top: 0,
                    opacity: 1,
                    left: 0,
                    width: '100%'
                })
                .appendTo('body');
                var box = $('<div></div>').css({
                    background: 'red',
                    height: 400,
                    margin: '-200px 0 0 -200px',
                    position: 'fixed',
                    top: '50%',
                    left: '50%',
                    width: 400
                })
                .appendTo('body');
                $('<h4>終極密碼</h4>').css({
                    color: 'yellow',
                    textAlign: 'center',
                    fontSize: 30
                })
                .appendTo(box);
                var message = $('<p></p>').text('請輸入數字' + down + '到' + up +'之間').css({
                    color: 'black',
                    fontSize: 20,
                    position: 'absolute',
                    top: 60,
                    left: '25%',
                })
                .appendTo(box);
                var input_text = $('<input type="text" readonly/>').attr('value', '').css({
                    left: 100,
                    width: 200,
                    height: 20,
                    textAlign: 'center',
                    position: 'absolute',
                })
                .appendTo(box);
                $('<p>確定送出</p>').css({
                    color: 'black',
                    top: 320,
                    left: 140,
                    position: 'absolute',
                    textAlign: 'center',
                    fontSize: 30,
                    fontFamily: 'Microsoft YaHei Mono'
                })
                .mouseenter(function(){
                    $(this).css({
                        color: 'blue',
                        cursor: 'default'
                    });
                })
                .mouseleave(function(){
                    $(this).css({
                      color: 'black'
                    });
                })
                .click(function()
                {
                    $(this).css({
                        color: 'yellow',
                    });
                    input = input_text.val();
                    if( input < up && input >down )
                    {
                        if( input == answer )
                        {
                            alert('恭喜你猜對了!!!');
                            back.remove();
                            box.remove();   
                        }
                        else if( input > answer )
                        {
                            up = input;
                        }
                        else if( input < answer )
                        {
                            down = input;
                        }
                        message.text('請輸入數字' + down + '到' + up +'之間');
                        input_index = 1;
                    }
                    else
                    {
                        alert('要輸在範圍內喔!');
                    }
                    input = 0;
                    input_index = 1;
                    input_text.attr('value', input);
                })
                .appendTo(box);
                var numberTable = $('<table></table>').css({
                    border: 5,
                    left: 40,
                    top: 150,
                    position: 'absolute'
                });
                var TableRow = [$('<tr></tr>'), $('<tr></tr>'), $('<tr></tr>')];
                for ( var i = 7; i > 0 ; i = i - 3 )
                {
                    for ( var j = 0; j <3 ; j++ )
                    {
                        $('<td></td>').text( i + j ).addClass('tableBox').appendTo(TableRow[ parseInt( i / 3) ]);
                        TableRow[ parseInt( i / 3 ) ].appendTo(numberTable);
                    }
                }
                $('<td></td>').text('0').css({
                    height: 50,
                    width: 100,
                    textAlign: 'center',
                    fontSize: 30    
                })
                .mouseenter(function(){
                    $(this).css({
                        color: 'blue',
                        cursor: 'default'
                    });
                })
                .mouseleave(function(){
                    $(this).css({
                      color: 'black'
                    });
                })
                .click(function()
                {
                    $(this).css({
                        color: 'yellow',
                    });
                    if ( input_index == 1 )
                    {
                        input_index = 0;
                    }
                    else if( input_index == 0 )
                    {
                        input = input * 10;
                        input_index = -1;
                    }
                    input_text.attr('value', input);
                })
                .appendTo(numberTable);
                $('<td></td>').text('Clean').css({
                    colspan: 2, 
                    height: 50,
                    width: 100,
                    fontSize: 30,
                    textAlign: 'center'
                })
                .mouseenter(function(){
                    $(this).css({
                        color: 'blue',
                        cursor: 'default'
                    });
                })
                .mouseleave(function(){
                    $(this).css({
                        color: 'black'
                    });
                })
                .click(function()
                {
                    $(this).css({
                        color: 'yellow',
                    });
                    input_index = 1;
                    input = 0;
                    input_text.attr('value', input);
                })
                .appendTo(numberTable);
                numberTable.appendTo(box);
                $('.tableBox').each(function(){
                    $(this).css({
                        textAlign: 'center',
                        height: 50,
                        width: 100,
                        fontSize: 30    
                    })
                    .mouseenter(function(){
                        $(this).css({
                            color: 'blue',
                            cursor: 'default'
                        });
                    })
                    .mouseleave(function(){
                        $(this).css({
                            color: 'black'
                        });
                    })
                    .click(function()
                    {
                        $(this).css({
                            color: 'yellow',
                        });
                        if ( input_index == 1 )
                        {
                            input = $(this).text();
                            input_index = 0;
                        }
                        else if( input_index == 0 )
                        {
                            input = input * 10 + parseInt( $(this).text() );
                            input_index = -1;
                        }
                        input_text.attr('value', input);
                    })
                })
                $(document).keyup(function(event)
                {
                    if ( event.keyCode != 231 && event.keyCode > 95 )
                    {
                        if ( event.keyCode == 96 )
                        {
                        }
                        else
                        {
                        }
                    }
                    index = 0;
                    return true;
                });
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
