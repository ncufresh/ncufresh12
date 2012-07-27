(function($)
{
    $(document).ready(function()
    {
        $('body *').hide();
        $('<div></div>')
            .attr('id', 'notsupport')
            .append(
                $('h2')
                    .text('您使用的瀏覽器過舊，為了順利瀏覽本網站，請升級或更換您的瀏覽器。')
            )
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
                            .append(
                                $('<a></a>')
                                    .addClass('portable')
                                    .attr(
                                        'href',
                                        'http://downloads.sourceforge.net/portableapps/FirefoxPortable_14.0.1_TradChinese.paf.exe'
                                    )
                                    .attr(
                                        'title',
                                        'Mozilla Firefox 14 Portable'
                                    )
                                    .text('下載免安裝版的Mozilla Firefox 14')
                                    .hide()
                            )
                            .hover(function()
                            {
                                $(this).children('a.portable').fadeIn();
                            }, function()
                            {
                                $(this).children('a.portable').fadeOut();
                            })
                    )
                    .append(
                        $('<li></li>')
                            .append(
                                $('<a></a>')
                                    .attr('href', 'http://www.chrome.com')
                                    .attr('title', 'Google Chrome')
                                    .text('Google Chrome')
                                    .prepend(
                                        $('<span></span>')
                                            .attr(
                                                'id',
                                                'notsupport-browser-chrome'
                                            )
                                    )
                            )
                            .append(
                                $('<a></a>')
                                    .addClass('portable')
                                    .attr(
                                        'href',
                                        'http://downloads.sourceforge.net/portableapps/GoogleChromePortable_20.0.1132.57_online.paf.exe'
                                    )
                                    .attr(
                                        'title',
                                        'Google Chrome 20 Portable'
                                    )
                                    .text('下載免安裝版的Google Chrome 20')
                                    .hide()
                            )
                            .hover(function()
                            {
                                $(this).children('a.portable').fadeIn();
                            }, function()
                            {
                                $(this).children('a.portable').fadeOut();
                            })
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
                            .append(
                                $('<a></a>')
                                    .addClass('portable')
                                    .attr(
                                        'href',
                                        'http://download.portableapps.com/portableapps/operaportable/OperaPortable_12.00.paf.exe'
                                    )
                                    .attr(
                                        'title',
                                        'Opera 12 Portable'
                                    )
                                    .text('下載免安裝版的Opera 12')
                                    .hide()
                            )
                            .hover(function()
                            {
                                $(this).children('a.portable').fadeIn();
                            }, function()
                            {
                                $(this).children('a.portable').fadeOut();
                            })
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
        $('a.portable').each(function()
        {
            var hint = $(this);
            setInterval(function()
            {
                if ( hint.css('margin-top') !== '0px' )
                {
                    hint.css('margin-top', 0);
                }
                else
                {
                    hint.css('margin-top', 1);
                }
            }, 120);
        });
        for ( var index = 0, times = $.random(5, 30) ; index < times ; ++index)
        {
            $('#notsupport li')
                .eq($.random(0, $('#notsupport li').length - 1))
                .prependTo($('#notsupport ul'));
        }
    });
})(jQuery);