jQuery(document).ready(function()
{
    $('#club-menu-items a').lightbox();
    
    $('#club-schedule-button').click(function()
        {
            var button = $(this);
            if ( button.hasClass('active') )
            {
                $('#club-schedule-content').slideUp(300, function()
                {
                    button.removeClass('active');
                });
            }
            else
            {
                $('#club-schedule-content').slideDown(300, function()
                {
                    button.addClass('active');
                });
            }
            return false;
        });
    jQuery('.back').click(function()
        {
            window.history.back()
        });      
});