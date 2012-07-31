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
    
    jQuery('.fresh-menu').mouseenter(function()
    {
        if( $('#read-fresh-menu a').length == 0 )
        {
            jQuery('#readme-index1 li').each(function()
            {
                var title = $('<a></a>')
                        .text($(this).text())
                        .attr('href', '#')
                        .attr('tab', $(this).attr('tab'))
                        .attr('page', $(this).attr('page'))
                        .click(getTabContent);
                $('#read-fresh-menu').append(title);
            });
            $('#read-fresh-menu > a').first().click();
        }
    });
    
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