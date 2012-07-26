(function($)
{
    $(document).ready(function()
    {
        $('body *').hide();
        $('<div></div>')
            .attr('id', 'notsupport')
            .append(
                $('<ul></ul>')
                    .append(
                        $('<li></li>')
                            .append(
                                $('<a></a>')
                                    .attr('href', 'http://www.microsoft.com.tw/ie')
                                    .attr('title', 'Internet Explorer 9')
                                    .text('Internet Explorer 9')
                                    .prepend(
                                        $('<span></span>')
                                            .attr(
                                                'id',
                                                'notsupport-browser-ie9'
                                            )
                                    )
                            )
                    )
                    .append(
                        $('<li></li>')
                            .append(
                                $('<a></a>')
                                    .attr('href', 'http://www.firefox.com')
                                    .attr('title', 'Mozilla Firefox')
                                    .text('Mozilla Firefox')
                                    .prepend(
                                        $('<span></span>')
                                            .attr(
                                                'id',
                                                'notsupport-browser-firefox'
                                            )
                                    )
                            )
                    )
                    .append(
                        $('<li></li>')
                            .append(
                                $('<a></a>')
                                    .attr('href', 'http://www.chrome.com')
                                    .attr('title', 'Google  Chrome')
                                    .text('Google  Chrome')
                                    .prepend(
                                        $('<span></span>')
                                            .attr(
                                                'id',
                                                'notsupport-browser-chrome'
                                            )
                                    )
                            )
                    )
                    .append(
                        $('<li></li>')
                            .append(
                                $('<a></a>')
                                    .attr('href', 'http://www.opera.com')
                                    .attr('title', 'Opera')
                                    .text('Opera')
                                    .prepend(
                                        $('<span></span>')
                                            .attr(
                                                'id',
                                                'notsupport-browser-opera'
                                            )
                                    )
                            )
                    )
                    .append(
                        $('<li></li>')
                            .append(
                                $('<a></a>')
                                    .attr('href', 'http://www.apple.com.tw/safari')
                                    .attr('title', 'Apple Safari')
                                    .text('Apple Safari')
                                    .prepend(
                                        $('<span></span>')
                                            .attr(
                                                'id',
                                                'notsupport-browser-safari'
                                            )
                                    )
                            )
                    )
            )
            .appendTo($('body'))
            .show();
        $('a').click(function()
        {
            window.open($(this).attr('href'));
            return false;
        });
        for ( var index = 0, times = $.random(5, 30) ; index < times ; ++index)
        {
            $('#notsupport li')
                .eq($.random(0, $('#notsupport li').length - 1))
                .prependTo($('#notsupport ul'));
        }
    });
})(jQuery);