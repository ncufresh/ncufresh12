(function($)
{
    $.about = function(options)
    {
        var options = $.extend({
            aboutId:                         'about',
            titleClass:                      'title',
            introduceId:                     'introduce',
            tagBar:                          'tagBar',
            animationClass:                  'animation',
            block1InfClass:                  'information',
            picBarSpeed:                     1000,
            picAutoSpeed:                    3000,
            tagBarSpeed:                     10000
        }, options);
        var photoIndex = 0;
        var photos = $('#' + options.aboutId + ' img');
        var tagbarIndex = 0;
        var tagbar = $('.' + options.tagBar + ' img');
        var tagbarPerson = $('.' + options.tagBar + ' div');
        var personName = $('<p></p>').hide();
        var personGrade = $('<p></p>').hide();
        var jumpTo = function()
        {
            block1Inf.each(function(){
                $(this).hide();
            });
            tagbar.each(function(){
                $(this).hide();
            });
            block1Inf.eq(tagbarIndex).show();
            tagbar.eq(tagbarIndex).show();
            tagbarPerson.each(function(){
                $(this).hide();
            });
            
            for (var p = 0; p < 8; p++)
            {
                tagbarPerson.eq(tagbarIndex * 8 + p).show();
                if ( tagbarIndex == 4 && p == 1 )
                {
                    break;
                }
            }
        };
        var blocks = [
            $('<div></div>')
                .addClass('block1'),
            $('<div></div>')
                .addClass('block2')
        ]
        var picture = $('<div></div>')
            .css({
                background: 'url(\'' + photos.eq(photoIndex).attr('photo') + '\')',
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
        var block1Pic = $('<div></div>')
            .css({
                height: 300,
                width: 750,
                position: 'relative'
            })
            .appendTo(blocks[1]);
        var block1Tag = $('<div></div>')
            .addClass('tag')
            .appendTo(blocks[1]);
        var block1Txt = $('<div></div>')
            .css({
                background: '#8ca86c',
                height: 150,
                width: 750,
                position: 'relative'
            })
            .appendTo(blocks[1]);
        var block1Inf = $('#' + options.aboutId + ' .' + options.block1InfClass);
        block1Inf.each(function()
        {
            $(this).css({
                position: 'absolute'
            })
            .hide()
            .appendTo(block1Txt);
        });
        tagbar.each(function(index)
        {
            $(this).css({
                float: 'left',
                position: 'relative',
                height: '0%',
                width: '0%'
            })
            .hide()
            .appendTo(block1Tag);
        });
        $('#' + options.aboutId + ' .' + options.animationClass).each(function(index)
        {
            switch ( index )
            {
                case 0:
                    $(this).css({
                        position: 'absolute'
                    });
                    break;
                case 1:
                    $(this).css({
                        position: 'absolute',
                        top: 7,
                        left: 42,
                        height: 132,
                        width: 122
                    });
                    break;
                case 2:
                    $(this).css({
                        position: 'absolute',
                        top: 168,
                        left: 168,
                        height: 132,
                        width: 122
                    });
                    break;
                case 3:
                    $(this).css({
                        position: 'absolute',
                        top: 163,
                        left: 408,
                        height: 132,
                        width: 122
                    });
                    break;
                case 4:
                    $(this).css({
                        position: 'absolute',
                        top: 161,
                        left: 627,
                        height: 132,
                        width: 122
                    });
                    break;
                case 5:
                    $(this).css({
                        position: 'absolute',
                        top: 22,
                        left: 625,
                        height: 132,
                        width: 122
                    });
                    break;
                 default:
                    break;
            }
            $(this).click(function()
            {
                for ( var i = 0; i < 4; i++)
                {
                    block1Inf.eq(i).hide();
                }
                tagbarIndex = index - 1;
                jumpTo();
            })
            .appendTo(block1Pic);
        });
        tagbarPerson.each(function(){
            $(this).css({
                position: 'absolute',
                top: $(this).attr('top'),
                left: $(this).attr('left'),
                height: $(this).attr('height'),
                width: $(this).attr('width')
            })
            .mouseenter(function()
            {
                var tempObject = $(this);
                $(this).css({
                    background: 'url(\'' + tagbar.eq(5).attr('src') + '\')'
                });
                personName.text(tempObject.attr('name')).css({
                    Button: '20%',
                    left: 0,
                    height: '10%',
                    width: '100%'
                })
                .show()
                .appendTo(tempObject);
                personGrade.text(tempObject.attr('grade')).css({
                    Button: '10%',
                    left: 0,
                    height: '10%',
                    width: '100%'
                })
                .show()
                .appendTo(tempObject);
            })
            .mouseleave(function()
            {
                $(this).css({
                    background: ''
                });
                personName.hide();
                personGrade.hide();
            })
            .hide()
            .appendTo(block1Tag);
        });
        jumpTo();
        setInterval(function()
        {
            if ( photoIndex < 7 )
            {
                photoIndex++;
            }
            else
            {
                photoIndex = 0;
            }
            picture.css('background-image', 'url(\'' + photos.eq(photoIndex).attr('photo') + '\')');
        },options.picAutoSpeed);
        setInterval(function()
        {
            if ( tagbarIndex < 4 )
            {
                tagbarIndex++;
            }
            else
            {
                tagbarIndex = 0;
            }
            jumpTo();
        },options.tagBarSpeed);
        $('#' + options.aboutId + ' .' + options.titleClass)
            .appendTo($('#' + options.aboutId))
            .each(function(index)
            {
                if ( index == 0 ) $(this).addClass('title1');
                if ( index == 1 ) $(this).addClass('title2');
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
                    photoIndex = index;
                    picture.css({
                       background: 'url(\'' + photos.eq(index).attr('photo') + '\')'
                    });
                })
                .appendTo(display);
            }
        });
        $('<div></div>').css({
            background: '#385281',
            float: 'left',
            height: 300,
            width: 350
        })
        .appendTo(blocks[0])
        .append($('#' + options.introduceId));
    };
    $.konami({
        code:                   [38, 38, 40, 40, 37, 39, 37, 39, 65, 66],
        complete:               function()
        {
            alert('哈哈哈~~這裡是硬硬做的啦~');
        }
    });
    $(document).ready(function()
    {
        $.about();
    });
})(jQuery);