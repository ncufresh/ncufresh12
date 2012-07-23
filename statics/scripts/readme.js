jQuery(document).ready(function()
{
    jQuery('#readme-direct').hover(function()
    {
        jQuery('#caption').animate(
        {
            left: '0px'
        },500);
    });
    
    jQuery('#readme-direct').mouseout(function()
    {
        jQuery('#caption').animate(
        {
            left: '-300px'
        },500);
    });
    
    
    
});