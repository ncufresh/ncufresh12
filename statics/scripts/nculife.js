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
            }
        ); 
        return false;
    }

    jQuery('.life-items li').click(function()
    {
        jQuery('#life-dialog').dialog(
        {
            dialogClass: 'nculife-dialog',
            modal: true,
            closeText: ' ',
            show: 
            {
                effect: 'explode',
                direction: 'down'
            }
        });

        $('#nculife-dh').text('');
        $('#nculife-cv').html('');
        $('#nculife-dh').html('');
        $('#nculife-t').html('');
        
        var button = $(this)
        if(button.hasClass('life-bar'))
        {
            jQuery(this).children().children().each(function()
            {
                var title = $('<a></a>')
                    .text($(this).text())
                    .attr('href', '#')
                    .attr('class', '')
                    .attr('tab', $(this).attr('tab'))
                    .attr('page', $(this).attr('page'))
                    .click(getTabContent);
                $('#nculife-dh').append(title);
            });
            $('#nculife-title h4').text($(this).children('span').text());
        }
        
        else
        {
            jQuery(this).each(function()
            {
                var title = $('<a></a>')
                    .text($(this).text())
                    .attr('href', '#')
                    .attr('class', '')
                    .attr('tab', $(this).attr('tab'))
                    .attr('page', $(this).attr('page'))
                    .click(getTabContent);
                $('#nculife-dh').append(title);
            });
            $('#nculife-title h4').text($(this).text());
        }
        
        /* jQuery(this).children().each(function()
        {
            var title = $('<a></a>')
                .text($(this).text())
                .attr('href', '#')
                .attr('class', '')
                .attr('tab', $(this).attr('tab'))
                .attr('page', $(this).attr('page'))
                .click(getTabContent);
            $('#nculife-dh').append(title);
        }); */
        $('#nculife-dh > a').first().click();
    
       
    });
    
    jQuery('#life-play').mouseenter(function()
    {
        jQuery('#life-index1').stop().animate(
        {
            height: '130px'
        },500);
    });
    
    jQuery('#life-play').mouseleave(function()
    {
        jQuery('.life-items').stop().animate(
        {
            height: '0px'
        },500);
    });
    
    jQuery('#life-traffic').mouseenter(function()
    {
        jQuery('#life-index2').stop().animate(
        {
            height: '130px'
        },500);
    });
    
    jQuery('#life-traffic').mouseleave(function()
    {
        jQuery('#life-index2').stop().animate(
        {
            height: '0px'
        },500);
    });
    
    jQuery('#life-school').mouseenter(function()
    {
        jQuery('#life-index3').stop().animate(
        {
            height: '335px'
        },500);
    });
    
    jQuery('#life-school').mouseleave(function()
    {
        jQuery('#life-index3').stop().animate(
        {
            height: '0px'
        },500);
    });
    
    jQuery('#life-live').mouseenter(function()
    {
        jQuery('#life-index4').stop().animate(
        {
            height: '165px'
        },500);
    });
    
    jQuery('#life-live').mouseleave(function()
    {
        jQuery('#life-index4').stop().animate(
        {
            height: '0px'
        },500);
    });
    
    jQuery('#life-health').mouseenter(function()
    {
        jQuery('#life-index5').stop().animate(
        {
            height: '105px'
        },500);
    });
    
    jQuery('#life-health').mouseleave(function()
    {
        jQuery('#life-index5').stop().animate(
        {
            height: '0px'
        },500);
    });

});