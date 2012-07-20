
(function($)
{
    $.about = function(options)
    {
        var options = $.extend({
            aboutId:                         'about',
            titleClass:                      'title',
            introduceId:                     'introduce',
            tagBar:                          'tag-bar',
            animationClass:                  'animation',
            block1InfClass:                  'information',
            picBarSpeed:                     1000,
            picAutoSpeed:                    3000
        }, options);
        var photo_index = 0;
        var photos = $('#' + options.aboutId + ' img');
        var blocks = [
            $('<div></div>')
                .addClass('block1')
                .css({
                    height: 500,    
                    width: 750
                }),
            $('<div></div>')
                .addClass('block2')
                .css({
                    height: 700,
                    width:  750
                }),
            $('<div></div>')
                .addClass('block3')
                .css({
                    height: 400,
                    width:  750
                })
        ]
        var picture = $('<div></div>')
            .css({
                background: 'url(\'' + $('.small_pic').eq(0).attr('photo') + '\')',
                float: 'right',
                height: 300,
                position: 'relative',
                width:  400
            })
            .mouseenter(function()
            {
                display.stop().animate({
                    height: 50,
                    opacity: 1
                }, options.picBarSpeed);
            })
            .mouseleave(function()
            {
                display.stop().animate({
                    height: 0,
                    opacity: 0
                }, options.picBarSpeed);
            })
            .appendTo(blocks[0]);
        var display = $('<div></div>')
            .css({
                background: 'black',
                bottom: 0,
                height: 0,
                opacity: 0,
                position: 'absolute',
                width: 400
            })
            .appendTo(picture);
        var block1_pic = $('<div></div>')
            .css({
                height: 400,
                width: 750,
                position: 'relative'
            })
            .appendTo(blocks[1]);
        var block1_txt = $('<div></div>')
            .css({
                height: 300,
                width: 750,
                position: 'relative'
            })
            .appendTo(blocks[1]);
        var block1_inf = $('#' + options.aboutId + ' .' + options.block1InfClass);
        block1_inf.each(function()
        {
            $(this).css({
                position: 'absolute'
            })
            .hide()
            .appendTo(block1_txt);
        });
        $('#' + options.aboutId + ' .' + options.animationClass).each(function(index)
        {
            $(this).css({
                position: 'absolute'
            })
            .click(function()
            {
                block1_inf.eq(index - 1).show();
            })
            .appendTo(block1_pic);
        });
       
        setInterval(function()
        {
            if ( photo_index < 7 )
            {
                photo_index++;
            }
            else
            {
                photo_index = 0;
            }
            picture.css('background-image', 'url(\'' + photos.eq(photo_index).attr('photo') + '\')');
        },options.picAutoSpeed);
        $('#' + options.aboutId + ' .' + options.titleClass)
            .appendTo($('#' + options.aboutId))
            .each(function(index)
            {
                blocks[index].insertAfter($(this));
            });
        photos.each(function(index)
        {
            if ( index < 8 )
            {
                $(this).css({
                    float: 'left',
                    margin: 5
                })
                .click(function()
                {
                    photo_index = index;
                    picture.css({
                       background: 'url(\'' + photos.eq(index).attr('photo') + '\')'
                    });
                })
                .appendTo(display);
            }
        });
        $('<div></div>')
            .css({
                float: 'left',
                height: 500,
                width: 350
            })
            .appendTo(blocks[0])
            .append($('#' + options.introduceId));
        $('#' + options.aboutId + ' .' + options.tagBar).each(function()
        {
            $(this).css({
                backgroundColor: 'yellow',
                float: 'left',
                height: 40,
                width: 150
            })
            .mouseenter(function()
            {
                $(this).css({
                    backgroundColor: 'red'
                });
            })
            .mouseleave(function()
            {
                $(this).css({
                    backgroundColor: 'yellow'
                });
            })
            .appendTo(blocks[2]);
        });
    };
    $(document).ready(function()
    {
        $.about();
    });
})(jQuery);