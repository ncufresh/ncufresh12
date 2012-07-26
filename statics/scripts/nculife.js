jQuery(document).ready(function()
{
    var getTabContent = function()
    {
        var tab = jQuery(this).attr('tab');
        var page = jQuery(this).attr('page');
        // alert(jQuery.configures.ncuLifeUrl.replace(':id', id));  
        // $('#nculife-cv').html(jQuery.configures.ncuLifeUrl.replace(':id', id)); 
        jQuery.getJSON(
            jQuery.configures.ncuLifeUrl.replace(':tab', tab).replace(':page', page),
            function(data)
            { 
                $('#nculife-cv').html(data.content);
                $('#nculife-ct').html(data.image);
            }
        ); 
        return false;
    }

    jQuery('.life-index li ul li').click(function()
    {
        jQuery('#life-dialog').dialog(
        {
            dialogClass: 'nculife-dialog',
            modal: true,
            closeText: ' ',
            title: $(this).children('span').text(),
            show: 
            {
                effect: 'explode',
                direction: 'down'
            }
        });

        $('#nculife-dh').text('');
        $('#nculife-cv').html('');
        $('#nculife-ct').html('');
        $('#nculife-dh').html('');
        $('#nculife-t').html('');
        
        jQuery(this).children().children().each(function()
        {
            var title = $('<a></a>')
                .text($(this).text())
                .attr('href', '#')
                .attr('tab', $(this).attr('tab'))
                .attr('page', $(this).attr('page'))
                .click(getTabContent);
            $('#nculife-dh').append(title);
        });
    
        $('#nculife-t').append($(this).children('span').text());

        // jQuery('.dialog-close-button').click(function()
        // {
            // $('#nculife-dh').text(' ');
            // $('#nculife-cv').html(' ');
            // $('#nculife-ct').html(' ');
            // $('#nculife-dh').html(' ');
            
        // });
    });

});