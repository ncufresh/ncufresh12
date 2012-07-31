jQuery(document).ready(function()
{
    var getTabContent = function()
    {
        var tab = jQuery(this).attr('tab');
        var page = jQuery(this).attr('page');
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
            closeText: ' ',
            onClose: function()
            {
                $('#life-dialog').removeClass();
                $('#life-dialog').addClass('nculife-dialog');
            }
        });

        if($(this).parent().parent('div').attr('id') == 'life-play')
        {
            $('#nculife-title').removeClass();
            $('#life-dialog').addClass('nculife-style1');
            $('#nculife-title').addClass('life-top1');
        }
        if($(this).parent().parent('div').attr('id') == 'life-traffic')
        {
            $('#nculife-title').removeClass();
            $('#life-dialog').addClass('nculife-style2');
            $('#nculife-title').addClass('life-top2');
        }
        if($(this).parent().parent('div').attr('id') == 'life-school')
        {
            $('#nculife-title').removeClass();
            $('#life-dialog').addClass('nculife-style3');
            $('#nculife-title').addClass('life-top3');
        }
        if($(this).parent().parent('div').attr('id') == 'life-live')
        {
            $('#nculife-title').removeClass();
            $('#life-dialog').addClass('nculife-style4');
            $('#nculife-title').addClass('life-top4');
        }
        if($(this).parent().parent('div').attr('id') == 'life-health')
        {
            $('#nculife-title').removeClass();
            $('#life-dialog').addClass('nculife-style5');
            $('#nculife-title').addClass('life-top5');
        }

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
    
    switch(window.location.hash.replace('#', ''))
    {
        case 'play' :
            jQuery('#life-play').mouseenter();
        break;

        case 'traffic' :
            jQuery('#life-traffic').mouseenter();
        break;

        case 'school' :
            jQuery('#life-school').mouseenter();
        break;

        case 'live' :
            jQuery('#life-live').mouseenter();
        break;

        case 'health' :
            jQuery('#life-health').mouseenter();
        break;
    }

});