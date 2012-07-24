jQuery(document).ready(function()
{

    var getTabContent = function()
    {  
        var id = jQuery(this).attr('href').replace('#','');
        // alert(jQuery.configures.ncuLifeUrl.replace(':id', id));  
        $('#nculife-cv').html(jQuery.configures.ncuLifeUrl.replace(':id', id)); 
        jQuery.getJSON(
            jQuery.configures.ncuLifeUrl.replace(':tab', id).replace(':page', page),
            function(data)
            { 
                $('#nculife-cv').html(data.image);
                $('#nculife-ct').html(data.content);
            }
        ); 
        return false;
    }

    // jQuery('.sport-dialog').click(function()
    // {
        // jQuery('#nculife-dialog').dialog(
        // {
            // dialogClass: 'nculife-dialog',
            // height: 500,
            // width: 700,
            // modal: true,
            // show: 
            // {
                // effect: 'explode',
                // direction: 'down'
            // }
        // });
    // });

    // jQuery('.food-dialog').click(function()
    // {
            // jQuery('#nculife-dialog').dialog(
            // {
                // dialogClass: 'nculife-dialog',
                // height: 315,
                // width: 620,
                // modal: true,
                // show: 
                // {
                    // effect: 'explode',
                    // direction: 'down'
                // }
            // });
    // });
    
    jQuery('.life-index li ul li').click(function()
    {
        // alert();
        jQuery('#life-dialog').dialog(
        {
            dialogClass: 'nculife-dialog',
            height: 517,
            width: 620,
            modal: true,
            closeText: ' ',
            title: $(this).children('span').text(),
            show: 
            {
                effect: 'explode',
                direction: 'down'
            }
        });
        
        jQuery(this).children().children().each(function()
        {
            $('<a></a>')
                .text($(this).text())
                .attr('href', '#')
                .appendTo('#nculife-dh')
                .click(getTabContent);
        });
        
        jQuery('.ui-icon-closethick').click(function()
        {
            $('#nculife-dh').text(' ');
            $('#nculife-cv').html(' ');
            $('#nculife-ct').html(' ');
        });
    });
    
});