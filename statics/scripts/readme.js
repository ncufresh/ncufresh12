jQuery(document).ready(function()
{
    jQuery('#readme-direct').mouseenter(function()
    {
        jQuery('#caption').animate(
        {
            left: '0px'
        },500);
        jQuery('#caption a').css('background', 'url(../statics/images/chat.png)');
    });
    
    jQuery('#readme-direct').click(function()
    {
        jQuery('#caption').animate(
        {
            left: '-300px'
        },500);
    });
});