jQuery(document).ready(function()
{
    var getTabContent = function()
    {
        var tab = jQuery(this).attr('tab');
        var page = jQuery(this).attr('page');
        jQuery.getJSON(
            jQuery.configures.readMeUrl.replace(':tab', tab).replace(':page', page),
            function(data)
            { 
                $('#readme-view').html(data.content);
            }
        ); 
        return false;
    }

    if( $('.readme-menu p').length == 1 )
    {
        jQuery('.readme-menu-index li').each(function()
        {
            var title = $('<p></p>')
                    .text($(this).text())
                    .attr('href', '#')
                    .attr('tab', $(this).attr('tab'))
                    .attr('page', $(this).attr('page'))
                    .click(getTabContent);
            $('.readme-menu').append(title);
        });
        $('.readme-menu > p').eq(1).click();
    }

    jQuery('#readme-logo1').click(function()
    {
        $('.fresh-inner:hidden').fadeIn('slow');
        $('.reschool-inner:visible').fadeOut('fast');
        $('.notice-inner:visible').fadeOut('fast');
    });

    jQuery('#readme-logo2').click(function()
    {
        $('.reschool-inner:hidden').fadeIn('slow');
        $('.notice-inner:visible').fadeOut('fast');
        $('.fresh-inner:visible').fadeOut('fast');
    });

    jQuery('#readme-logo3').click(function()
    {
        $('.notice-inner:hidden').fadeIn('slow');
        $('.reschool-inner:visible').fadeOut('fast');
        $('.fresh-inner:visible').fadeOut('fast');
    });

    jQuery('.readme-menu').mouseenter(function()
    {
        $(this).stop().animate(
        {
            left : '0px'
        },500);
    });

    jQuery('.readme-menu').mouseleave(function()
    {
        $(this).stop().animate(
        {
            left : '-187px'
        },500);
    });

});