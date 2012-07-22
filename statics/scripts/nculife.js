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

    $('.life-tab').click(function()
    {  
        var id = $(this).attr('href').replace('#','');
         // alert(jQuery.configures.ncuLifeUrl.replace(':id', id));  
        /* $('#nculife-cv').html(jQuery.configures.ncuLifeUrl.replace(':id', id)); */
        $.ajax(
        {
            type: 'GET',
            url: jQuery.configures.ncuLifeUrl.replace(':a', 'foodcontent').replace(':id', id),
            dataType: 'json',
            success: function(data)
            { 
                $('#nculife-cv').html(data.content);
                
            },
        });
        $.ajax(
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

    /*
    $('#haha1').click(function()
    {
        var url = 'index.html';
        $.ajax(
        {
            type: 'GET',
            url: '/ncufresh12/nculife/foodContent.html',
            data:
            {
                id: 1
            },
            dataType: 'html',
            success: function(data)
            { 
                $('#nculife-cv').html(data);
            },
        });
        var url = 'index.html';
        $.ajax(
        {
            type: 'GET',
            url: '/ncufresh12/nculife/foodContent.html',
            data:
            {
                id: 1
            },
            dataType: 'html',
            success: function(data)
            { 
                $('#nculife-ct').html(data);
            },
        });
        return false;
    });
    */

    /*
    $('#haha2').click(function()
    {
        var url = 'index.html';
        $.ajax(
        {
            type: 'GET',
            url: '/ncufresh12/nculife/foodContent.html',
            data:
            {
                id: 2
            },
            dataType: 'html',
            success: function(data)
            { 
                $('#nculife-cv').html(data);
            },
        });
        return false;
    });
    */
});