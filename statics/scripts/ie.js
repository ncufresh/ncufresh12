(function($)
{
    $(document).ready(function()
    {
        $('body *').hide();
        $('<div></div>')
            .text('您的瀏覽器不被支援！')
            .prependTo($('body'))
            .show();
    });
})(jQuery);