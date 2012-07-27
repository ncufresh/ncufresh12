(function($)
{
    $.konami = function(options)
    {
        var options = $.extend({
            code:                   [38, 38, 40, 40, 37, 39, 37, 39, 66, 65],
            interval:               10,
            complete:               function()
            {
                alert('You complete the konami code!');
            }
        }, options);
        var index = 0;
        var interval = options.interval;
        var timer = setInterval(function()
        {
            if ( interval-- <= 0 ) index = 0;
        }, 50);
        $(document).keyup(function(event)
        {
            if (
                event.keyCode != 231
             && event.keyCode == options.code[index]
            )
            {
                interval = options.interval;
                if ( index++ == options.code.length - 1 ) options.complete();
                return true;
            }
            index = 0;
            return true;
        });
    };
})(jQuery);

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
            tagBarSpeed:                     500
        }, options);
        var photo_index = 0;
        var photos = $('#' + options.aboutId + ' img');
        var tagbar_index = 0;
        var tagbar = $('.' + options.tagBar + ' img');
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
                    height: 600,
                    position: 'relative',
                    width:  750
                })
        ]
        var picture = $('<div></div>')
            .css({
                background: 'url(\'' + photos.eq(photo_index).attr('photo') + '\')',
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
                height: 300,
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
            .mouseenter(function()
            {
                $(this).css({
                    background: 'url(\'' + tagbar.eq(index).attr('photo') + '\')'
                });
            })
            .mouseleave(function()
            {
                $(this).css({
                    background: 'url(\'' + tagbar.eq(index).attr('src') + '\')'
                });
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
        tagbar.eq(0).css({
            left: 225,
            top: 0,
            height: 400,
            width: 300
        })
        .show();
        tagbar.eq(1).css({
            left: 550,
            top: 100,
            height: 200,
            width: 150
        })
        .show();
        tagbar.eq(2).hide();
        tagbar.eq(3).hide();
        tagbar.eq(4).hide();
        tagbar.each(function(index)
        {
            if ( index < 5 )
            {
                $(this).css({
                    backgroundColor: 'yellow',
                    float: 'left',
                    position: 'absolute'
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
            }
            else if ( index == 5 )
            {
                $(this).css({
                    backgroundColor: 'yellow',
                    float: 'left',
                    left: 0,
                    top: 160,
                    height: 40,
                    position: 'absolute',
                    width: 40
                })
                .mouseenter(function()
                {
                    $(this).css({
                        background: 'url(\'' + tagbar.eq(index).attr('photo') + '\')',
                        backgroundColor: 'red'
                    });
                })
                .mouseleave(function()
                {    
                    $(this).css({
                        background: 'url(\'' + tagbar.eq(index).attr('src') + '\')',
                        backgroundColor: 'yellow'
                    });
                })
                .click(function()
                {
                    if ( tagbar_index > 0 )
                    {
                        tagbar_index--;
                        tagbar.eq(0).hide();
                        tagbar.eq(1).hide();
                        tagbar.eq(2).hide();
                        tagbar.eq(3).hide();
                        tagbar.eq(4).hide();
                        if ( tagbar_index == 0 )
                        {
                            tagbar.eq(0).stop().animate({
                                left: 225,
                                top: 0,
                                height: 400,
                                width: 300
                            }, options.tagBarSpeed)
                            .show();
                            tagbar.eq(1).stop().animate({
                                left: 550,
                                top: 100,
                                height: 200,
                                width: 150
                            }, options.tagBarSpeed)
                            .show();
                            tagbar.eq(2).hide();
                            tagbar.eq(3).hide();
                            tagbar.eq(4).hide();
                        }
                        else
                        {
                            tagbar.eq( tagbar_index - 1).css({
                                left: -100,
                                top: 100,
                                height: 200,
                                width: 150
                            }, options.tagBarSpeed)
                            .stop()
                            .animate({
                                left: 50,
                                top: 100,
                                height: 200,
                                width: 150
                            }, options.tagBarSpeed)
                            .show();
                            tagbar.eq( tagbar_index ).stop().animate({
                                left: 225,
                                top: 0,
                                height: 400,
                                width: 300
                            }, options.tagBarSpeed)
                            .show();
                            tagbar.eq( tagbar_index + 1 ).stop().animate({
                                left: 550,
                                top: 100,
                                height: 200,
                                width: 150
                            }, options.tagBarSpeed)
                            .show();
                        }
                        for ( var i = 7 ; i < 12 ; i++ )
                        {
                            tagbar.eq(i).css({
                                backgroundColor: 'yellow'
                            });
                        }
                        tagbar.eq( tagbar_index + 7 ).css({
                            background: 'url(\'' + tagbar.eq(index).attr('photo') + '\')',
                            backgroundColor: 'red'
                        });
                    }
                        
                })
                .appendTo(blocks[2]);
            }
            else if ( index == 6 )  
            {
                $(this).css({
                    backgroundColor: 'yellow',
                    float: 'left',
                    left: 710,
                    top: 160,
                    height: 40,
                    position: 'absolute',
                    width: 40
                })
                .mouseenter(function()
                {
                    $(this).css({
                        background: 'url(\'' + tagbar.eq(index).attr('photo') + '\')',
                        backgroundColor: 'red'
                    });
                })
                .mouseleave(function()
                {    
                    $(this).css({
                        background: 'url(\'' + tagbar.eq(index).attr('src') + '\')',
                        backgroundColor: 'yellow'
                    });
                })
                .click(function()
                {
                    
                    if ( tagbar_index < 4 )
                    {
                        tagbar_index++;
                        tagbar.eq(0).hide();
                        tagbar.eq(1).hide();
                        tagbar.eq(2).hide();
                        tagbar.eq(3).hide();
                        tagbar.eq(4).hide();
                        if ( tagbar_index == 4 )
                        {
                            tagbar.eq(3).stop().animate({
                                left: 50,
                                top: 100,
                                height: 200,
                                width: 150
                            }, options.tagBarSpeed)
                            .show();
                            tagbar.eq(4).stop().animate({
                                left: 225,
                                top: 0,
                                height: 400,
                                width: 300
                            }, options.tagBarSpeed)
                            .show();
                        }
                        else
                        {
                            tagbar.eq( tagbar_index - 1 ).stop().animate({
                                left: 50,
                                top: 100,
                                height: 200,
                                width: 150
                            }, options.tagBarSpeed)
                            .show();
                            tagbar.eq( tagbar_index ).stop().animate({
                                left: 225,
                                top: 0,
                                height: 400,
                                width: 300
                            }, options.tagBarSpeed)
                            .show();
                            tagbar.eq( tagbar_index + 1 ).css({
                                left: 700,
                                top: 100,
                                height: 200,
                                width: 150
                            }, options.tagBarSpeed)
                            .stop()
                            .animate({
                                left: 550,
                                top: 100,
                                height: 200,
                                width: 150
                            }, options.tagBarSpeed)
                            .show();
                        }
                        for ( var i = 7 ; i < 12 ; i++ )
                        {
                            tagbar.eq(i).css({
                                backgroundColor: 'yellow'
                            });
                        }
                        tagbar.eq( tagbar_index + 7 ).css({
                            background: 'url(\'' + tagbar.eq(index).attr('photo') + '\')',
                            backgroundColor: 'red'
                        });
                    }
                })
                .appendTo(blocks[2]);
            }
            else
            {
                $(this).css({
                    background: 'url(\'' + tagbar.eq(index).attr('src') + '\')',
                    backgroundColor: 'yellow',
                    float: 'left',
                    left: 305 + ( index - 7 ) * 30,
                    top: 420,
                    height: 20,
                    position: 'absolute',
                    width: 20
                })
                .appendTo(blocks[2]);
                tagbar.eq(7).css({
                    background: 'url(\'' + tagbar.eq(index).attr('src') + '\')',
                    backgroundColor: 'red'
                });
            }
        });
        
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