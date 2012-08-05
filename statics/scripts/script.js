/**
 * Utilities
 */
(function(o,d){var k='backgroundColor borderBottomColor borderLeftColor borderRightColor borderTopColor color columnRuleColor outlineColor textDecorationColor textEmphasisColor'.split(' '),h=/^([\-+])=\s*(\d+\.?\d*)/,g=[{re:/rgba?\(\s*(\d{1,3})\s*,\s*(\d{1,3})\s*,\s*(\d{1,3})\s*(?:,\s*(\d+(?:\.\d+)?)\s*)?\)/,parse:function(p){return[p[1],p[2],p[3],p[4]]}},{re:/rgba?\(\s*(\d+(?:\.\d+)?)\%\s*,\s*(\d+(?:\.\d+)?)\%\s*,\s*(\d+(?:\.\d+)?)\%\s*(?:,\s*(\d+(?:\.\d+)?)\s*)?\)/,parse:function(p){return[p[1]*2.55,p[2]*2.55,p[3]*2.55,p[4]]}},{re:/#([a-f0-9]{2})([a-f0-9]{2})([a-f0-9]{2})/,parse:function(p){return[parseInt(p[1],16),parseInt(p[2],16),parseInt(p[3],16)]}},{re:/#([a-f0-9])([a-f0-9])([a-f0-9])/,parse:function(p){return[parseInt(p[1]+p[1],16),parseInt(p[2]+p[2],16),parseInt(p[3]+p[3],16)]}},{re:/hsla?\(\s*(\d+(?:\.\d+)?)\s*,\s*(\d+(?:\.\d+)?)\%\s*,\s*(\d+(?:\.\d+)?)\%\s*(?:,\s*(\d+(?:\.\d+)?)\s*)?\)/,space:'hsla',parse:function(p){return[p[1],p[2]/100,p[3]/100,p[4]]}}],e=o.Color=function(q,r,p,s){return new o.Color.fn.parse(q,r,p,s)},j={rgba:{props:{red:{idx:0,type:'byte'},green:{idx:1,type:'byte'},blue:{idx:2,type:'byte'}}},hsla:{props:{hue:{idx:0,type:'degrees'},saturation:{idx:1,type:'percent'},lightness:{idx:2,type:'percent'}}}},n={'byte':{floor:true,max:255},percent:{max:1},degrees:{mod:360,floor:true}},m=e.support={},b=o('<p>')[0],a,l=o.each;b.style.cssText='background-color:rgba(1,1,1,.5)';m.rgba=b.style.backgroundColor.indexOf('rgba')>-1;l(j,function(p,q){q.cache='_'+p;q.props.alpha={idx:3,type:'percent',def:1}});function i(q,s,r){var p=n[s.type]||{};if(q==null){return(r||!s.def)?null:s.def}q=p.floor?~~q:parseFloat(q);if(isNaN(q)){return s.def}if(p.mod){return(q+p.mod)%p.mod}return 0>q?0:p.max<q?p.max:q}function f(p){var r=e(),q=r._rgba=[];p=p.toLowerCase();l(g,function(w,x){var u,v=x.re.exec(p),t=v&&x.parse(v),s=x.space||'rgba';if(t){u=r[s](t);r[j[s].cache]=u[j[s].cache];q=r._rgba=u._rgba;return false}});if(q.length){if(q.join()==='0,0,0,0'){o.extend(q,a.transparent)}return r}return a[p]}e.fn=o.extend(e.prototype,{parse:function(w,u,p,v){if(w===d){this._rgba=[null,null,null,null];return this}if(w.jquery||w.nodeType){w=o(w).css(u);u=d}var t=this,r=o.type(w),q=this._rgba=[],s;if(u!==d){w=[w,u,p,v];r='array'}if(r==='string'){return this.parse(f(w)||a._default)}if(r==='array'){l(j.rgba.props,function(x,y){q[y.idx]=i(w[y.idx],y)});return this}if(r==='object'){if(w instanceof e){l(j,function(x,y){if(w[y.cache]){t[y.cache]=w[y.cache].slice()}})}else{l(j,function(x,y){l(y.props,function(A,B){var z=y.cache;if(!t[z]&&y.to){if(A==='alpha'||w[A]==null){return}t[z]=y.to(t._rgba)}t[z][B.idx]=i(w[A],B,true)})})}return this}},is:function(r){var p=e(r),s=true,q=this;l(j,function(t,v){var w,u=p[v.cache];if(u){w=q[v.cache]||v.to&&v.to(q._rgba)||[];l(v.props,function(x,y){if(u[y.idx]!=null){s=(u[y.idx]===w[y.idx]);return s}})}return s});return s},_space:function(){var p=[],q=this;l(j,function(r,s){if(q[s.cache]){p.push(r)}});return p.pop()},transition:function(q,w){var r=e(q),s=r._space(),t=j[s],u=this.alpha()===0?e('transparent'):this,v=u[t.cache]||t.to(u._rgba),p=v.slice();r=r[t.cache];l(t.props,function(A,C){var z=C.idx,y=v[z],x=r[z],B=n[C.type]||{};if(x===null){return}if(y===null){p[z]=x}else{if(B.mod){if(x-y>B.mod/2){y+=B.mod}else{if(y-x>B.mod/2){y-=B.mod}}}p[z]=i((x-y)*w+y,C)}});return this[s](p)},blend:function(s){if(this._rgba[3]===1){return this}var r=this._rgba.slice(),q=r.pop(),p=e(s)._rgba;return e(o.map(r,function(t,u){return(1-q)*p[u]+q*t}))},toRgbaString:function(){var q='rgba(',p=o.map(this._rgba,function(r,s){return r==null?(s>2?1:0):r});if(p[3]===1){p.pop();q='rgb('}return q+p.join()+')'},toHslaString:function(){var q='hsla(',p=o.map(this.hsla(),function(r,s){if(r==null){r=s>2?1:0}if(s&&s<3){r=Math.round(r*100)+'%'}return r});if(p[3]===1){p.pop();q='hsl('}return q+p.join()+')'},toHexString:function(p){var q=this._rgba.slice(),r=q.pop();if(p){q.push(~~(r*255))}return'#'+o.map(q,function(s,t){s=(s||0).toString(16);return s.length===1?'0'+s:s}).join('')},toString:function(){return this._rgba[3]===0?'transparent':this.toRgbaString()}});e.fn.parse.prototype=e.fn;function c(t,s,r){r=(r+1)%1;if(r*6<1){return t+(s-t)*r*6}if(r*2<1){return s}if(r*3<2){return t+(s-t)*((2/3)-r)*6}return t}j.hsla.to=function(t){if(t[0]==null||t[1]==null||t[2]==null){return[null,null,null,t[3]]}var p=t[0]/255,w=t[1]/255,x=t[2]/255,z=t[3],y=Math.max(p,w,x),u=Math.min(p,w,x),A=y-u,B=y+u,q=B*0.5,v,C;if(u===y){v=0}else{if(p===y){v=(60*(w-x)/A)+360}else{if(w===y){v=(60*(x-p)/A)+120}else{v=(60*(p-w)/A)+240}}}if(q===0||q===1){C=q}else{if(q<=0.5){C=A/B}else{C=A/(2-B)}}return[Math.round(v)%360,C,q,z==null?1:z]};j.hsla.from=function(v){if(v[0]==null||v[1]==null||v[2]==null){return[null,null,null,v[3]]}var y=v[0]/360,C=v[1],x=v[2],B=v[3],u=x<=0.5?x*(1+C):x+C-x*C,w=2*x-u,t,z,A;return[Math.round(c(w,u,y+(1/3))*255),Math.round(c(w,u,y)*255),Math.round(c(w,u,y-(1/3))*255),B]};l(j,function(q,s){var r=s.props,p=s.cache,u=s.to,t=s.from;e.fn[q]=function(z){if(u&&!this[p]){this[p]=u(this._rgba)}if(z===d){return this[p].slice()}var w,y=o.type(z),v=(y==='array'||y==='object')?z:arguments,x=this[p].slice();l(r,function(A,C){var B=v[y==='object'?A:C.idx];if(B==null){B=x[C.idx]}x[C.idx]=i(B,C)});if(t){w=e(t(x));w[p]=x;return w}else{return e(x)}};l(r,function(v,w){if(e.fn[v]){return}e.fn[v]=function(A){var C=o.type(A),z=(v==='alpha'?(this._hsla?'hsla':'rgba'):q),y=this[z](),B=y[w.idx],x;if(C==='undefined'){return B}if(C==='function'){A=A.call(this,B);C=o.type(A)}if(A==null&&w.empty){return this}if(C==='string'){x=h.exec(A);if(x){A=B+parseFloat(x[2])*(x[1]==='+'?1:-1)}}y[w.idx]=A;return this[z](y)}})});l(k,function(p,q){o.cssHooks[q]={set:function(u,v){var s,r,t;if(o.type(v)!=='string'||(s=f(v))){v=e(s||v);if(!m.rgba&&v._rgba[3]!==1){t=q==='backgroundColor'?u.parentNode:u;do{r=o.css(t,'backgroundColor')}while((r===''||r==='transparent')&&(t=t.parentNode)&&t.style);v=v.blend(r&&r!=='transparent'?r:'_default')}v=v.toRgbaString()}try{u.style[q]=v}catch(v){}}};o.fx.step[q]=function(r){if(!r.colorInit){r.start=e(r.elem,q);r.end=e(r.end);r.colorInit=true}o.cssHooks[q].set(r.elem,r.start.transition(r.end,r.pos))}});a=o.Color.names={aqua:'#00FFFF',black:'#000000',blue:'#0000FF',fuchsia:'#FF00FF',gray:'#808080',green:'#008000',lime:'#00FF00',maroon:'#800000',navy:'#000080',olive:'#808000',purple:'#800080',red:'#FF0000',silver:'#C0C0C0',teal:'#008080',white:'#FFFFFF',yellow:'#FFFFFF',transparent:[null,null,null,0],_default:'#FFFFFF'}})(jQuery);

(function($)
{
    var CHARS = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'.split('');

    String.prototype.replaceAt = function(index, string)
    {
        return this.substr(0, index) + string + this.substr(index + string.length);
    };

    String.prototype.reverse = function()
    {
        return this.split('').reverse().join('');
    };

    $.extend({
        random: function(min, max)
        {
            return Math.floor(Math.random() * (max - min + 1) + min);
        },
        generateUUID: function()
        {
            var uuid = new Array(36);
            var rnd = 0
            var r;
            for ( var i = 0 ; i < 36 ; ++i)
            {
                if ( i == 8 || i == 13 ||  i == 18 || i == 23 )
                {
                    uuid[i] = '-';
                } else if (i==14) {
                    uuid[i] = '4';
                } else {
                    if ( rnd <= 0x02 )
                    {
                        rnd = 0x2000000 + (Math.random() * 0x1000000) | 0;
                    }
                    r = rnd & 0xf;
                    rnd = rnd >> 4;
                    uuid[i] = CHARS[(i == 19) ? (r & 0x3) | 0x8 : r];
                }
            }
            return uuid.join('');
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
        pause: function(miliseconds)
        {
            var date = new Date(); 
            var current = null;
            do {
                current = new Date();
            } while ( current - date < miliseconds);
        },
        daysInMonth: function(month, year)
        {
            return 32 - new Date(year, month, 32).getDate();
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

    $.pull.pulling = false;

    $.pull.options = {
        friendcounter:          null,
        onlinecounter:          null,
        browseredcounter:       null,
        counterAnimationSpeed:  50,
        minimumAnimationTimes:  4,
        interval:               5000,
        counterDigitElements:   '0123456789'
    };

    $.pull.start = function(options)
    {
        if ( ! $.pull.pulling )
        {
            $.pull.pulling = true;

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
                        if ( $.pull.options.friendcounter )
                        {
                            $.pull.options.friendcounter.text(
                                response.counter.friends
                            );
                        }
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
                    $.pull.pulling = false;
                }
            );
        }
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


(function($)
{
    $.push = {};

    $.push.options = {
        interval:               5000
    };

    $.push.pushing = false;

    $.push.start = function()
    {
        if ( ! $.push.pushing )
        {
            var messages = $.fn.getMessageQueue();

            if ( messages.length )
            {
                $.push.pushing = true;

                $.post(
                    $.configures.chatSendUrl,
                    {
                        messages: messages,
                        token: $.configures.token,
                        lasttime: $.configures.lasttime
                    },
                    function(response)
                    {
                        $.pull.pause();
                        $.push.pause();
                        $.configures.token = response.token;
                        $.configures.lasttime = response.lasttime;
                        if ( $.errors(response.errors) )
                        {
                            for ( var key in response.messages )
                            {
                                var data = response.messages[key];
                                $.fn.chat.updateChatDialog(data.id, data);
                            }
                        }
                        $.push.pushing = false;
                        $.push.restart();
                        $.pull.restart();
                    }
                );
            }
        }
        $.push.timer = setTimeout(arguments.callee, $.push.options.interval);
    };

    $.push.pause = function()
    {
        clearTimeout($.push.timer);
    };

    $.push.restart = function()
    {
        $.push.timer = setTimeout($.push.start, $.push.options.interval);
    };
})(jQuery);

/**
 * Errors
 */
(function($)
{
    $.errors = function(errors)
    {
        if ( errors )
        {
            var messages = '';
            for ( var key in errors )
            {
                messages += errors[key];
            }
            $.alert({
                message: messages
            });
            return false;
        }
        return true;
    };
})(jQuery);

/**
 * Chat
 */

(function($)
{
    var queues = [];

    var avatars = [];

    var friends = [];

    $.chat = {};

    $.fn.chat = function(options)
    {
        $.chat.options = $.extend({
            animationSpeed:         500,
            chatId:                 'chat',
            friendListId:           'chat-friend-list',
            friendListContainerId:  'chat-friend-list-container',
            friendListSearchId:     'chat-friend-list-search',
            chatNotifyId:           'chat-notify',
            chatTitleClass:         'chat-title',
            chatDialogClass:        'chat-dialog',
            chatDisplayClass:       'chat-display',
            chatFormClass:          'chat-form',
            chatInputClass:         'chat-input',
            chatMessagesClass:      'chat-messages',
            chatAvatarClass:        'chat-avatar',
        }, options);
        return $(this).click(function()
        {
            $.fn.chat.openFriendList();
            return true;
        });
    };

    $.fn.chat.showAvatar = function(id)
    {
        if ( avatars[id] )
        {
            $('.chat-avatar-' + id).replaceWith(avatars[id]);
        }
        else if ( avatars[id] === undefined )
        {
            avatars[id] = false;
            $.get(
                $.configures.chatAvatarUrl,
                {
                    id: id
                },
                function(response)
                {
                    var id = response.id;
                    avatars[id] = response.avatar;
                    $('.chat-avatar-' + id).replaceWith(avatars[id]);
                }
            );
        }
    };

    $.fn.chat.notify = function(dialog)
    {
        $('#' + $.chat.options.chatNotifyId).get(0).play();
        dialog.data('timer', setInterval(function()
        {
            dialog.children('.' + $.chat.options.chatTitleClass).highlight();
        }, 1000)).children('.' + $.chat.options.chatTitleClass).one('click', function()
        {
            clearInterval($(this).parent().data('timer'));
        });
    };

    $.fn.chat.updateFriendStatus = function(id)
    {
        $('.friend-list-entry').each(function()
        {
            var entry = $(this);
            $('.' + $.chat.options.chatDialogClass).each(function(index)
            {
                if ( $(this).data('id') == entry.data('id') )
                {
                    var title = $(this)
                        .children('.' + $.chat.options.chatTitleClass);
                    title.children('p').text(entry.children('p').text());
                    if ( entry.data('online') )
                    {
                        title.children('span').addClass('online');
                    }
                    else
                    {
                        title.children('span').removeClass('online');
                    }
                }
            });
            if ( entry.data('online') )
            {
                entry.addClass('online');
            }
            else
            {
                entry.removeClass('online');
            }
        });
    };

    $.fn.chat.createFriendList = function()
    {
        var list = $('#' + $.chat.options.friendListId);
        if ( list.length == 0 )
        {
            var title = $('<span></span>')
                .text('談天說地')
                .click(function()
                {
                    $.fn.chat.closeFriendList();
                });
            var display = $('<div></div>')
                .attr('id', $.chat.options.friendListContainerId);
            var search = $('<input />')
                .attr('type', 'text')
                .attr('id', $.chat.options.friendListSearchId)
                .keyup(function(event)
                {
                    var name = $(this).val().toLowerCase();
                    for ( var key in friends )
                    {
                        var data = friends[key];
                        if ( data[1].toLowerCase().search(name) == 0 )
                        {
                            data[2].show();
                        }
                        else
                        {
                            data[2].hide();
                        }
                    }
                });
            var source = $('#' + $.chat.options.chatId).attr('notify');
            var notify = $('<audio></audio>')
                .append(
                    $('<source></source>')
                        .attr('src', source + '.ogg')
                        .attr('type', 'audio/ogg')
                )
                .append(
                    $('<source></source>')
                        .attr('src', source + '.mp3')
                        .attr('type', 'audio/mp3')
                )
                .append(
                    $('<source></source>')
                        .attr('src', source + '.wav')
                        .attr('type', 'audio/wav')
                )
                .attr('id', $.chat.options.chatNotifyId);
            list = $('<div></div>')
                .attr('id', $.chat.options.friendListId)
                .append(title)
                .append(display)
                .append(search)
                .append(notify)
                .appendTo($('body'));
            display.scrollable();
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
        for ( var key in response )
        {
            var data = response[key];
            var entry = null;
            $('#' + $.chat.options.friendListContainerId)
                .find('.friend-list-entry')
                .each(function()
                {
                    if ( $(this).data('id') == data.id ) entry = $(this);
                });
            if ( ! entry )
            {
                var placehold = $('<div></div>')
                    .addClass('chat-avatar-' + data.id);
                var name = $('<p>')
                    .text(data.name);
                entry = $('<div></div>')
                    .data('id', data.id)
                    .addClass('friend-list-entry')
                    .click(function()
                    {
                        $.fn.chat.showChatDialog($(this).data('id'));
                    })
                    .append(placehold)
                    .append(name)
                    .appendTo($('#' + $.chat.options.friendListContainerId));
                friends[friends.length] = [data.id, data.name, entry];
                $.fn.chat.showAvatar(data.id);
            }
            entry.data('online', data.active);
            $.fn.chat.updateFriendStatus(data.id);
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
                .append($('<span></span>'))
                .append($('<p></p>'))
                .append($('<button></button>'))
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
                    var message = input.val();
                    $.fn.chat.updateChatDialog(id, message);
                    $.fn.chat.queueMessage(id, message);
                    input.val('');
                    return false;
                })
                .append(input);
            dialog = $('<div></div>')
                .data('id', id)
                .data('show', true)
                .addClass($.chat.options.chatDialogClass)
                .append(title)
                .append(display)
                .append(form)
                .insertBefore(list);
            dialog.css({
                left: left - dialog.outerWidth(true) * size
            });
            display.scrollable({
                scrollableClass:    false
            });
            title.children('button').click(function()
            {
                $.fn.chat.closeChatDialog(dialog.data('id'));
            });
            dialog.data('show', $.cookie('chat-dialog-' + dialog.data('id')) === 'true');
            if ( ! dialog.data('show') )
            {
                dialog.css({
                    bottom: -1 * dialog.height() + dialog.children('.chat-title').height()
                });
            }
            $.fn.chat.updateChatDialogsPosition();
            $.get(
                $.configures.chatOpenUrl.replace(':id', id),
                function(response)
                {
                    if ( $.errors(response.errors) )
                    {
                        for ( var key in response.messages )
                        {
                            var data = response.messages[key];
                            $.fn.chat.updateChatDialog(data.id, data);
                        }
                    }
                }
            );
            $.fn.chat.updateFriendStatus(id);
        }
        return dialog;
    };

    $.fn.chat.showChatDialog = function(id)
    {
        var dialog = $.fn.chat.createChatDialog(id);
        dialog.animate({
            bottom: 0
        }, $.chat.options.animationSpeed).data('show', true);
        $.cookie('chat-dialog-' + dialog.data('id'), 'true');
        $.fn.chat.updateChatDialogsPosition();
        return dialog;
    };

    $.fn.chat.updateChatDialog = function(id, data)
    {
        var name = '';
        var exists = false;
        var dialog = $.fn.chat.createChatDialog(id);
        dialog.find('.' + $.chat.options.chatDisplayClass)
            .each(function()
            {
                $(this).find('p').each(function()
                {
                    if ( $(this).data('uuid') == data.uuid ) exists = true;
                    name = $(this).data('name');
                });
                if ( ! exists )
                {
                    var message = $('<p></p>')
                        .data('uuid', data.uuid)
                        .data('name', data.name);
                    if ( name != data.name )
                    {
                        var entry = $('<div></div>')
                            .addClass($.chat.options.chatMessagesClass)
                            .appendTo($(this));
                        var avatar = $('<div></div>')
                            .data('name', data.name)
                            .addClass($.chat.options.chatAvatarClass)
                            .hover(function()
                            {
                                $('<div></div>')
                                    .attr('id', 'chat-name')
                                    .css({
                                        left: entry.offset().left - $(window).scrollLeft(),
                                        top: entry.offset().top - $(window).scrollTop()
                                    })
                                    .append($('<p></p>').text(data.name))
                                    .append($('<span></span>').addClass('arrow'))
                                    .appendTo($('body'));
                            }, function()
                            {
                                $('#chat-name').remove();
                            })
                            .appendTo(entry);
                        var placehold = $('<div></div>')
                            .addClass('chat-avatar-' + data.avatar)
                            .appendTo(avatar);
                        $.fn.chat.showAvatar(data.avatar);
                    }
                    if ( ! dialog.data('show') ) $.fn.chat.notify(dialog);
                    message.text(data.message);
                    message.appendTo($(this).children('div').last());
                    $(this).scrollTo($(this).height());
                }
            }
        );
        return dialog;
    };

    $.fn.chat.hideChatDialog = function(id)
    {
        var dialog = $.fn.chat.createChatDialog(id);
        dialog.animate({
            bottom: -1 * dialog.height() + dialog.children('.chat-title').height()
        }, $.chat.options.animationSpeed).data('show', false);
        $.cookie('chat-dialog-' + dialog.data('id'), 'false');
        $.fn.chat.updateChatDialogsPosition();
        return dialog;
    };

    $.fn.chat.closeChatDialog = function(id)
    {
        $.post(
            $.configures.chatCloseUrl,
            {
                receiver: id,
                token: $.configures.token
            },
            function(response)
            {
                $.pull.pause();
                $.configures.token = response.token;
                $.errors(response.errors);
                $.pull.restart();
            }
        );
        $.fn.chat.createChatDialog(id).remove();
        $.fn.chat.updateChatDialogsPosition();
    };

    $.fn.chat.queueMessage = function(id, message)
    {
        queues[queues.length] = {
            receiver: id,
            message: message,
            sequence: $.configures.sequence++
        };
        $.push.start();
        return true;
    };

    $.fn.getMessageQueue = function()
    {
        var messages = queues;
        if ( queues.length === 0 ) return false;
        queues = [];
        return messages;
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
                    var left = parseInt(position[0]);
                    var top = parseInt(position[1]);
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
        return $(this).each(function()
        {
            var original = $(this).css('background-color');
            $(this).stop().css('background-color', color || '#FFFF9C').animate({
                backgroundColor: original
            }, duration || 600);
        });
    };
})(jQuery);

/**
 * Scrollable
 */
(function($)
{
    $.fn.scrollable = function(options)
    {
        var options = $.extend({
            scrollableClass:        null,
            fadeInDuration:         'slow',
            fadeOutDuration:        'slow',
            wheelSpeed:             48
        }, options);
        return this.each(function()
        {
            var active = false;
            var inside = false;
            var scrollHeight = 0;
            var scrollWidth = (function()
            {
                var inner = document.createElement('p');
                inner.style.width = '100%';
                inner.style.height = '200px';

                var outer = document.createElement('div');
                outer.style.position = 'absolute';
                outer.style.top = '0px';
                outer.style.left = '0px';
                outer.style.visibility = 'hidden';
                outer.style.width = '200px';
                outer.style.height = '150px';
                outer.style.overflow = 'hidden';
                outer.appendChild(inner);

                document.body.appendChild (outer);
                var w1 = inner.offsetWidth;
                outer.style.overflow = 'scroll';
                var w2 = inner.offsetWidth;
                if (w1 == w2) w2 = outer.clientWidth;

                document.body.removeChild (outer);
                return (w1 - w2);
            })();
            var updateScrollDraggableHeight = function()
            {
                var originalHeight = parseInt(scrollDragable.css('height'));
                var scrollContentHeight = scrollContent.height();
                var scrollBarHeight = scrollBar.height();
                var height = 0;
                if ( scrollContent.width() - scrollContainer.width() >= 0 )
                {
                    scrollArea.css({
                        width: scrollContainer.width() + scrollWidth
                    });
                }
                if ( scrollContentHeight > scrollBarHeight )
                {
                    height = scrollBarHeight
                           * scrollBarHeight
                           / scrollContentHeight;
                }
                if ( height != originalHeight )
                {
                    var position = scrollArea.scrollTop();
                    scrollArea.scrollTop(scrollArea.prop('scrollHeight'));
                    scrollHeight = scrollArea.scrollTop();
                    scrollArea.scrollTop(position);
                }
                scrollDragable.css({
                    height: height
                });
                return height;
            };
            var scrollContainer = $('<div></div>')
                .addClass('scroll-container')
                .css({
                    overflow: 'hidden'
                })
                .mouseenter(function()
                {
                    if ( updateScrollDraggableHeight() )
                    {
                        scrollBar
                            .stop(true, true)
                            .fadeIn(options.fadeInDuration);
                    }
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
                .css({
                    height: '100%',
                    overflowX: 'hidden',
                    overflowY: 'scroll',
                    width: '100%'
                })
                .appendTo(scrollContainer);
            var scrollContent = $('<div></div>')
                .addClass('scroll-content')
                .one(
                    'mousewheel',
                    function()
                    {
                        showScrollBar();
                        $(this).off('mousewheel', showScrollBar);
                    }
                )
                .mousewheel(function(event, delta)
                {
                    var top = parseInt(scrollDragable.css('top'));
                    var multiplier =
                        2
                      * options.wheelSpeed
                      * (scrollContainer.height() - scrollDragable.height())
                      / $(this).outerHeight();
                    updateScrollDragable(top - delta * multiplier);
                    return false;
                })
                .mousedown(function(event)
                {
                    if ( event.which === 1 )
                    {
                        var timer = setInterval(function()
                        {
                            scrollDragable.css({
                                top: (scrollTrack.height()
                                   - updateScrollDraggableHeight())
                                   * scrollArea.scrollTop()
                                   / scrollHeight
                            });
                        }, 1);
                        var revert = function()
                        {
                            active = false;
                            $(document).off('mouseup', revert);
                            clearInterval(timer);
                        };
                        $(document).on('mouseup', revert);
                        active = true;
                    }
                })
                .wrapInner($(this))
                .appendTo(scrollArea);
            var scrollBar = $('<div></div>')
                .addClass('scroll-bar')
                .insertAfter(scrollContent);
            var scrollTrack = $('<div></div>')
                .addClass('scroll-track')
                .mousedown(function(event)
                {
                    if ( event.which === 1 )
                    {
                        var y = event.pageY;
                        var top = $(this).offset().top;
                        var height = updateScrollDraggableHeight();
                        updateScrollDragable(y - top - height / 2);
                        return false;
                    }
                })
                .appendTo(scrollBar);
            var scrollDragable = $('<div></div>')
                .addClass('scroll-dragable')
                .mousedown(function(event)
                {
                    if ( event.which === 1 )
                    {
                        var origin = parseInt(scrollDragable.css('top')) - event.pageY;
                        var stop = function()
                        {
                            $(document)
                                .unbind('mouseup', stop)
                                .unbind('mousemove', update);
                            if ( ! inside )
                            {
                                scrollBar
                                    .stop(true, true)
                                    .fadeOut(options.fadeInDuration);
                            }
                            active = false;
                        };
                        var update = function(event)
                        {
                            updateScrollDragable(origin + event.pageY);
                        };
                        $(document)
                            .bind('mouseup', stop)
                            .bind('mouseleave', stop)
                            .bind('mousemove', update);
                        active = true;
                        return false;
                    }
                })
                .appendTo(scrollTrack);
            var showScrollBar = function()
            {
                if ( updateScrollDraggableHeight() )
                {
                    scrollBar
                        .stop(true, true)
                        .fadeIn(options.fadeInDuration);
                }
                inside = true;
            };
            var updateScrollDragable = function(position)
            {
                var scrollDraggableHeight = updateScrollDraggableHeight();
                var maximum = scrollTrack.height() - scrollDraggableHeight;
                if ( position <= 0 ) position = 0;
                if ( position >= maximum ) position = maximum;
                scrollDragable.css({
                    top: position
                });
                scrollArea.scrollTop(scrollArea.prop('scrollHeight'));
                scrollArea.scrollTop(
                    scrollArea.scrollTop()
                  * position
                  / maximum
                );
                return $(this);
            };
            if ( options.scrollableClass )
            {
                scrollContainer.addClass(options.scrollableClass);
            } else if ( options.scrollableClass === null )
            {
                var classes = $(this).attr('class') ? $(this).attr('class') : '';
                $.each(classes.split(' '), (function(object)
                {
                    return function(index, value)
                    {
                        $(object).removeClass(value);
                    };
                })(this));
                scrollContainer.addClass(classes);
            }
            $.extend($(this).constructor.prototype, {
                scrollTo: function(position)
                {
                    var scrollDraggableHeight = updateScrollDraggableHeight();
                    scrollArea.scrollTop(position);
                    if ( scrollHeight )
                    {
                        scrollContainer.mouseenter().mouseleave();
                        updateScrollDragable((scrollTrack.height()
                                            - scrollDraggableHeight)
                                            * position
                                            / scrollHeight);
                    }
                }
            });
            updateScrollDraggableHeight();
            scrollContainer.one('mousemove', function()
            {
                showScrollBar();
                scrollContainer.off('mousemove', showScrollBar);
            });
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
                var position = parseInt(items.css('top')) - items.height();
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
                  * parseInt(getTimeSeconds() / options.interval)
                  % (options.horizontalFrames * options.verticalFrames);
            var x = t
                  % options.horizontalFrames
                  * options.frameXDimension;
            var y = parseInt(t / options.horizontalFrames)
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
    var getToday = function()
    {
        var date = new Date();
        var current_year = date.getFullYear();
        var current_day = date.getDate();
        var current_month = date.getMonth();
        var calendar_year = $(this).data('options').year;
        var calendar_month = $(this).data('options').month;
        if ( current_month == calendar_month && current_year ==  calendar_year )
        {
            var tds = $(this).children('tbody').find('td');
            for( var key in tds )
            {
                if ( $(tds[key]).data('day') == current_day ) return $(tds[key]);
            }
        }
        return false;
    }

    var updateData = function(url, callback)
    {
        var self = this;
        // $.getJSON( url, function(data){
            // self.cleanUpMark(true);
            // for ( var key in data.events )
            // {
                // self.markEvent(data.events[key], { textDecoration: 'underline'});
            // }
            // self.markToday();
            // self.data('all_events', data.events);
            // if ( callback ) 
            // {
                // callback(self);
            // }
        // });
        $.get( url, {
            m : self.data('options').month,
            y : self.data('options').year
        }, function(data){
            self.cleanUpMark(true);
            for ( var key in data.events )
            {
                self.markEvent(data.events[key], { textDecoration: 'underline'});
            }
            self.markToday();
            self.data('all_events', data.events);
            if ( callback ) 
            {
                callback(self);
            }
        } );
        return this;
    }

    var markToday = function()
    {
        var today = this.getToday();
        if ( today ) today.addClass('today');
    }

    /**
     * Marks an event on calendar with specified css
     * params var event    {event_id, start, end}
     */
    var markEvent = function(event, css)
    {
        css = $.extend({}, css);
        event = $.extend({
            id: 0,
            start: 0,
            end: 0
        }, event);
        var id      = event.id;
        var start   = event.start - (new Date()).getTimezoneOffset()*60;
        var end     = event.end - (new Date()).getTimezoneOffset()*60;
        var days    = [];
        var date    = function( timestamp )
        {
            return (new Date(timestamp * 1000));
        }
        for( var time = start; time <= end; time+=86400 )
        {
            if( this.data('options').month ==  date(time).getMonth() 
                && this.data('options').year == date(time).getFullYear() )
            {
                days[days.length] = date(time).getDate();
            }
        }
        $(this).children('tbody').find('td').each(function(index, element){
            if( days.indexOf($(this).data('day')) != -1)
            {
                $(this).css(css);
                var cal_events = $(this).data('cal_events')?$(this).data('cal_events'):[];
                var found = false;
                for( var key in cal_events )
                {
                    if( cal_events[key].id == event.id )
                    {
                        found = true; 
                        break;
                    }
                }
                if ( ! found )
                {
                    cal_events[cal_events.length] = event;
                    $(this).data('cal_events', cal_events);
                }
            }
        });
        return this;
    }

    var cleanUpMark = function(isRemoveData)
    {
        return $(this).children('tbody').find('td').each(function(){
            $(this).removeAttr('style').removeClass();
            if ( isRemoveData ) 
            {
                $(this).removeData('cal_events');
            }
        });
    }

    /**
     * Update the list of events
     */
    var updateEventsList = function(cal_events, container)
    {
        var self = this;
        var date = function(timestamp)
        {
            return (new Date(timestamp * 1000));
        }
        var eventMouseEnter = function()
        {
            self.cleanUpMark();
            $(self).markEvent($(this).data('event'), {
                color: '#095296',
                background : '#80c2fe'
            });
        }
        var eventMouseLeave = function(){
            self.cleanUpMark();
            for( var key in self.data('all_events') )
            {
                self.markEvent(self.data('all_events')[key], { textDecoration: 'underline'});
            }
            self.markToday();
        }
        $(container).empty();
        if ( cal_events && cal_events.length )
        {
            var event_ids = [];
            for( var key in cal_events )
            {
                event_ids[key] = cal_events[key].id;
            }
            $.post($.configures.calendarEventsUrl, { 
                event_ids : event_ids,
                token : $.configures.token
            }, function(data){
                
                for( var key in data.events )
                {
                    var div = $('<div></div>');
                    var header = $('<h4></h4>').text(key);
                    var ul = $('<ul></ul>');
                    for ( var key2 in data.events[key] )
                    {
                        $('<li></li>')
                            .append(
                                $('<a></a>')
                                    .text(data.events[key][key2].name)
                                    .attr(
                                        'href', 
                                        $.configures
                                            .calendarEventUrl
                                            .replace(':id', data.events[key][key2].id)
                                    )
                            )
                            .append(
                                $('<a></a>')
                                    .addClass('calendar-hide-event')
                                    .attr('title', '丟進回收桶')
                                    .attr('href', '#' + data.events[key][key2].id)
                                    .text('把我丟掉')
                            )
                            .data('event', data.events[key][key2])
                            .mouseenter(eventMouseEnter)
                            .mouseleave(eventMouseLeave)
                            .appendTo(ul);
                    }
                    div.append(header).append(ul).appendTo(container);
                }
                $.configures.token = data.token;
            });
        }
    }

    $.generateTodolist = function(events, options)
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

    $.generateCalendar = function(options)
    {
        options = $.extend({
            year:        (new Date()).getFullYear(),
            month:       (new Date()).getMonth() + 1,
            tableClass:  'calendar-table', 
            buttonClass: 'calendar-button',
            month_tc:    ['一月', '二月', '三月', '四月', '五月', '六月', '七月', '八月', '九月', '十月', '十一月', '十二月'], 
            month_en:    ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'], 
            dayOfWeek:   ['日', '一', '二', '三', '四', '五', '六'], 
            today:       true,
            left:        false,
            right:       false,
            linkClick:   function() { return false; },
            leftClick:   function() { return false; },
            rightClick:  function() { return false; },
            dayClick:    function(event) {},
            dayEnter:    function(event) {},
            dayLeave:    function(event) {}
        }, options);

        options.month -= 1;
        var table = $('<table></table>')
            .addClass(options.tableClass);
        table.data('options', options);
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
        for( var day = 1, position = 0; day <= $.daysInMonth(options.month, options.year); position++ )
        {
            if ( position%7 == 0 )
            {
                tr = $('<tr></tr>');
                tr.appendTo(tbody);
            }
            var td = $('<td></td>');
            if ( position>=date.getDay() )
            {
                td
                    .text(day)
                    .click(options.dayClick)
                    .mouseenter(options.dayEnter)
                    .mouseleave(options.dayLeave)
                    .data('day', day);
                var d = new Date();
                if( d.getDate() == day 
                    && d.getMonth() == options.month
                    && d.getFullYear() == options.year
                    && options.today )
                {
                    td.addClass('today');
                }
                ++day;
            }
            td.appendTo(tr);
        }
        $.extend(table.constructor.prototype,{
            markToday: markToday,
            markEvent: markEvent,
            cleanUpMark: cleanUpMark,
            updateEventsList: updateEventsList,
            updateData: updateData,
            getToday: getToday
        });
        return table.append(caption)
            .append(thead)
            .append(tbody);
    }

    $.fn.calendar = function(url)
    {
        var todolist;
        var container = $(this);
        var updateTodolist = function()
        {
            var events = $(this).data('cal_events');
            var todos = [];
            if ( todolist ) todolist.remove();
            for ( var key in events )
            {
                var start = new Date((events[key].start - (new Date()).getTimezoneOffset() * 60) * 1000);
                var end = new Date((events[key].end - (new Date()).getTimezoneOffset() * 60) * 1000);
                todos[key]=
                [
                    (start.getMonth()+1) + '/' + start.getDate() + ' ~ ' + (end.getMonth()+1) + '/' + end.getDate(),
                    events[key].name
                ];
            }
            todolist = $.generateTodolist(todos).appendTo(container);
            return todolist;
        };
        var generate = function(year, month)
        {
            var calendar = $.generateCalendar({
                year: year,
                month: month,
                right: true,
                rightClick: function()
                {
                    if ( ++month > 12 )
                    {
                        year += 1;
                        month = 1;
                    }
                    calendar.remove();
                    if ( todolist ) todolist.remove();
                    calendar = generate(year, month);
                    return false;
                },
                left: true,
                leftClick: function()
                {
                    if ( --month < 1 )
                    {
                        year -= 1;
                        month = 12;
                    }
                    calendar.remove();
                    if ( todolist ) todolist.remove();
                    calendar = generate(year, month);
                    return false;
                },
                dayClick: function()
                {
                    $(this).parent().parent().find('td').removeClass('selected');
                    $(this).addClass('selected');
                    updateTodolist.call(this);
                },
                dayEnter: function()
                {
                    $(this).addClass('hover');
                },
                dayLeave: function()
                {
                    $(this).removeClass('hover');
                }
            }).appendTo(container);
            calendar.find('caption a:eq(1)').text(year + '年' + month + '月');
            calendar.updateData(url, function()
            {
                return updateTodolist.call(calendar.getToday());
            });
            return calendar;
        };
        var calendar = generate((new Date()).getFullYear(), (new Date()).getMonth() + 1);
        return this;
    };

    /**
     * Initialize the personal calendar
     */
    $.calendar = function(options)
    {
        options = $.extend({
            calendar_container: '#personal-calendar .left',
            events_container:   '#personal-calendar .right',
            date_container:     '#personal-calendar .date',
            prompt:             '#personal-calendar .prompt',
            eventsUrl:           $.configures.calendarEventsUrl
        }, options);
        var current_year = (new Date()).getFullYear();
        var current_month = (new Date()).getMonth() + 1;
        var container = options.calendar_container;
        var events_container = $(options.events_container);
        var date_container = $(options.date_container);
        var prompt = $(options.prompt)
            .css({
                position: 'absolute',
                display:  'none'
            });
        var geneator = function(year, month)
        {
            if ( calendar ) calendar.remove();
            calendar = jQuery.generateCalendar({
                year: year,
                month: month,
                left: true,
                right: true,
                leftClick: function()
                {
                    if ( --month < 1 )
                    {
                        month = 12;
                        year -= 1;
                    }
                    geneator(year, month);
                    return false;
                },
                rightClick: function()
                {
                    if ( ++month > 12 )
                    {
                        month = 1;
                        year += 1;
                    }
                    geneator(year, month);
                    return false;
                },
                dayClick: function()
                {
                    $(date_container).text(
                        $(calendar).data('options').year + '.'
                        + ($(calendar).data('options').month+1) + '.'
                        + $(this).text()
                    );
                    $(calendar).updateEventsList($(this).data('cal_events'), events_container);
                },
                dayEnter: function(event)
                {
                    var events = $(this).data('cal_events');
                    if( events && events.length > 0 )
                    {
                        for( var key in $(this).data('cal_events') )
                        {
                            $('<li></li>').text(events[key].name).appendTo(prompt.find('ul'));
                        }
                        var left = $(this).parents('table').offset().left + event.currentTarget.offsetLeft;
                        var top = $(this).parents('table').offset().top + event.currentTarget.offsetTop - prompt.height();
                        prompt.css({
                            top: top,
                            left: left,
                            display: 'inline-block'
                        });
                    }
                },
                dayLeave: function()
                {
                    prompt.find('ul').empty();
                    prompt.hide();
                }
            });
            calendar.appendTo(container);
            calendar.updateData(options.eventsUrl, function(self)
            {
                if( $(self).getToday() )
                {
                    self.updateEventsList($(self).getToday().data('cal_events'), events_container);
                    $(date_container).text(
                        $(self).data('options').year + '.'
                        + ($(self).data('options').month+1) + '.'
                        + $(self).getToday().text()
                    );
                }
            });
            return calendar;
        };
        var calendar = geneator(current_year, current_month);
        return calendar;
    }

    $.calendarCreate = function (){
        $('.calendar-cancel-button').click(function()
        {
            $.confirm({
                message: '確定取消編輯此篇文章？',
                confirmed: function(result)
                {
                    if ( result ) window.location = $.configures.calendarViewUrl;
                    return false;
                }
            });
            return false;
        });
    };
    
    $.calendarRecycle = function()
    {
        $('a.calendar-hide-event').click(function()
        {
            var id = $(this).attr('href').replace('#', '');
            var li = $(this).parent();
            var ul = li.parent();
            var div = ul.parent();
            $.confirm({
                message: '你真的想要隱藏事件嗎？',
                confirmed: function(result)
                {
                    if ( result === true )
                    {
                        $.post(
                            window.location.href,
                            {
                                calendar:
                                {
                                    id: id
                                },
                                token: $.configures.token
                            },
                            function(response)
                            {
                                $.configures.token = response.token;
                                if ( $.errors(response.errors) )
                                {
                                    li.remove();
                                    if ( $.trim(ul.html()) == '' ) div.remove();
                                }
                            }
                        );
                    }
                }
            });
            return false;
        });
        
        $('a.calendar-show-event').click(function()
        {
            var id = $(this).attr('href').replace('#', '');
            var li = $(this).parent();
            var ul = li.parent();
            var div = ul.parent();
            $.post(
                $.configures.calendarShowEventsUrl,
                {
                    calendar:
                    {
                        id: id
                    },
                    token: $.configures.token
                },
                function(response)
                {
                    $.configures.token = response.token;
                    if ( $.errors(response.errors) )
                    {
                        li.remove();
                        if ( $.trim(ul.html()) == '' ) div.remove();
                    }
                }
            );
        });
        
        $('#calendar-recycle .container').scrollable();
    };
    
    $.calendarView = function()
    {
        var calendar = $.calendar({
            calendar_container: '#personal-calendar .left',
            events_container:   '#personal-calendar .right',
            date_container:     '#personal-calendar .date',
            prompt:             '#personal-calendar .prompt',
            eventsUrl:           $.configures.calendarEventsUrl
        });
        $('a.calendar-hide-event').live('click', function()
        {
            var id = $(this).attr('href').replace('#', '');
            var self = this;
            var li = $(this).parents('li');
            var ul = li.parent();
            var div = ul.parent();
            $.post(
                $.configures.calendarHideEventUrl,
                {
                    calendar:
                    {
                        id: id
                    },
                    token: $.configures.token
                },
                function(response)
                {
                    $.configures.token = response.token;
                    if ( $.errors(response.errors) )
                    {
                        li.remove();
                        if ( $.trim(ul.html()) == '' ) div.remove();
                        calendar.updateData($.configures.calendarEventsUrl);
                    }
                }
            );
            return false;
        });
    };

    $.calendarSubscript =  function()
    {
        $('.category-button').click(function()
        {
            var id = $(this).attr('href').replace('#','');
            $('.calendar-subscript-category').hide();
            $('#calendar-subscript-category-' + id).show();
        });
        $('.category-button').first().click();
        $('.calendar-subscript-container').scrollable();
    };
    
    $.calendarClub =  function()
    {
        var club_id = $('#calendar-club').attr('club');
        var calendar = $.calendar({
            calendar_container: '#calendar-club .left',
            events_container:   '#calendar-club .right',
            date_container:     '#calendar-club .date',
            prompt:             '#calendar-club .prompt',
            eventsUrl:           $.configures.calendarClubEventsUrl.replace(':id', 0)
        });
        $('a.calendar-hide-event').live('click', function()
        {
            var id = $(this).attr('href').replace('#', '');
            var self = this;
            $.confirm({
                confirmed: function(result)
                {
                    if ( result )
                    {
                        $.post(
                            $.configures.calendarClubRecycleUrl.replace(':id', club_id),
                            {
                                calendar:
                                {
                                    id: id
                                },
                                token: $.configures.token
                            },
                            function(response)
                            {
                                $.configures.token = response.token;
                                if ( $.errors(response.errors) )
                                {
                                    $(self).parents('li').remove();
                                    calendar.updateData($.configures.calendarClubEventsUrl.replace(':id', 0));
                                }
                            }
                        );
                    }
                },
                message: '刪除將無法復原，您確定要刪除嗎？'
            });
            return false;
        });
    };

    $.calendarEvent = function()
    {
        $('#calendar-event div.container').scrollable({
            scrollableClass:    false
        });
    };

})(jQuery);

/**
 * Dialog
 */
(function($)
{
    $.dialog = {};

    $.fn.dialog = function(options)
    {
        return $(this).each(function()
        {
            this.options =  $.extend({
                width:          $(this).width(),
                height:         $(this).height(),
                modal:          false,
                escape:         true,
                closeButton:    true,
                speed:          'fast',
                effect:         'none',
                dialogClass:    'dialog',
                closeText:      'close',
                closeClass:     'dialog-close-button',
                openEffect:     function(speed) { $(this).fadeIn(speed); },
                closeEffect:    function(speed) { $(this).fadeOut(speed); },
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
        target.overlay = $.overlay({
            closeOnClick:   ! target.options.modal,
            closeOnEscape:  target.options.escape,
            onBeforeHide:   function()
            {
                target.options.onClose.call(target);
                target.options.closeEffect.call(target, target.options.speed);
                return true;
            }
        });
        if ( ! $(target).hasClass(target.options.dialogClass) )
        {
            $.fn.dialog.create(target);
        }
        target.options.openEffect.call(target, target.options.speed);
    }     

    $.fn.dialog.close = function(target)
    {
        target.overlay.close(target.overlay.index);
    }

    $.fn.dialog.create = function(target)
    {
        target.options.width = parseInt(target.options.width);
        target.options.height = parseInt(target.options.height);
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
                position: $(target).css('position') === 'static'
                        ? 'absolute'
                        : $(target).css('position'),
                top: '50%',
                left: '50%',
                width: target.options.width,
                height: target.options.height,
                marginLeft: -1 * target.options.width / 2,
                marginTop: -1 * target.options.height / 2,
                padding: 0,
                display: 'none'
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
 * Confirm
 */
(function($)
{
    $.confirm = function(options)
    {
        var options = $.extend({
            confirmClass:       'confirm',
            titleClass:         'confirm-title',
            messageClass:       'confirm-message',
            buttonsClass:       'confirm-buttons',
            buttonClass:        'confirm-button',
            title:              null,
            message:            '',
            buttons:            {
                '取消':         function() { return false; },
                '確定':         function() { return true; }
            },
            confirmed:          function(result) { return true; }
        }, options);

        var dialog = $('<div></div>')
            .addClass(options.confirmClass)
            .appendTo($('body'));

        var message = $('<p></p>')
            .addClass(options.messageClass)
            .text(options.message)
            .appendTo(dialog);

        var buttons = $('<div></div>')
            .addClass(options.buttonsClass)
            .appendTo(dialog);

        if ( options.title )
        {
            var title = $('<h4></h4>')
                .addClass(options.titleClass)
                .text(options.title)
                .prependTo(dialog);
        }

        for ( var button in options.buttons )
        {
            $('<button></button>')
                .addClass(options.buttonClass)
                .text(button)
                .data('evaluation', options.buttons[button])
                .click(function()
                {
                    var evaluation = $(this).data('evaluation');
                    dialog.dialog('close');
                    return options.confirmed(evaluation());
                })
                .appendTo(buttons);
        }

        return dialog.dialog({
            modal:          true,
            escape:         false,
            closeButton:    false
        }).find('button').last().focus();
    };
})(jQuery);

/**
 * Alert
 */
(function($)
{
    $.alert = function(settings)
    {
        var options = $.extend({
            confirmClass:       'alert',
            titleClass:         'alert-title',
            messageClass:       'alert-message',
            title:              null,
            message:            '',
            button:             '確定',
            confirmed:          function(result) { return true; }
        }, settings);

        var buttons = {
        };

        buttons[options.button] = function() { return true; };

        return $.confirm({
            confirmClass:       'alert',
            titleClass:         'alert-title',
            messageClass:       'alert-message',
            title:              null,
            message:            options.message,
            buttons:            buttons,
            confirmed:          options.confirmed
        });
    };
})(jQuery);

/**
 * Overlay
 */
(function($)
{
    var elements = {};

    var overlayCloseInternal = function(data)
    {
        var overlay = data[0];
        var options = data[1];
        var escape = data[2];
        if ( ! options.onBeforeHide() ) return false;
        $(overlay).fadeOut(options.speed, function()
        {
            options.onHide();
            $(overlay).remove();
            $(document).off('keyup', escape);
        });
        return true;
    };

    var overlayClose = function(uuid, index)
    {
        if ( index === undefined )
        {
            for ( var index in elements[uuid] )
            {
                var data = elements[uuid][index];
                if ( ! overlayCloseInternal(data) ) return false;
            }
            elements[uuid] = [];
        }
        else
        {
            var data = elements[uuid][index];
            if ( ! overlayCloseInternal(data) ) return false;
            delete elements[uuid][index];
        }
        return true;
    };

    $.overlay = function(options)
    {
        return $(window).overlay(options);
    };

    $.fn.overlay = function(options)
    {
        var index = $.generateUUID();
        var options = $.extend({
            overlayClass:   'overlay',
            speed:          'fast',
            closeOnClick:   true,
            closeOnEscape:  true,
            onBeforeShow:   function() { return true; },
            onShow:         function() {},
            onBeforeHide:   function() { return true; },
            onHide:         function() {}
        }, options);

        this.index = index;

        return this.each(function()
        {
            var uuid = $(this).data('uuid');

            var overlay = $('<div></div>')
                .addClass(options.overlayClass)
                .css({
                    display:            'none'
                })
                .fadeIn(options.speed, function()
                {
                    if ( options.onBeforeShow() ) return options.onShow();
                    return false;
                })
                .appendTo($('body'));

            var escape = function(event)
            {
                if ( event.keyCode == 27 )
                {
                    return overlayClose(uuid);
                }
                return true;
            };

            if ( ! uuid )
            {
                uuid = $.generateUUID();
                elements[uuid] = [];
                $(this).data('uuid', uuid);
            }

            if ( this !== window )
            {
                overlay.css({
                    height:             $(this).height(),
                    left:               $(this).offset().left,
                    position:           $(this).css('position'),
                    top:                $(this).offset().top,
                    width:              $(this).width()
                });
            }
            if ( options.closeOnClick )
            {
                overlay.on('click', function()
                {
                    return overlayClose(uuid);
                });
            }
            if ( options.closeOnEscape ) $(document).on('keyup', escape);
            $.extend(overlay.constructor.prototype, {
                close: function(index)
                {
                    return overlayClose($(this).data('uuid'), index);
                },
                getOverlay: function(index)
                {
                    if ( index ) return elements[$(this).data('uuid')][index][0];
                    return elements[$(this).data('uuid')];
                }
            });
            elements[uuid][index] = [overlay, options, escape];
        });
    }
})(jQuery);

/**
 * Infield
 */
(function ($) {

    $.infield = function(label, field, options)
    {
        var base = this;

        base.$label = $(label);
        base.label  = label;

        base.$field = $(field);
        base.field  = field;

        base.$label.data('infield', base);
        base.showing = true;

        base.init = function ()
        {
            base.options = $.extend({}, $.infield.defaultOptions, options);

            if ( base.$field.val() !== '' )
            {
                base.$label.hide();
                base.showing = false;
            }

            base.$field.focus(function()
            {
                base.fadeOnFocus();
            }).blur(function()
            {
                base.checkForEmpty(true);
            }).bind('keydown.infield', function(event)
            {
                base.hideOnChange(event);
            }).bind('keyup', function()
            {
                if ( ! base.showing && base.$field.val() === '' )
                {
                    base.prepForShow();
                    base.setOpacity(base.options.fadeOpacity);
                }
            }).bind('paste', function(event)
            {
                base.setOpacity(0.0);
            }).change(function(event)
            {
                base.checkForEmpty();
            }).bind('onPropertyChange', function()
            {
                base.checkForEmpty();
            });
        };

        base.fadeOnFocus = function()
        {
            if ( base.showing) base.setOpacity(base.options.fadeOpacity);
        };

        base.setOpacity = function(opacity)
        {
            base.$label.stop().animate({
                opacity: opacity
            }, base.options.fadeDuration);
            base.showing = (opacity > 0.0);
        };

        base.checkForEmpty = function(blur)
        {
            if ( base.$field.val() === '' )
            {
                base.prepForShow();
                base.setOpacity(blur ? 1.0 : base.options.fadeOpacity);
            }
            else
            {
                base.setOpacity(0.0);
            }
        };

        base.prepForShow = function(event)
        {
            if ( ! base.showing )
            {
                base.$label.css({
                    opacity: 0.0
                }).show();

                base.$field.bind('keydown.infield', function(event)
                {
                    base.hideOnChange(event);
                });
            }
        };

        base.hideOnChange = function(event)
        {
            if ( event.keyCode === 16 || event.keyCode === 9 ) return;

            if ( base.showing )
            {
                base.$label.hide();
                base.showing = false;
            }

            base.$field.unbind('keydown.infield');
        };

        base.init();
    };

    $.infield.defaultOptions = {
        fadeOpacity:    0.5,
        fadeDuration:   300
    };

    $.fn.infield = function(options)
    {
        return this.each(function()
        {
            var for_attr = $(this).attr('for');
            var $field;
            if ( ! for_attr ) return;

            $field = $(
                'input#' + for_attr + '[type="text"],' +
                'input#' + for_attr + '[type="search"],' +
                'input#' + for_attr + '[type="tel"],' +
                'input#' + for_attr + '[type="url"],' +
                'input#' + for_attr + '[type="email"],' +
                'input#' + for_attr + '[type="password"],' +
                'textarea#' + for_attr
            );

            if ( $field.length === 0 ) return;

            (new $.infield(this, $field[0], options));
        });
    };
}(jQuery));

/**
 * UltimatePassword
 */
(function($)
{
    $.ultimatePassword = function()
    {
        if ( $('#ultimate-password').length ) return false;
        var input = '';
        var up = 99;
        var uplength = up.toString().length;
        var down = 0;
        var answer = $.random(down + 1, up - 1);
        var run = true;
        var judgment = function(number)
        {
            if ( run == false ) return true;
            errorMessage.text('');
            if ( number >= 0 && number < 10 )
            {
                if ( input.length < uplength ) input += number;
                if ( parseInt(input) > up )
                {
                    errorMessage.text('要輸在範圍內喔!');
                    input = '';
                }
            }
            else if ( number == 10 )
            {
                input = input.substr(0, input.length - 1);
                inputText.attr('value', input);
            }
            else if ( number == 11 )
            {
                input = parseInt( inputText.val() );
                if ( input < up && input > down )
                {
                    if ( input == answer )
                    {
                        back.close();
                        $.alert({
                            message: '恭喜你猜對了!!!'
                        });
                        return true;
                    }
                    else if ( input > answer )
                    {
                        up = input;
                    }
                    else if ( input < answer )
                    {
                        down = input;
                    }
                }
                else
                {
                    errorMessage.text('要輸在範圍內喔!');
                }
                input = '';
            }
            message.text('請輸入數字' + down + '到' + up +'之間');
            inputText.attr('value', input);
            return true;
        };
        var back = $.overlay({
            onBeforeHide: function()
            {
                box.remove();
                run = false;
                return true;
            }
        });
        var box = $('<div></div>').attr('id', 'ultimate-password').appendTo('body');
        var message;
        var inputText;
        var numberTable = $('<table></table>').css({
            margin: '0 auto',
            textAlign: 'center'
        });
        var TableRow = [$('<tr></tr>'), $('<tr></tr>'), $('<tr></tr>'), $('<tr></tr>')];
        var buttons = [];
        $('<h4></h4>').text('終極密碼').addClass('title').appendTo(box);
        message = $('<p></p>').text('請輸入數字' + down + '到' + up +'之間').addClass('message').appendTo(box);
        inputText = $('<input type="text" readonly="readonly" />').attr('value', '').addClass('input').appendTo(box);
        for ( var i = 7; i > 0 ; i = i - 3 )
        {
            for ( var j = 0; j < 3 ; j++ )
            {
                buttons[i + j] = $('<td></td>').text(i + j).addClass('table-box').appendTo(TableRow[ parseInt( i / 3) ]);
            }
        }
        buttons[0] = $('<td></td>').text('0').addClass('table-box').appendTo(TableRow[ 3 ]);
        buttons[10] = $('<td></td>').text('倒退').addClass('table-box').appendTo(TableRow[ 3 ]);
        buttons[11] = $('<td></td>').text('送出').addClass('table-box').appendTo(TableRow[ 3 ]);
        for ( var k = 2; k >= 0; k-- )
        {
            TableRow[k].appendTo(numberTable);
        }
        TableRow[3].appendTo(numberTable);
        numberTable.appendTo(box);
        $('.table-box').each(function(){
            $(this).mouseenter(function(){
                $(this).addClass('enter');
            })
            .mouseleave(function(){
                $(this).removeClass('enter');
                $(this).removeClass('click');
            })
            .click(function()
            {
                $(this).addClass('click');
                if ( $(this).text() == '送出' )
                {
                    judgment(11);
                }
                else if ( $(this).text() == '倒退' )
                {
                    judgment(10);
                }
                else
                {
                    judgment(parseInt($(this).text()));
                }
            });
        })
        $(document).keydown(function(event)
        {
            if ( event.keyCode != 231 && event.keyCode > 95 && event.keyCode < 106 )
            {
                buttons[event.keyCode - 96].addClass('click');
            }
            else if ( event.keyCode != 231 && event.keyCode > 47 && event.keyCode < 58 )
            {
                buttons[event.keyCode - 48].addClass('click');
                judgment(event.keyCode - 48);
            }
            else if ( event.keyCode > 36 && event.keyCode < 41 )
            {
                return false;
            }
            else if ( event.keyCode == 108 || event.keyCode == 13 )
            {
                buttons[11].addClass('click');
            }
            else if ( event.keyCode == 8 )
            {
                buttons[10].addClass('click');
                return false;
            }
            return true;
        });
        $(document).keyup(function(event)
        {
            if ( event.keyCode != 231 && event.keyCode > 95 && event.keyCode < 106)
            {
                buttons[event.keyCode - 96].removeClass('click');
                judgment(event.keyCode - 96);
            }
            else if ( event.keyCode != 231 && event.keyCode > 47 && event.keyCode < 58)
            {
                buttons[event.keyCode - 48].removeClass('click');
                judgment(event.keyCode - 48);
            }
            else if ( event.keyCode == 108 || event.keyCode == 13 )
            {
                buttons[11].removeClass('click');
                judgment(11);
            }
            else if ( event.keyCode == 8 )
            {
                buttons[10].removeClass('click');
                judgment(10);
                return false;
            }
            return true;
        });
        var errorMessage = $('<p></p>').text('').addClass('error').appendTo(box);
    };
})(jQuery);

(function($) {
    var url = '../statics/street-view/';
    var nowfaceto;
    var nowpointat;
    var loading = false;
    var streetPoints =
    [
        { // 0 (工5)
            N:{ photo: 'Day 1 (4).JPG', nextPoint: 2 },
            E:{ photo: 'Day 1 (3).JPG', nextPoint: (-1) },
            S:{ photo: 'Day 1 (2).JPG', nextPoint: (-1) },
            W:{ photo: 'Day 1 (1).JPG', nextPoint: 1 }
        },
        { // 1 (環工)
            N:{ photo: 'Day 3 (3).JPG', nextPoint: (-1) },
            E:{ photo: 'Day 3 (2).JPG', nextPoint: 0 },
            S:{ photo: 'Day 3 (1).JPG', nextPoint: (-1) },
            W:{ photo: 'Day 3 (4).JPG', nextPoint: 48 }
        },
        { // 2 (工3)
            N:{ photo: 'Day 1 (6).JPG', nextPoint: 3 },
            E:{ photo: 'Day 1 (7).JPG', nextPoint: (-1) },
            S:{ photo: 'Day 1 (8).JPG', nextPoint: 0 },
            W:{ photo: 'Day 1 (5).JPG', nextPoint: (-1) }
        },
        { // 3 (操場前)
            N:{ photo: 'Day 1 (10).JPG', nextPoint: 4 },
            E:{ photo: 'Day 1 (9).JPG', nextPoint: (-1) },
            S:{ photo: 'Day 1 (84).JPG', nextPoint: 2 },
            W:{ photo: 'Day 1 (11).JPG', nextPoint: (-1) }
        },
        { // 4 (操場)
            N:{ photo: 'Day 1 (13).JPG', nextPoint: 5 },
            E:{ photo: 'Day 1 (14).JPG', nextPoint: (-1) },
            S:{ photo: 'Day 1 (15).JPG', nextPoint: 3 },
            W:{ photo: 'Day 1 (12).JPG', nextPoint: (-1) }
        },
        { // 5 (排球)
            N:{ photo: 'Day 1 (17).JPG', nextPoint: 6 },
            E:{ photo: 'Day 1 (18).JPG', nextPoint: (-1) },
            S:{ photo: 'Day 1 (19).JPG', nextPoint: 4 },
            W:{ photo: 'Day 1 (16).JPG', nextPoint: (-1) }
        },
        { // 6 (可麗餅)
            N:{ photo: 'Day 1 (23).JPG', nextPoint: (-1) },
            E:{ photo: 'Day 1 (20).JPG', nextPoint: 7 },
            S:{ photo: 'Day 1 (21).JPG', nextPoint: 5 },
            W:{ photo: 'Day 1 (22).JPG', nextPoint: 52 }
        },
        { // 7 (育成中心前)
            N:{ photo: 'Day 1 (24).JPG', nextPoint: 51 },
            E:{ photo: 'Day 1 (26).JPG', nextPoint: 8 },
            S:{ photo: 'Day 1 (27).JPG', nextPoint: (-1) },
            W:{ photo: 'Day 1 (25).JPG', nextPoint: 6 }
        },
        { // 8 (後門)
            N:{ photo: 'Day 1 (29).JPG', nextPoint: 9 },
            E:{ photo: 'Day 1 (28).JPG', nextPoint: (-1) },
            S:{ photo: 'Day 1 (31).JPG', nextPoint: (-1) },
            W:{ photo: 'Day 1 (30).JPG', nextPoint: 7 }
        },
        { // 9 (女四東)
            N:{ photo: 'Day 1 (45).JPG', nextPoint: 55 },
            E:{ photo: 'Day 1 (44).JPG', nextPoint: (-1) },
            S:{ photo: 'Day 1 (46).JPG', nextPoint: 8 },
            W:{ photo: 'Day 1 (47).JPG', nextPoint: 54 }
        },
        { // 10 (工1)
            N:{ photo: 'Day 1 (37).JPG', nextPoint: 11 },
            E:{ photo: 'Day 1 (39).JPG', nextPoint: 54 },
            S:{ photo: 'Day 1 (38).JPG', nextPoint: 51 },
            W:{ photo: 'Day 1 (36).JPG', nextPoint: (-1) }
        },
        { // 11 (海音西方岔路)
            N:{ photo: 'Day 1 (63).JPG', nextPoint: 19 },
            E:{ photo: 'Day 1 (62).JPG', nextPoint: 12 },
            S:{ photo: 'Day 1 (61).JPG', nextPoint: 10 },
            W:{ photo: 'Day 1 (60).JPG', nextPoint: (-1) }
        },
        { // 12 (海音咖啡)
            N:{ photo: 'Day 1 (56).JPG', nextPoint: (-1) },
            E:{ photo: 'Day 1 (59).JPG', nextPoint: 13 },
            S:{ photo: 'Day 1 (58).JPG', nextPoint: (-1) },
            W:{ photo: 'Day 1 (57).JPG', nextPoint: 11 }
        },
        { // 13 (宵夜街口)
            N:{ photo: 'Day 1 (53).JPG', nextPoint: 14 },
            E:{ photo: 'Day 1 (54).JPG', nextPoint: (-1) },
            S:{ photo: 'Day 1 (55).JPG', nextPoint: 55 },
            W:{ photo: 'Day 1 (52).JPG', nextPoint: 12 }
        },
        { // 14 (女14舍)
            N:{ photo: 'Day 3 (89).JPG', nextPoint: 15 },
            E:{ photo: 'Day 3 (86).JPG', nextPoint: (-1) },
            S:{ photo: 'Day 3 (87).JPG', nextPoint: 13 },
            W:{ photo: 'Day 3 (88).JPG', nextPoint: (-1) }
        },
        { // 15 (男11舍)
            N:{ photo: 'Day 3 (91).JPG', nextPoint: 16 },
            E:{ photo: 'Day 3 (90).JPG', nextPoint: (-1) },
            S:{ photo: 'Day 3 (93).JPG', nextPoint: 14 },
            W:{ photo: 'Day 3 (92).JPG', nextPoint: (-1) }
        },
        { // 16 (男7舍；7餐前L轉角)
            N:{ photo: 'Day 3 (82).JPG', nextPoint: (-1) },
            E:{ photo: 'Day 3 (85).JPG', nextPoint: (-1) },
            S:{ photo: 'Day 3 (84).JPG', nextPoint: 15 },
            W:{ photo: 'Day 3 (83).JPG', nextPoint: 17 }
        },
        { // 17 (據德樓)
            N:{ photo: 'Day 1 (74).JPG', nextPoint: (-1) },
            E:{ photo: 'Day 1 (73).JPG', nextPoint: 16 },
            S:{ photo: 'Day 1 (72).JPG', nextPoint: 18 },
            W:{ photo: 'Day 1 (75).JPG', nextPoint: 26 }
        },
        { // 18 (地科學院)
            N:{ photo: 'Day 1 (69).JPG', nextPoint: 17 },
            E:{ photo: 'Day 1 (70).JPG', nextPoint: (-1) },
            S:{ photo: 'Day 1 (71).JPG', nextPoint: 19 },
            W:{ photo: 'Day 1 (68).JPG', nextPoint: (-1) }
        },
        { // 19 (地科南方馬路)
            N:{ photo: 'Day 1 (65).JPG', nextPoint: 18 },
            E:{ photo: 'Day 1 (66).JPG', nextPoint: (-1) },
            S:{ photo: 'Day 1 (67).JPG', nextPoint: 11 },
            W:{ photo: 'Day 1 (64).JPG', nextPoint: 20 }
        },
        { // 20 (國泰樹)
            N:{ photo: 'Day 2 (7).JPG', nextPoint: (-1) },
            E:{ photo: 'Day 2 (6).JPG', nextPoint: 19 },
            S:{ photo: 'Day 2 (5).JPG', nextPoint: (-1) },
            W:{ photo: 'Day 2 (8).JPG', nextPoint: 21 }
        },
        { // 21 (舊北十字)
            N:{ photo: 'Day 2 (2).JPG', nextPoint: 22 },
            E:{ photo: 'Day 2 (3).JPG', nextPoint: 20 },
            S:{ photo: 'Day 2 (4).JPG', nextPoint: 39 },
            W:{ photo: 'Day 2 (1).JPG', nextPoint: 32 }
        },
        { // 22 (總圖前路)
            N:{ photo: 'Day 2 (10).JPG', nextPoint: (-1) },
            E:{ photo: 'Day 2 (11).JPG', nextPoint: (-1) },
            S:{ photo: 'Day 2 (12).JPG', nextPoint: 21 },
            W:{ photo: 'Day 2 (9).JPG', nextPoint: 23 }
        },
        { // 23 (總圖)
            N:{ photo: 'Day 2 (14).JPG', nextPoint: (-1) },
            E:{ photo: 'Day 2 (13).JPG', nextPoint: 22 },
            S:{ photo: 'Day 2 (16).JPG', nextPoint: (-1) },
            W:{ photo: 'Day 2 (15).JPG', nextPoint: 24 }
        },
        { // 24 (文學院)
            N:{ photo: 'Day 2 (18).JPG', nextPoint: 25 },
            E:{ photo: 'Day 2 (19).JPG', nextPoint: 23 },
            S:{ photo: 'Day 2 (20).JPG', nextPoint: 32 },
            W:{ photo: 'Day 2 (17).JPG', nextPoint: (-1) }
        },
        { // 25 (行政大樓)
            N:{ photo: 'Day 1 (81).JPG', nextPoint: (-1) },
            E:{ photo: 'Day 1 (82).JPG', nextPoint: 26 },
            S:{ photo: 'Day 1 (80).JPG', nextPoint: (-1) },
            W:{ photo: 'Day 1 (83).JPG', nextPoint: 27 }
        },
        { // 26 (大講堂)
            N:{ photo: 'Day 1 (79).JPG', nextPoint: (-1) },
            E:{ photo: 'Day 1 (78).JPG', nextPoint: 17 },
            S:{ photo: 'Day 1 (77).JPG', nextPoint: (-1) },
            W:{ photo: 'Day 1 (76).JPG', nextPoint: 25 }
        },
        { // 27 (黑盒子)
            N:{ photo: 'Day 3 (70).JPG', nextPoint: (-1) },
            E:{ photo: 'Day 3 (73).JPG', nextPoint: 25 },
            S:{ photo: 'Day 3 (72).JPG', nextPoint: (-1) },
            W:{ photo: 'Day 3 (71).JPG', nextPoint: 28 }
        },
        { // 28 (品好9舍)
            N:{ photo: 'Day 3 (67).JPG', nextPoint: 27 },
            E:{ photo: 'Day 3 (66).JPG', nextPoint: (-1) },
            S:{ photo: 'Day 3 (69).JPG', nextPoint: 31 },
            W:{ photo: 'Day 3 (68).JPG', nextPoint: 29 }
        },
        { // 29 (烏龜池)
            N:{ photo: 'Day 3 (63).JPG', nextPoint: (-1) },
            E:{ photo: 'Day 3 (62).JPG', nextPoint: 28 },
            S:{ photo: 'Day 3 (65).JPG', nextPoint: (-1) },
            W:{ photo: 'Day 3 (64).JPG', nextPoint: (-1) }
        },
        { // 30 (國鼎、烏龜池旁邊)
            N:{ photo: 'Day 3 (58).JPG', nextPoint: (-1) },
            E:{ photo: 'Day 3 (57).JPG', nextPoint: 31 },
            S:{ photo: 'Day 3 (60).JPG', nextPoint: (-1) },
            W:{ photo: 'Day 3 (59).JPG', nextPoint: 50 }
        },
        { // 31 (文學院)
            N:{ photo: 'Day 3 (54).JPG', nextPoint: 28 },
            E:{ photo: 'Day 3 (53).JPG', nextPoint: 32 },
            S:{ photo: 'Day 3 (56).JPG', nextPoint: 33 },
            W:{ photo: 'Day 3 (55).JPG', nextPoint: 30 }
        },
        { // 32 (文院到舊圖間岔路)
            N:{ photo: 'Day 2 (24).JPG', nextPoint: 24 },
            E:{ photo: 'Day 2 (21).JPG', nextPoint: 21 },
            S:{ photo: 'Day 2 (22).JPG', nextPoint: 34 },
            W:{ photo: 'Day 2 (23).JPG', nextPoint: 31 }
        },
        { // 33 (國鼎東岔路)
            N:{ photo: 'Day 3 (50).JPG', nextPoint: 31 },
            E:{ photo: 'Day 3 (51).JPG', nextPoint: (-1) },
            S:{ photo: 'Day 3 (52).JPG', nextPoint: 35 },
            W:{ photo: 'Day 3 (49).JPG', nextPoint: (-1) }
        },
        { // 34 (學務處)
            N:{ photo: 'Day 2 (28).JPG', nextPoint: 32 },
            E:{ photo: 'Day 2 (25).JPG', nextPoint: (-1) },
            S:{ photo: 'Day 2 (26).JPG', nextPoint: 37 },
            W:{ photo: 'Day 2 (27).JPG', nextPoint: (-1) }
        },
        { // 35 (志希)
            N:{ photo: 'Day 3 (46).JPG', nextPoint: 33 },
            E:{ photo: 'Day 3 (48).JPG', nextPoint: 36 },
            S:{ photo: 'Day 3 (47).JPG', nextPoint: 40 },
            W:{ photo: 'Day 3 (45).JPG', nextPoint: (-1) }
        },
        { // 36 (太極銅雕)
            N:{ photo: 'Day 2 (29).JPG', nextPoint: (-1) },
            E:{ photo: 'Day 2 (31).JPG', nextPoint: 37 },
            S:{ photo: 'Day 2 (32).JPG', nextPoint: (-1) },
            W:{ photo: 'Day 2 (30).JPG', nextPoint: 35 }
        },
        { // 37 (百花川、棒球場)
            N:{ photo: 'Day 2 (35).JPG', nextPoint: 34 },
            E:{ photo: 'Day 2 (36).JPG', nextPoint: 38 },
            S:{ photo: 'Day 2 (33).JPG', nextPoint: (-1) },
            W:{ photo: 'Day 2 (34).JPG', nextPoint: 36 }
        },
        { // 38 (百花川、舊圖)
            N:{ photo: 'Day 1 (17).JPG', nextPoint: 39 },
            E:{ photo: 'Day 1 (18).JPG', nextPoint: (-1) },
            S:{ photo: 'Day 1 (19).JPG', nextPoint: (-1) },
            W:{ photo: 'Day 1 (16).JPG', nextPoint: 37 }
        },
        { // 39 (舊圖)
            N:{ photo: 'Day 2 (41).JPG', nextPoint: 21 },
            E:{ photo: 'Day 2 (42).JPG', nextPoint: (-1) },
            S:{ photo: 'Day 2 (43).JPG', nextPoint: 38 },
            W:{ photo: 'Day 2 (40).JPG', nextPoint: (-1) }
        },
        { // 40 (鬆餅屋)
            N:{ photo: 'Day 3 (39).JPG', nextPoint: 35 },
            E:{ photo: 'Day 3 (40).JPG', nextPoint: (-1) },
            S:{ photo: 'Day 3 (37).JPG', nextPoint: 44 },
            W:{ photo: 'Day 3 (38).JPG', nextPoint: 41 }
        },
        { // 41 (科四至管院路)
            N:{ photo: 'Day 3 (32).JPG', nextPoint: (-1) },
            E:{ photo: 'Day 3 (31).JPG', nextPoint: 40 },
            S:{ photo: 'Day 3 (30).JPG', nextPoint: 42 },
            W:{ photo: 'Day 3 (29).JPG', nextPoint: (-1) }
        },
        { // 42 (科學館)
            N:{ photo: 'Day 3 (28).JPG', nextPoint: 41 },
            E:{ photo: 'Day 3 (27).JPG', nextPoint: 43 },
            S:{ photo: 'Day 3 (26).JPG', nextPoint: (-1) },
            W:{ photo: 'Day 3 (25).JPG', nextPoint: (-1) }
        },
        { // 43 (中大湖前路)
            N:{ photo: 'Day 3 (21).JPG', nextPoint: 44 },
            E:{ photo: 'Day 3 (22).JPG', nextPoint: 53 },
            S:{ photo: 'Day 3 (23).JPG', nextPoint: 46 },
            W:{ photo: 'Day 3 (24).JPG', nextPoint: 42 }
        },
        { // 44 (科二東路)
            N:{ photo: 'Day 3 (39).JPG', nextPoint: 40 },
            E:{ photo: 'Day 3 (40).JPG', nextPoint: (-1) },
            S:{ photo: 'Day 3 (37).JPG', nextPoint: 43 },
            W:{ photo: 'Day 3 (38).JPG', nextPoint: 45 }
        },
        { // 45 (鴻經館)
            N:{ photo: 'Day 3 (43).JPG', nextPoint: (-1) },
            E:{ photo: 'Day 3 (44).JPG', nextPoint: 44 },
            S:{ photo: 'Day 3 (42).JPG', nextPoint: (-1) },
            W:{ photo: 'Day 3 (41).JPG', nextPoint: (-1) }
        },
        { // 46 (籃球)
            N:{ photo: 'Day 3 (18).JPG', nextPoint: 43 },
            E:{ photo: 'Day 3 (17).JPG', nextPoint: (-1) },
            S:{ photo: 'Day 3 (20).JPG', nextPoint: 47 },
            W:{ photo: 'Day 3 (19).JPG', nextPoint: (-1) }
        },
        { // 47 (網球場)
            N:{ photo: 'Day 3 (16).JPG', nextPoint: 46 },
            E:{ photo: 'Day 3 (15).JPG', nextPoint: (-1) },
            S:{ photo: 'Day 3 (14).JPG', nextPoint: 48 },
            W:{ photo: 'Day 3 (13).JPG', nextPoint: (-1) }
        },
        { // 48 (游泳池)
            N:{ photo: 'Day 3 (10).JPG', nextPoint: 47 },
            E:{ photo: 'Day 3 (11).JPG', nextPoint: 1 },
            S:{ photo: 'Day 3 (12).JPG', nextPoint: 49 },
            W:{ photo: 'Day 3 (9).JPG', nextPoint: (-1) }
        },
        { // 49 (游泳池旁側門)
            N:{ photo: 'Day 3 (8).JPG', nextPoint: 48 },
            E:{ photo: 'Day 3 (7).JPG', nextPoint: (-1) },
            S:{ photo: 'Day 3 (5).JPG', nextPoint: (-1) },
            W:{ photo: 'Day 3 (6).JPG', nextPoint: (-1) }
        },
        { // 50 (男12舍)
            N:{ photo: 'Day 3 (95).JPG', nextPoint: (-1) },
            E:{ photo: 'Day 3 (96).JPG', nextPoint: 30 },
            S:{ photo: 'Day 3 (94).JPG', nextPoint: (-1) },
            W:{ photo: 'Day 3 (61).JPG', nextPoint: (-1) }
        },
        { // 51 (工2)
            N:{ photo: 'Day 1 (35).JPG', nextPoint: 10 },
            E:{ photo: 'Day 1 (34).JPG', nextPoint: (-1) },
            S:{ photo: 'Day 1 (33).JPG', nextPoint: 7 },
            W:{ photo: 'Day 1 (32).JPG', nextPoint: (-1) }
        },
        { // 52 (依仁堂)
            N:{ photo: 'Day 3 (80).JPG', nextPoint: (-1) },
            E:{ photo: 'Day 3 (81).JPG', nextPoint: 6 },
            S:{ photo: 'Day 3 (78).JPG', nextPoint: (-1) },
            W:{ photo: 'Day 3 (79).JPG', nextPoint: 53 }
        },
        { // 53 (羽球館)
            N:{ photo: 'Day 3 (75).JPG', nextPoint: (-1) },
            E:{ photo: 'Day 3 (76).JPG', nextPoint: 52 },
            S:{ photo: 'Day 3 (77).JPG', nextPoint: (-1) },
            W:{ photo: 'Day 3 (74).JPG', nextPoint: 43 }
        },
        { // 54 (女1~4)
            N:{ photo: 'Day 1 (42).JPG', nextPoint: (-1) },
            E:{ photo: 'Day 1 (41).JPG', nextPoint: 9 },
            S:{ photo: 'Day 1 (40).JPG', nextPoint: (-1) },
            W:{ photo: 'Day 1 (43).JPG', nextPoint: 10 }
        },
        { // 55 (女5男3)
            N:{ photo: 'Day 1 (49).JPG', nextPoint: 13 },
            E:{ photo: 'Day 1 (50).JPG', nextPoint: (-1) },
            S:{ photo: 'Day 1 (51).JPG', nextPoint: 9 },
            W:{ photo: 'Day 1 (48).JPG', nextPoint: (-1) }
        },
    ];

    var move = function(pointat, faceto)
    {
        if ( pointat == -1 )
        {
            $.alert({
                message: '這裡不能走！'
            });
        }
        else
        {
            var photo = url + streetPoints[pointat][faceto].photo;
            var preloader = new Image();
            loading = true;
            preloader.onload = function()
            {
                $('#street-div #mapPicture').attr('src', photo).fadeIn(300);
                loading = false;
            };
            preloader.src = photo;

            nowpointat = pointat;
            nowfaceto = faceto;
            $('#street-div #mapPicture').fadeOut(300);
        }
    };

    var forward = function()
    {
        move(streetPoints[nowpointat][nowfaceto].nextPoint, nowfaceto);
    };

    var turnLeft = function()
    {
        switch ( nowfaceto )
        {
            case 'N':
                nowfaceto = 'W';
                break;
            case 'E':
                nowfaceto = 'N';
                break;
            case 'S':
                nowfaceto = 'E';
                break;
            case 'W':
                nowfaceto = 'S';
                break;
        }
        move(nowpointat, nowfaceto);
    };

    var turnRight = function()
    {
        switch ( nowfaceto )
        {
            case 'N':
                nowfaceto = 'E';
                break;
            case 'E':
                nowfaceto = 'S';
                break;
            case 'S':
                nowfaceto = 'W';
                break;
            case 'W':
                nowfaceto = 'N';
                break;
        }
        move(nowpointat, nowfaceto);
    };

    $.street = function()
    {
        var isStreet = false;
        $('.picture').hide();
        $('#street-div #experience-personally').mousedown(function()
        {
            $(document).mousemove(mousemove);
            isStreet = true;
            return false;
        });
        var mouseInId;
        var isInPicture = false;
        var mousemove = function(event)
        {
            $('.opacity-picture').css(
            {
                opacity: 0.5,
            });
            x = event.pageX - $('#street-div #back-div').offset().left;
            y = event.pageY - $('#street-div #back-div').offset().top;
            $('#street-div #experience-personally').css(
            {
            top: y +  2 + 'px',
            left: x + 2 + 'px',
            });
        };

        $('#street-div .picture').mouseenter(function()
        {
            isInPicture = true;
            mouseInId = $(this).attr('id');
        });

        $('#street-div .picture').mouseleave(function()
        {
            isInPicture = false;
        });

        var mouseup = function()
        {
            $('.opacity-picture').css(
            {
                opacity: 1,
            });
            if ( isInPicture && isStreet )
            {
                if( $('#' + mouseInId).attr('streetPoints') == (-1) )
                {
                    $('#street-div #experience-personally').css(
                    {
                        top: 410,
                        left: 530,
                    });
                }
                else
                {
                    $('#street-div #experience-personally').css(
                    {
                        zIndex: 2,
                    });

                    $('#street-div #map-div, #street-div #curtain-close-div, #street-div #back-div').css(
                    {
                        height: 498,
                    });

                    $('#street-div #mapPicture').css(
                    {
                        zIndex: '3',
                        width: 750,
                        height: 498,
                    });

                    $('#street-div .arrow').show();

                    move($('#' + mouseInId).attr('streetPoints'), $('#' + mouseInId).attr('faceto'));

                    $('#street-div .street-loading').show();
                    $('#street-div .arrow').eq(0).unbind('click').click(function() //前進nextDirection
                    {
                        if ( ! loading ) forward();
                    });
                     $('#street-div .arrow').eq(1).unbind('click').click(function() // 左旋
                    {
                        if ( ! loading ) turnLeft();
                    });
                    $('#street-div .arrow').eq(2).unbind('click').click(function() // 右旋
                    {
                        if ( ! loading ) turnRight();
                    });

                    isInPicture = false;
                }
                isStreet = false;;
            }
            $(document).unbind('mousemove', mousemove);
            $('#street-div #experience-personally').css(
            {
                top: 410,
                left: 530,
            });
        };
        $(document).mouseup(mouseup);

        $('#street-div .picture').hide();
        $('#street-div .landscape').show();

        var littleBuilding = function() // building icon show
        {
            $('#street-div .picture').hide();
            $( '.' + $(this).attr('show')).show();
        };
        $('#street-div .one-image').bind('click', littleBuilding);

        $('#street-div .two-image').click(function(){
            $('#street-div .button-text').hide();
            $('#street-div .button-text[ detailItem = ' + $(this).attr('detailItem') + ']' ).show();
        });

        $('#street-div .curtainOpen').click(function()
        { // 窗簾
            $('#street-div #experience-personally').css(
            {
                zIndex: 1,
            });
            $('#street-div #curtainDiv').animate(
            {
                left: '370px'
            });
            $('#street-div .button-text').hide();
            $('#street-div .button-text[ detailItem = "department" ]').show();        
            $('#street-div .one-image').unbind('click', littleBuilding);
        });
        $('#street-div #curtainclose').click(function()
        {// 窗簾
            $('#street-div #curtainDiv').animate(
            {
                left: '750px'
            });
            $('#street-div #experience-personally').css(
            {
                zIndex: 4,
            });
            $('#street-div .one-image').bind('click', littleBuilding);
        });

        $('#street-div .arrow').eq( 3 ).click(function() // 親身體驗 back
        {
            $('#street-div #mapPicture').attr('src', $('#street-div #mapPicture').attr('path'));
            $('#street-div .arrow').hide();

            $('#street-div #map-div, #street-div #curtain-close-div, #street-div #back-div').css(
            {
                height: 552,
            });
            $('#street-div #mapPicture').css(
            {
                width: 601,
                height: 552,  
                zIndex: 0,
            });
            $('#street-div #experience-personally').css(
            {
                zIndex: 3,
            });
            $('#street-div .street-loading').hide();
        });
        $('#street-div .picture, #street-div .button-text').click(function()
        {
            isInPicture = false;
            // $('.loading').hide();
            $('#street-div #back-div, #street-div #curtain-close-div').css(
            {
               height: 552,
            });
            $('#street-div #experience-personally').css(
            {
                zIndex: 2,
            });

            $('#text-container').dialog(
            {
                width: 680,
                height: 400,
                modal: true,
                escape: false,
                onClose: function()
                {
                    $('#mapPicture').attr('src', $('#mapPicture').attr('path'));
                }
            });

            $('#street-div .arrow').hide();
            $('#street-div #mapPicture').css(
            {
                width: 601,
                height: 552,
                zIndex: 0,
            });

            var id = $(this).attr('href').replace('#', '');
            $.ajax(
            {
                type: 'GET',
                url: jQuery.configures.buildingContentUrl.replace(':id', id),
                dataType: 'json',
                success: function(data)
                {
                    $('#building-text').html(data.content).scrollTo(0);
                    $('#building-text img').css(
                    {
                        cursor: 'pointer',
                    });
                    $('#building-text img').each(function()
                    {
                        $(this).wrapAll(
                            $('<a></a>')
                                .addClass('lightbox')
                                .attr('href', $(this).attr('src'))
                                .attr('title', $(this).attr('alt'))
                        );
                    });
                    $('#building-text a.lightbox').lightbox({
                        hideOverlayBackground: true
                    });             
                },
            });
            
        });
        $('#street-div #building-text').scrollable({
            scrollableClass: 'street-scrollable'
        });
    };
})(jQuery);

(function($) {
    $.nculife = function()
    {
        var getTabContent = function()
        {
            var tab = jQuery(this).attr('tab');
            var page = jQuery(this).attr('page');
            jQuery.getJSON(
                jQuery.configures.ncuLifeUrl.replace(':tab', tab).replace(':page', page),
                function(data)
                { 
                    $('#nculife-content-view').html(data.content).scrollTo(0);
                }
            ); 
            return false;
        }

        $('.life-items li').click(function()
        {
            $('#life-dialog').dialog(
            {
                dialogClass: 'nculife-dialog',
                closeText: ' ',
            });

            $('#life-dialog').removeClass();
            $('#life-dialog').addClass('nculife-dialog');
            $('#life-dialog').addClass($(this).parents('ul').attr('pattern'));
            $('#nculife-title').removeClass();
            $('#nculife-title').addClass($(this).parents('ul').attr('bar'));

            $('#nculife-content-view').empty();
            $('#nculife-dialog-head').empty();

            var button = $(this)
            if ( button.hasClass('life-bar') )
            {
                $(this).children().children().each(function()
                {
                    var title = $('<a></a>')
                        .text($(this).text())
                        .attr('href', '#')
                        .attr('class', '')
                        .attr('tab', $(this).attr('tab'))
                        .attr('page', $(this).attr('page'))
                        .attr('title', $(this).text())
                        .click(getTabContent);
                    $('#nculife-dialog-head').append(title);
                });
                $('#nculife-title h4').text($(this).children('span').text());
            }

            else
            {
                $(this).each(function()
                {
                    var title = $('<a></a>')
                        .text($(this).text())
                        .attr('href', '#')
                        .attr('class', '')
                        .attr('tab', $(this).attr('tab'))
                        .attr('page', $(this).attr('page'))
                        .attr('title', $(this).text())
                        .click(getTabContent);
                    $('#nculife-dialog-head').append(title);
                });
                $('#nculife-title h4').text($(this).text());
            }

            $('#nculife-dialog-head > a').first().click();
            
        });

        $('#nculife-content-view').scrollable(
        {
            scrollableClass:    false
        });
		
		$('.nculife-hover').mouseenter(function()
		{
			$(this).children('ul').stop().animate(
			{
				height: $(this).attr('height')
			},500);
		});
		
		$('.nculife-hover').mouseleave(function()
		{
			$(this).children('ul').stop().animate(
			{
				height: '0px'
			},500);
		});

        switch( window.location.hash.replace('#', '') )
        {
            case 'play' :
                $('#life-play').mouseenter();
            break;

            case 'traffic' :
                $('#life-traffic').mouseenter();
            break;

            case 'school' :
                $('#life-school').mouseenter();
            break;

            case 'live' :
                $('#life-live').mouseenter();
            break;

            case 'health' :
                $('#life-health').mouseenter();
            break;
        }

    };
})(jQuery);

(function($) {
    $.readme = function()
    {
        var getTabContent = function()
        {
            var tab = jQuery(this).attr('tab');
            var page = jQuery(this).attr('page');
            jQuery.getJSON(
                jQuery.configures.readMeUrl.replace(':tab', tab).replace(':page', page),
                function(data)
                { 
                    $('.readme-view').html(data.content).scrollTo(0);
                }
            ); 
            return false;
        }

        $('.readme-view').scrollable(
		{
            scrollableClass: false
        });

        if( $('.readme-menu a').length == 0 )
        {
            $('.readme-menu-index li').each(function()
            {
				var title = $('<li></li>').append($('<a></a>')
                        .text($(this).text())
                        .attr('href', '#')
                        .attr('tab', $(this).attr('tab'))
                        .attr('page', $(this).attr('page'))
                        .click(getTabContent));
                $('#readme .menu-index').append(title);
            });
            $('.readme-menu a').eq(0).click();
        }

        $('#readme-logo1').click(function()
        {
            $('.fresh-inner:hidden').fadeIn('slow');
            $('.reschool-inner:visible').fadeOut('fast');
            return false;
        });

        $('#readme-logo2').click(function()
        {
            $('.reschool-inner:hidden').fadeIn('slow');
            $('.fresh-inner:visible').fadeOut('fast');
            return false;
        });

        $('.readme-menu').mouseenter(function()
        {
            $(this).stop().animate(
            {
                left : '0px'
            },500);
        });

        $('.readme-menu').mouseleave(function()
        {
            $(this).stop().animate(
            {
                left : '-200px'
            },500);
        });

            switch( window.location.hash.replace('#', '') )
        {
            case 'freshman' :
                jQuery('#readme-logo1').click();
            break;

            case 'reschool' :
                jQuery('#readme-logo2').click();
            break;
        }
    };
})(jQuery);

(function($) {
    $.clubs = function()
    {
        $('#menu-items a').lightbox();

        $('#calendar-button').click(function()
        {
            var button = $(this);
            if ( button.hasClass('active') )
            {
                $('.underpicture div').slideUp(300, function()
                {
                    button.removeClass('active');
                });
            }
            else
            {
                $('.underpicture div').slideDown(300, function()
                {
                    $('#calendar').css({
                        overflow: 'visible'
                    });
                    button.addClass('active');
                });
            }
            return false;
        });

        if ( $('#calendar div').length ) 
        {
            var url = $.configures.calendarClubEventsUrl
                .replace(':id', $('#club > div').attr('id').replace('club-', ''));
            $('#calendar div').calendar();
        }
        
        $('#club .back').click(function()
        {
            window.history.back();
        });      
    };
})(jQuery);

/**
 * Lightbox
 */
(function($) {
    $.fn.lightbox = function(options)
    {
        var options = $.extend({
            lightboxId:                 'lightbox',
            lightboxOverlayId:          'lightbox-overlay',
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
            hideOverlayBackground:      false,
            maxImageHeight:             480,
            maxImageWidth:              640,
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
            onBeforeHide:               function() { return true; },
            onHide:                     function() {}
        }, options);

        var active = 0;

        var images = [];

        var objects = $(this);

        var lightboxInitialize = function()
        {
            if ( options.onBeforeShow() )
            {
                var overlay = $('<div></div>')
                    .css({
                        height: $(window).height(),
                        left: 0,
                        position: 'fixed',
                        top: 0,
                        width: $(window).width()
                    })
                    .overlay({
                        onBeforeHide: lightboxClose
                    });
                var lightbox = $('<div></div>')
                    .attr('id', options.lightboxId)
                    .click(function()
                    {
                        return overlay.close();
                    })
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
                    .click(function()
                    {
                        return overlay.close();
                    })
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

                overlay.getOverlay(overlay.index).attr('id', options.lightboxOverlayId);
                if ( options.hideOverlayBackground )
                {
                    overlay.getOverlay(overlay.index).css({
                        backgroundColor: 'transparent'
                    });
                }

                options.onShow();
                lightbox.css({
                    marginTop: -1 * box.height() / 2,
                    top: '50%'
                });
                lightboxLoadImage();
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
                var height = preloader.height;
                var width = preloader.width;
                $('#' + options.lightboxImageId).attr('src', images[active][1]);
                if ( preloader.width > 0 && preloader.height > 0 )
                {
                    if ( width / height >= options.maxImageWidth / options.maxImageHeight )
                    {
                        if ( width > options.maxImageWidth )
                        {
                            preloader.width = options.maxImageWidth;
                            preloader.height = (height * options.maxImageWidth) / width;
                        }
                    }
                    else
                    {
                        if ( height > options.maxImageHeight )
                        {
                            preloader.height = options.maxImageHeight;
                            preloader.width = (width * options.maxImageHeight) / height;
                        }
                    }
                }
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
                marginTop: -1 * containerHeight / 2
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
 * DatePicker
 */
(function()
{
    var input = null;

    var fields = [];

    var initialized;

    var onClick = function(year, month, day, callback)
    {
        var textPad = function(string, length)
        {
            if ( string.length >= length ) return string;
            return textPad('0' + string, length);
        }
        input.val(
            year
          + '-'
          + textPad(month.toString(), 2)
          + '-'
          + textPad(day.toString(), 2)
        ).change();
        $.datepicker.fadeOut();
        if ( callback ) callback();
    };

    $.datepicker = {};

    $.fn.datepicker = function(settings)
    {
        var options = $.extend({
            year:   (new Date()).getFullYear(),
            month:  (new Date()).getMonth() + 1,
        }, settings);

        if ( ! this.length ) return this;

        if ( ! initialized )
        {
            var generate = function(year, month)
            {
                return $.generateCalendar({
                    year: year,
                    month: month,
                    right: true,
                    rightClick: function()
                    {
                        if ( ++month > 12 )
                        {
                            year += 1;
                            month = 1;
                        }
                        $('#datepicker table').detach();
                        generate(year, month);
                        return false;
                    },
                    left: true,
                    leftClick: function()
                    {
                        if ( --month < 1 )
                        {
                            year -= 1;
                            month = 12;
                        }
                        $('#datepicker table').detach();
                        generate(year, month);
                        return false;
                    },
                    dayClick: function()
                    {
                        var cell = $(this);
                        onClick(year, month, $(this).data('day'), function()
                        {
                            cell.parent().parent().find('td').removeClass('selected');
                            cell.addClass('selected');
                        });
                    },
                    dayEnter: function()
                    {
                        $(this).addClass('hover');
                    },
                    dayLeave: function()
                    {
                        $(this).removeClass('hover');
                    }
                })
                .appendTo($.datepicker)
                .find('caption a:eq(1)')
                .text(year + '年' + month + '月');
                return calendar;
            };
            $.datepicker = $('<div></div>')
                .attr('id', 'datepicker')
                .hide()
                .appendTo($('body'));
            generate(options.year, options.month);
            initialized = true;
        }

        this.parents('form').find('input, textarea').focus(function()
        {
            for ( var field in fields ) fields[field].blur();
            $.datepicker.fadeOut();
        });

        return this.each(function()
        {
            fields[fields.length] = $(this).prop('readonly', true);
            $(this).focus(function()
            {
                input = $(this).blur();
                $.datepicker.css({
                    left: $(this).offset().left + $(this).width(),
                    top: $(this).offset().top + $(this).height()
                });
                $.datepicker.stop(true, true).fadeIn();
                return true;
            });
        });
    };
})(jQuery);

/**
 * Multimedia
 */
(function($)
{
    $.multimedia = function()
    {
        var target;

        var mmMenuScroll = function(offset)
        {
            if ( typeof(mmMenuScroll.mousein) == 'undefined' )
            {
                mmMenuScroll.mousein = false;
            }
            var margin_top = parseInt($(target).css('margin-top'));
            if ( margin_top + offset > mmMenuScroll.margin_top_max() )
            {
                margin_top = mmMenuScroll.margin_top_max();
                mmMenuScroll.mousein = false;
                $(target).css('margin-top', margin_top);
            }
            if ( margin_top + offset < mmMenuScroll.margin_top_min() )
            {
                margin_top = mmMenuScroll.margin_top_min() ;
                mmMenuScroll.mousein = false;
                $(target).css('margin-top', margin_top);
            }

            if ( mmMenuScroll.mousein )
            {
                $(target).css('margin-top', margin_top + offset);
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

        $('#multimedia .menu a').each(function(index, element)
        {
            var youtube_img_src = 'http://img.youtube.com/vi/:id/0.jpg';
            var video_img_id = $(this).attr('href').substr(1);
            var video_title = $('<span></span>').text($(this).text());
            var video_img = $('<img />')
                .attr('src', youtube_img_src.replace(':id', video_img_id));
            $(this).html(video_title).append(video_img);
        });

        $('#multimedia .items').each(function()
        {
            $(this).height($(this).find('a').length*$(this).find('a').height());
        });
        
        $('#multimedia .menu a').click(function()
        {
            var url = $.configures.multimediaYoutubeUrl.replace(':v', $(this).attr('href').substr(1));
            $('#multimedia-frame').attr('src', url);
            $.getJSON($.configures.multimediaIntroductionUrl.replace(':v', $(this).attr('href').substr(1)), function(data)
            {
                $('#multimedia .introduction').text(data.introduction);
            });
            return false;
        });
        $('#multimedia .menu a').eq($.random(0, $('#multimedia .menu .items a').length - 1)).click();

        var srcoll_offset = 10;
        mmMenuScroll.margin_top_max = function(){ return 0 };
        mmMenuScroll.margin_top_min = function()
        {
            return $('#multimedia .menu').height() - $(target).height();
        }
        
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

        $('#multimedia .tab').click(function(){
            var id = $(this).attr('href').replace('#','');
            $('#multimedia .tab').removeClass('active');
            $(this).addClass('active');
            $('#multimedia .items').hide();
            $('#multimedia #items' + id).show();
            target = $('#multimedia #items' + id);
        });
        
        $('#multimedia .tab').first().click();
    }
})(jQuery);

(function($){
    $.game = function()
    {
        $('.game-display').scrollable({
        });
        
        var id = 0;
        $('#game-mission a').click(function()
        {
            id = $(this).attr('href').replace('#', '');
            $('#game-mission-dialog').dialog({
                // dialogClass: 'game-mission'
            });
            $.getJSON($.configures.gameMissionUrl.replace(':id',id),function(data){
                $('#game-mission-dialog .MissionName').text(data.name);
                $('#game-mission-dialog .display').text(data.content);
            })
            return false;
        });
        
        $('#game-mission-dialog form').submit(function()
        {
            if($(this).find('input[name=answer]').val() == '' ) return false;
            $('#game-mission-dialog form input, #game-mission-dialog form button').prop('disabled', true);
            $.post($.configures.gameSolveUrl.replace(':id',id), {
                answer: $(this).find('input[name=answer]').val(),
                token: $.configures.token
            }, function(data){
                if ( data.result )
                {
                    $('#game-mission-correct').get(0).play();
                }
                else
                {
                    $('#game-mission-wrong').get(0).play();
                }
                $.alert({
                    message: data.result ? '恭喜您～答對囉！獲取了金幣與經驗值' : '答錯囉～請再接再厲',
                    confirmed: function()
                    {
                        $('#game-mission-dialog form input, #game-mission-dialog form button').prop('disabled', false);
                        if ( data.result ) window.location.reload();
                    }
                });
                $.configures.token = data.token;
            });
            $(this).find('input[name=answer]').val('');
            return false;
            
        });

        $('.item-description,.mission-description').each(function()
        {
            var icon = $(this).parent();
            var description = $(this).detach();
            icon.data('description', description.appendTo($('body')));
            icon.hover(function()
            {
                var description = $(this).data('description');
                description.css({
                    left: $(this).offset().left,
                    top: $(this).offset().top
                });
                description.stop(true, true).fadeIn();
            }, function()
            {
                var description = $(this).data('description');
                description.stop(true, true).fadeOut();
            });
        });

        $('.own-items').click(function()
        {
            var target = $(this);
            $.confirm({
                message: '您確定要裝備此物品嗎？',
                confirmed: function(result)
                {
                    if ( result )
                    {
                        window.location = target.attr('href');
                    }
                }
            });
            return false;
        });
        $('.shop-items').click(function()
        {
            var target = $(this);
            $.confirm({
                message: '您確定要購買或是裝備此物品嗎？',
                confirmed: function(result)
                {
                    if ( result )
                    {
                        window.location = target.attr('href');
                    }
                }
            });
            return false;
        }); 
    };
})(jQuery);

(function($)
{
    var friends = [];

    $.friends = function()
    {
        var checked = false;
        $('.a-group-users, .users-group, #new-group-members').scrollable();
        $('.button-all-choose').click(function()
        {
            checked = ! checked;
            $('input[type="checkbox"][name^="friends"]').each(function()
            {
                $(this).prop('checked', checked);
            });
            $('input[type="checkbox"][name^="friends"]').change();
            return false;
        });

        $('#same-department-diff-grade-search, #other-department-search, #same-department-same-grade-search, #request-search, #new-group-search, #mygroup-search, #myfriend-search, #newmember-search').keyup(function()
        {
            var name = $(this).val().toLowerCase();
            for ( var key in friends )
            {
                var data = friends[key];
                console.log(data);
                if ( data[0].toLowerCase().search(name) == 0 )
                {
                    data[1].show();
                }
                else
                {
                    data[1].hide();
                }
            }
        });

        $('p.user-name').each(function()
        {
            friends[friends.length] = [$(this).text(), $(this).parent()];
        });
    };
    
})(jQuery);

(function($)
{
    $.profile = function()
    {
        $('.allmessages, #my-all-messages, #self-messages-content, #friend-chatting, .friend-chatting-content').scrollable();
        jQuery('.button-viewProfile-back').click(function()
        {
            window.history.back();
        }); 
    
    };
})(jQuery);

(function($)
{
    $.ncufresh = function()
    {
        $('.loading').sprite();

        $('input.datepicker:not(#form-register-birthday, #form-editor-birthday)').datepicker();
        $('#form-register-birthday, #form-editor-birthday').datepicker({
            year: 1994,
            month: 8
        });

        $('#form-sidebar-register, #form-login-register').click(function()
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

        $('form dt label').infield();
        $('form dd > span').each(function()
        {
            var tooltip = $(this);
            tooltip.prepend($('<span></span>').addClass('arrow'));
            if ( $(tooltip).css('display') === 'none' )
            {
                $(tooltip).parent().parent().hover(function()
                {
                    if ( $(this).find('input:focus').length === 0 )
                    {
                        $(tooltip).stop(true, true).fadeIn();
                    }
                }, function()
                {
                    if ( $(this).find('input:focus').length === 0 )
                    {
                        $(tooltip).stop(true, true).fadeOut();
                    }
                })
                .find('input').focus(function()
                {
                    $(tooltip).stop(true, true).fadeIn();
                })
                .blur(function()
                {
                    $(tooltip).stop(true, true).fadeOut();
                });
            }
        });

        $('form input[type="radio"]').each(function(element)
        {
            var span = $('<span></span>')
                .addClass('radio')
                .mousedown(function()
                {
                    $('input[type="radio"][name="' + $(this).prev().prop('checked', true).attr('name') + '"]').each(function()
                    {
                        $(this).next().removeClass('checked');
                    });
                    $(this).addClass('checked');
                })
                .insertAfter($(this));

            $(this).css({
                    display: 'none',
                    height: 'auto',
                    width: 'auto'
                })
                .change(function()
                {
                    $('input[type="radio"][name="' + $(this).attr('name') + '"]').each(function()
                    {
                        if ( $(this).prop('checked') ) {
                            $(this).next().addClass('checked');
                        } else {
                            $(this).next().removeClass('checked');
                        }
                    });
                });

            if ( $(this).prop('checked') ) {
                $(this).next().addClass('checked');
            }
        });

        $('form input[type="checkbox"]').each(function(element)
        {
            var span = $('<span></span>')
                .addClass('checkbox')
                .mousedown(function()
                {
                    if ( $(this).hasClass('checked') )
                    {
                        $(this).prev().prop('checked', false);
                        $(this).removeClass('checked');
                    }
                    else
                    {
                        $(this).prev().prop('checked', true);
                        $(this).addClass('checked');
                    }
                })
                .insertAfter($(this));

            $(this).css({
                    display: 'none',
                    height: 'auto',
                    width: 'auto'
                })
                .change(function()
                {
                    if ( $(this).prop('checked') )
                    {
                        $(this).next().addClass('checked');
                    }
                    else
                    {
                        $(this).next().removeClass('checked');
                    }
                    console.log($(this).prop('checked'));
                });

            if ( $(this).prop('checked') ) {
                $(this).next().addClass('checked');
            }
        });

        $('a').live('click', function()
        {
            var url = $(this).attr('href');
            if (
                url.match(/^\/.+/)
             || url.match(/^#.*/)
             || url.search(location.hostname) >= 0 )
            {
                return true;
            }
            window.open(url);
            return false;
        });
    };
})(jQuery);

(function($)
{
    $.site = function()
    {
        const SEGMENT = 100 / 5;

        var meter = $('#form-password-meter');

        var offset = parseInt(meter.css('margin-top'));

        var calculatePasswordScore = function(password)
        {
            var lengthMultiplier = 4;
            var numberMultiplier = 4;
            var symbolMultiplier = 6;
            var middleCharacterMultipler = 2;
            var upperCaseAlphaMultipler = 2;
            var lowerCaseAlphaMultipler = 2;
            var consecutiveNumberMultipler = 2;
            var sequentialAlplaMultipler = 3;
            var sequentialNumberMultipler = 3;
            var sequentialSymbolMultipler = 3;

            var upperCaseAlpha = '';
            var lowerCaseAlpha = '';
            var number = '';
            var symbol = '';
            var repeatCharacterCountIncreasement = 0;

            var repeatChatacterExists = false;
            var upperCaseAlphaCount = 0;
            var lowerCaseAlphaCount = 0;
            var middleCharacterCount = 0;
            var numberCount = 0;
            var symbolCount = 0;
            var repeatCharacterCount = 0;
            var uniqueCharacterCount = 0;

            var consecutiveUpperCaseAlphaCount = 0;
            var consecutiveLowerCaseAlphaCount = 0;
            var consecutiveNumberCount = 0;
            var consecutiveSymbolCount = 0;

            var sequentialAlplaCount = 0;
            var sequentialNumberCount = 0;
            var sequentialSymbolCount = 0;
            var sequentialCharacterCount = 0;

            var length = password.length;
            var score = parseInt(length * lengthMultiplier);
            var array = password.replace(/\s+/g, '').split(/\s*/);

            for ( var index = 0; index < array.length ; ++index )
            {
                if ( array[index].match(/[A-Z]/g) )
                {
                    if ( upperCaseAlpha !== '' )
                    {
                        if ( (upperCaseAlpha + 1) == index ) consecutiveUpperCaseAlphaCount++;
                    }
                    upperCaseAlpha = index;
                    upperCaseAlphaCount++;
                }
                else if ( array[index].match(/[a-z]/g) )
                { 
                    if ( lowerCaseAlpha !== '')
                    {
                        if ( (lowerCaseAlpha + 1) == index ) consecutiveLowerCaseAlphaCount++;
                    }
                    lowerCaseAlpha = index;
                    lowerCaseAlphaCount++;
                }
                else if ( array[index].match(/[0-9]/g) )
                { 
                    if ( index > 0 && index < (array.length - 1) )
                    {
                        middleCharacterCount++;
                    }
                    if ( number !== '' )
                    {
                        if ( (number + 1) == index ) consecutiveNumberCount++;
                    }
                    number = index;
                    numberCount++;
                }
                else if ( array[index].match(/[^a-zA-Z0-9_]/g) )
                { 
                    if ( index > 0 && index < (array.length - 1) )
                    {
                        middleCharacterCount++;
                    }
                    if ( symbol !== '' )
                    {
                        if ( (symbol + 1) == index ) consecutiveSymbolCount++;
                    }
                    symbol = index;
                    symbolCount++;
                }

                for ( var t = 0 ; t < array.length ; ++t )
                {
                    if ( array[index] == array[t] && index != t )
                    {
                        repeatChatacterExists = true;
                        repeatCharacterCountIncreasement += Math.abs(array.length/(t - index));
                    }
                }
                if ( repeatChatacterExists )
                { 
                    repeatCharacterCount++; 
                    uniqueCharacterCount = array.length - repeatCharacterCount;
                    repeatCharacterCountIncreasement = (uniqueCharacterCount) ? Math.ceil(repeatCharacterCountIncreasement / uniqueCharacterCount) : Math.ceil(repeatCharacterCountIncreasement); 
                }
            }

            for ( var t = 0 ; t < 23 ; ++t )
            {
                var forward = 'abcdefghijklmnopqrstuvwxyz'.substring(t, parseInt(t + 3));
                var reverse = forward.reverse();
                if (
                    password.toLowerCase().indexOf(forward) != -1
                 || password.toLowerCase().indexOf(reverse) != -1
                )
                {
                    sequentialAlplaCount++;
                    sequentialCharacterCount++;
                }
            }

            for ( var t = 0 ; t < 8 ; ++t )
            {
                var forward = '01234567890'.substring(t, parseInt(t + 3));
                var reverse = forward.reverse();
                if (
                    password.toLowerCase().indexOf(forward) != -1
                 || password.toLowerCase().indexOf(reverse) != -1
                )
                {
                    sequentialNumberCount++;
                    sequentialCharacterCount++;
                }
            }

            for ( var t = 0 ; t < 8; ++t )
            {
                var forward = ')!@#$%^&*()'.substring(t, parseInt(t + 3));
                var reverse = forward.reverse();
                if (
                    password.toLowerCase().indexOf(forward) != -1
                 || password.toLowerCase().indexOf(reverse) != -1
                )
                {
                    sequentialSymbolCount++;
                    sequentialCharacterCount++;
                }
            }

            if ( upperCaseAlphaCount > 0 && upperCaseAlphaCount < length )
            {
                score += parseInt((length - upperCaseAlphaCount) * 2);
            }
            if ( lowerCaseAlphaCount > 0 && lowerCaseAlphaCount < length )
            {
                score += parseInt((length - lowerCaseAlphaCount) * 2);
            }
            if ( numberCount > 0 && numberCount < length )
            {
                score += parseInt(numberCount * numberMultiplier);
            }
            if ( symbolCount > 0 )
            {
                score += parseInt(symbolCount * symbolMultiplier);
            }
            if ( middleCharacterCount > 0)
            {
                score += parseInt(middleCharacterCount * middleCharacterMultipler);
            }
            if ( (lowerCaseAlphaCount > 0 || upperCaseAlphaCount > 0) && symbolCount === 0 && numberCount === 0 )
            {
                score -= parseInt(length);
            }
            if ( lowerCaseAlphaCount === 0 && upperCaseAlphaCount === 0 && symbolCount === 0 && numberCount > 0 )
            {
                score -= parseInt(length); 
            }
            if ( repeatCharacterCount > 0 )
            {
                score -= parseInt(repeatCharacterCountIncreasement);
            }
            if ( consecutiveUpperCaseAlphaCount > 0 )
            {
                score -= parseInt(consecutiveUpperCaseAlphaCount * upperCaseAlphaMultipler);
            }
            if ( consecutiveLowerCaseAlphaCount > 0 )
            {
                score -= parseInt(consecutiveLowerCaseAlphaCount * lowerCaseAlphaMultipler);
            }
            if ( consecutiveNumberCount > 0 )
            {
                score -= parseInt(consecutiveNumberCount * consecutiveNumberMultipler);
            }
            if ( sequentialAlplaCount > 0 )
            {
                score -= parseInt(sequentialAlplaCount * sequentialAlplaMultipler);
            }
            if ( sequentialNumberCount > 0 )
            {
                score -= parseInt(sequentialNumberCount * sequentialNumberMultipler); 
            }
            if ( sequentialSymbolCount > 0 )
            {
                score -= parseInt(sequentialSymbolCount * sequentialSymbolMultipler);
            }

            if ( length < 8 ) score /= 2;
            if ( score > 100 ) score = 100;
            if ( score < 0 ) score = 0;
            return score;
        };

        var colors = [
            '#FF0000',
            '#F79F1D',
            '#EAF722',
            '#99E653',
            '#3AF463'
        ];

        var checkPasswordStrength = function()
        {
            if ( $(this).val() !== '' )
            {
                var score = calculatePasswordScore($(this).val());
                var level = parseInt(score / SEGMENT) + 1;

                meter.find('td').css({
                    backgroundColor: 'transparent'
                });

                for ( var index = 0 ; index < level ; ++index )
                {
                    meter.find('td').eq(index).css({
                        backgroundColor: colors[level - 1]
                    });
                }
            }
        };

        if ( $('#form-register-password').length )
        {
            checkPasswordStrength.call(
                $('#form-register-password')
                    .keyup(checkPasswordStrength)
                    .keydown(checkPasswordStrength)
            );
        }
    };
})(jQuery);

/**
 * about
 */
(function($)
{
    $.about = function(options)
    {
        var options = $.extend({
            aboutId:                        'about',
            titleClass:                     'title',
            introdutionBlock:               'itrodution-block',
            introdutionPicture:             'about-picture',
            photoUl:                        'photo-ul',
            introduceId:                    'introdution',
            tagBar:                         'tag-bar',
            animationClass:                 'animation',
            block1InfClass:                 'about-block1Inf',
            tagClass:                       'tag',
            tagTxtClass:                    'tag-txt',
            title1Class:                    'title1',
            title2Class:                    'title2',
            PictureBarSpeed:                1000,
            PictureAutoSpeed:               6000,
            tagBarSpeed:                    30000
        }, options);
        var photoIndex = 0;
        var button = [
            $('#' + options.aboutId + ' .button-left'),
            $('#' + options.aboutId + ' .button-right')
        ];
        var photos = $('#' + options.aboutId + ' img');
        var tagbarIndex = 0;
        var tagbar = $('.' + options.tagBar + ' .tag-image').each(function(index)
        {
            $(this).addClass('tag-bar' + index);
        });
        var tagbarPerson = $('.' + options.tagBar + ' .person');
        var personName = $('<p></p>').addClass('tag-box-name').hide();
        var personGrade = $('<p></p>').addClass('tag-box-grade').hide();
        var photoNumber = 31;
        var smallPhotoIndex = 0;
        var photoA = $('#' + options.aboutId + ' a');
        var tagBool = true;
        var jumpTo = function()
        {   
            tagbar.each(function(){
                $(this).hide();
            });
            block1Inf.each(function(){
                $(this).hide();
            });
            if ( tagbarIndex != 6 )
            {
                block1Inf.eq(tagbarIndex).show();
                tagbarPerson.each(function()
                {
                    $(this).hide();
                });
                for (var p = 0; p < 9; p++)
                {
                    tagbarPerson.eq(tagbarIndex * 9 + p).show();
                    if ( tagbarIndex == 4 && p == 1 )
                    {
                        break;
                    }
                }
            }
            tagbar.eq(tagbarIndex).show();
        };
        var blocks = [
            $('#' + options.aboutId + ' .block1'),
            $('#' + options.aboutId + ' .block2')
        ];
        var itrodutionPicture = $('#' + options.aboutId + ' .' + options.introdutionPicture);
        var picture = $('<div></div>')
            .css({
                borderRadius: 10,
                background: 'url(\'' + photoA.eq(1).attr('href') + '\')',
                height: 300,
                width: 400
            })
            .mouseenter(function()
            {
                display.show().stop().animate({
                    height: 50,
                    opacity: 1
                }, options.PictureBarSpeed);
            })
            .mouseleave(function()
            {
                display.stop().animate({
                    height: 0,
                    opacity: 0
                }, options.PictureBarSpeed);
            })
            .appendTo(itrodutionPicture);
        var display = $('<div></div>').addClass('about-display').hide().appendTo(picture);
        var photoBar = $('<div></div>').addClass('photo-bar').appendTo(display);
        var itrodution = $('#' + options.aboutId + ' .' + options.introdutionBlock).appendTo(blocks[0]);
        var block1Picture = $('<div></div>').addClass('about-block1Picture').appendTo(blocks[1]);
        var block1Tag = $('#' + options.aboutId + ' .' + options.tagClass).appendTo(blocks[1]);
        var block1Txt = $('#' + options.aboutId + ' .' + options.tagTxtClass).appendTo(blocks[1]);
        var block1Inf = $('#' + options.aboutId + ' .' + options.block1InfClass);
        block1Inf.each(function()
        {
            $(this).hide().appendTo(block1Txt);
        });
        tagbar.each(function(index)
        {
            $(this).addClass('about-tagbar').hide().appendTo(block1Tag);
        });
        $('#' + options.aboutId + ' .' + options.animationClass).each(function(index)
        {
            $(this).addClass('about-small-' + index ).mouseenter(function()
            {
                if ( index != 0 )
                {
                    $(this).css({
                        cursor: 'pointer'
                    })
                }
            })
            .click(function()
            {
                if ( index == 0 ) return false;
                tagBool = false;
                for ( var i = 0; i < 5; i++)
                {
                    block1Inf.eq(i).hide();
                }
                tagbarIndex = index - 1;
                jumpTo();
            })
            .appendTo(block1Picture);
        });
        tagbarPerson.each(function()
        {
            $(this).css({
                position: 'absolute',
                top: 45 + parseInt($(this).attr('top')),
                left: 67 + parseInt($(this).attr('left')),
                height: $(this).attr('height'),
                width: $(this).attr('width'),
            })
            .mouseenter(function()
            {
                var tempObject = $(this);
                $(this).css({
                    border: '5px solid white'
                });
                personName.text(tempObject.attr('name')).show().appendTo(tempObject);
                personGrade.text(tempObject.attr('grade')).show().appendTo(tempObject);
            })
            .mouseleave(function()
            {
                $(this).css({
                    border: ''
                });
                personName.hide();
                personGrade.hide();
            })
            .hide()
            .appendTo(block1Tag);
        });
        jumpTo();
        setInterval(function()
        {
            if ( photoIndex < photoNumber - 1 )
            {
                photoIndex++;
            }
            else
            {
                photoIndex = 0;
            }
            picture.css('background-image', 'url(\'' + photoA.eq(photoIndex).attr('href') + '\')');
        },options.PictureAutoSpeed);
        setInterval(function()
        {
            if ( tagBool )
            {
                if ( tagbarIndex < 5 )
                {
                    tagbarIndex++;
                }
                else
                {
                    tagbarIndex = 0;
                }
                jumpTo();
            }
        },options.tagBarSpeed);
        $('#' + options.aboutId + ' .' + options.title1Class).appendTo($('#' + options.aboutId));
        blocks[0].appendTo($('#' + options.aboutId));
        $('#' + options.aboutId + ' .' + options.title2Class).appendTo($('#' + options.aboutId));
        blocks[1].appendTo($('#' + options.aboutId));
        photos.each(function(index)
        {
            if ( index < photoNumber )
            {
                $(this).addClass('about-photos')
                .mouseenter(function()
                {
                    $(this).css('cursor', 'pointer');
                })
                .click(function()
                {
                    photoIndex = index;
                    picture.css({
                        background: 'url(\'' + photoA.eq(index).attr('href') + '\')'
                    });
                })
            }
        });
        $('#' +  options.aboutId + ' .' + options.photoUl).appendTo(photoBar).show();
        button[0].css({
            left: 0,
            position: 'absolute'
        }).click(function()
        {
            if ( smallPhotoIndex > 0 )
            {
                smallPhotoIndex--;
                $('#' +  options.aboutId + ' .' + options.photoUl).stop().animate({
                    left: -40 + smallPhotoIndex * -50 
                });
            }
        }).appendTo(display).show();
        button[1].css({
            left: 350,
            position: 'absolute'
        }).click(function()
        {
            if( smallPhotoIndex + 6 < photoNumber )
            {
                smallPhotoIndex++;
                $('#' +  options.aboutId + ' .' + options.photoUl).stop().animate({
                    left: -40 + smallPhotoIndex * -50 
                });
            }
        }).appendTo(display).show();
        photoA.each(function(index)
        {
            $(this).click(function()
            {
                picture.css({
                    background: 'url(\'' + $(this).attr('href') + '\')'
                });
                return false;
            });
        });
    };
})(jQuery);

/**
 * Forum
 */
 (function($){ 
    $.forum = function()
    {
        $("#forum-reply-content").keydown(function(){
            var content_num = 20;
            /* 若content字數小於10則將submit disable */
            if($(this).val().length < content_num){
                $(".reply-submit").attr('disabled','');
            }
            else{
                $(".reply-submit").removeAttr('disabled');
            }
        });
        $('.article-delete').click(function (){
            $('.form-delete input').attr('value', $(this).attr('href').replace('#', ''));
            if(confirm("刪除文章?")){
                $('.form-delete').submit();            
            }
            return false;
        });
        $('.profile-add-friend a').click(function (){
            $('.form-addfriend .addfriend-input').attr('value', $(this).attr('href').replace('#', ''));
            $('.form-addfriend .addfriend-input').attr('name', 'friends['+$(this).attr('href').replace('#', '')+']');
            $('.form-addfriend').submit();
            return false;
        });
        $("#forum-forum-top2 .sort-list").change(function() {
            var url = $.configures.forumSortUrl;
            console.log(url);
            window.location = url.replace(':sort', $(this).val());
        });
        /*forum create*/
        /* title最多20字元 */
        var title_num = 20;
        /* content最少20字元 */
        var content_num = 20;
        counter=[];
        var content = $('#forum-create-text-number-check').html();
        function check_submit(){
            $("#forum-create-submit").attr('disabled','');
            check=0;
            for(i=0;i<2;i++){
                if(counter[i]!=1){
                    return false;
                }
                else if(counter[i]==1)
                    check=1;
            }
            if(check==1)
                return true;
        }
        $("#forum-create-title").keydown(function(){
            /* 若title字數超過20則將submit disable */
            if($(this).val().length > title_num){
                counter[0]=0;
                $(this).val($(this).val().substr(0, title_num));
                if(check_submit()==false){
                    $("#forum-create-submit").attr('disabled','');
                    $(".form-top p").html(content+" <strong>"+check_submit()+"</strong>");
                }
            }
            else if($(this).val().length < title_num && $(this).val().length > 0){
                counter[0]=1;
                if(!check_submit())
                    $(".form-top p").html(content+" <strong>文章字數須滿10字以上喔!</strong>");
                if(check_submit()==true)
                    $("#forum-create-submit").removeAttr('disabled');
            }
        });

        $("#form-create-content").keydown(function(){
            /* 若content字數小於10則將submit disable */
            if($(this).val().length < content_num){
                counter[1]=0;
                $(this).val($(this).val().substr(0, content_num));
                if(check_submit()==false){
                    $("#forum-create-submit").attr('disabled','');
                    $(".form-top p").html(content+" <strong>文章內容字數不足</strong>");
                }
            }
            else{
                counter[1]=1;
                $("#forum-create-text-number-check").html(content);
                if(check_submit()==true){
                    $("#forum-create-submit").removeAttr('disabled');
                    $(".form-top p").html(content);
                }
            }
        });
        $('.forum-cancel-button').click(function()
        {
            $.confirm({
                message: '確定取消編輯此篇文章？',
                confirmed: function(result)
                {
                    if ( result ) window.location = $.configures.forumCancelUrl;
                    return false;
                }
            });
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

        $.ncufresh();

        $('#header').star();

        $('#moon').moon();

        if ( $('#chat').length ) $('#chat').chat();

        if ( $('#site').length ) $.site();

        if ( $('#club').length ) $.clubs();

        if ( $('#game').length ) $.game();

        if ( $('#friends').length ) $.friends();

        if ( $('#profile').length ) $.profile();

        if ( $('#nculife').length ) $.nculife();
        
        if ( $('#forum').length ) $.forum();

        if ( $('#readme').length ) $.readme(); 

        if ( $('#street').length ) $.street(); 

        if ( $('#multimedia').length ) $.multimedia();

        if ( $('.calendar-create').length ) $.calendarCreate();

        if ( $('#calendar-recycle').length ) $.calendarRecycle();

        if ( $('#personal-calendar').length ) $.calendarView();

        if ( $('#calendar-subscript').length ) $.calendarSubscript();

        if ( $('#calendar-club').length ) $.calendarClub();

        if ( $('#calendar-event').length ) $.calendarEvent();
        
        if ( $('#about').length ) $.about();
        
        $.pull.start({
            friendcounter: $('#chat .friendcounts'),
            onlinecounter: $('#header .online'),
            browseredcounter: $('#header .browsered')
        });

        $.push.start();
    });

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
            .attr('href', $.configures.ncuFreshWebUrl)
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

    google.setOnLoadCallback(function()
    {
        google.search.CustomSearchControl.attachAutoCompletion(
            $.configures.googleSearchAppId,
            $('#form-search-query').get(0),
            'search'
        );
    });
})(jQuery);

google.load('search', '1', {
    language: 'zh_TW'
});
