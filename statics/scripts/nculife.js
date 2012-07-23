jQuery(document).ready(function()
{
    jQuery('.sport-dialog').click(function()
    {
        jQuery('#nculife-dialog').dialog(
        {
            dialogClass: 'nculife-dialog',
            height: 500,
            width: 700,
            modal: true,
            show: 
            {
                effect: 'explode',
                direction: 'down'
            }
        });
    });

    jQuery('.life-tab').click(function()
    {  
        var id = jQuery(this).attr('href').replace('#','');
         // alert(jQuery.configures.ncuLifeUrl.replace(':id', id));  
        /* $('#nculife-cv').html(jQuery.configures.ncuLifeUrl.replace(':id', id)); */
        jQuery.ajax(
        {
            type: 'GET',
            url: jQuery.configures.ncuLifeUrl.replace(':a', 'foodcontent').replace(':id', id),
            dataType: 'json',
            success: function(data)
            { 
                $('#nculife-cv').html(data.content);
            },
        });
        jQuery.ajax(
        {
            type: 'GET',
            url: jQuery.configures.ncuLifeUrl.replace(':a', 'foodcontent').replace(':id', id),
            dataType: 'json',
            success: function(data)
            { 
                $('#nculife-ct').html(data.content);
            },
        });
    });

    jQuery('.food-dialog').click(function()
    {
            jQuery('#nculife-dialog').dialog(
            {
                dialogClass: 'nculife-dialog',
                height: 500,
                width: 700,
                modal: true,
                show: 
                {
                    effect: 'explode',
                    direction: 'down'
                }
            });
    });
});