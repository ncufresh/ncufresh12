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
                $('#nculife-content-view').html(data.content);
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
        });

        $('#life-dialog').removeClass();
        $('#life-dialog').addClass('nculife-dialog');
        $('#life-dialog').addClass($(this).parents('ul').attr('pattern'));
        $('#nculife-title').removeClass();
        $('#nculife-title').addClass($(this).parents('ul').attr('bar'));

        $('#nculife-content-view').empty();
        $('#nculife-dialog-head').empty();

        var button = $(this)
        if( button.hasClass('life-bar') )
        {
            jQuery(this).children().children().each(function()
            {
                var title = $('<a></a>')
                    .text($(this).text())
                    .attr('href', '#')
                    .attr('class', '')
                    .attr('tab', $(this).attr('tab'))
                    .attr('page', $(this).attr('page'))
                    .attr('title', $(this).text())
                    .click(getTabContent);
                $('#nculife-dialog-head').append(title);
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
                    .attr('title', $(this).text())
                    .click(getTabContent);
                $('#nculife-dialog-head').append(title);
            });
            $('#nculife-title h4').text($(this).text());
        }

        $('#nculife-dialog-head > a').first().click();
        $('#nculife-content-view').scrollable({
            scrollableClass:    false
        });
    });

    jQuery('#life-play').mouseenter(function()
    {
        jQuery('#life-index1').stop().animate(
        {
            height: '95px'
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
            height: '120px'
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
            height: '150px'
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
            height: '100px'
        },500);
    });

    jQuery('#life-health').mouseleave(function()
    {
        jQuery('#life-index5').stop().animate(
        {
            height: '0px'
        },500);
    });

    switch( window.location.hash.replace('#', '') )
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