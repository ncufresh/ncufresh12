jQuery(document).ready(function()
{
    jQuery('#readme-logo1').click(function()
    {
        $('.fresh-inner:hidden').fadeIn('slow');
        $('.reschool-inner:visible').fadeOut('slow');
        $('.notice-inner:visible').fadeOut('slow');
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
    
    jQuery('#read-fresh-menu').mouseenter(function()
    {
        $(this).stop().animate(
        {
            left : '0px'
        },500);
    });
    
    jQuery('#read-fresh-menu').mouseleave(function()
    {
        $(this).stop().animate(
        {
            left : '-215px'
        },500);
    });
    
});