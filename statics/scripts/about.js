(function($)
{
    $.about = function(options)
    {
        var options = $.extend({
            aboutId:                         'about',
            titleClass:                      'title',
            introdutionBlock:                'itr-block',
            introdutionPicture:              'about-picture',
            photoUl:                         'photo-ul',
            introduceId:                     'introdution',
            tagBar:                          'tag-bar',
            animationClass:                  'animation',
            block1InfClass:                  'about-block1Inf',
            picBarSpeed:                     1000,
            picAutoSpeed:                    3000,
            tagBarSpeed:                     30000
        }, options);
        var photoIndex = 0;
        var photos = $('#' + options.aboutId + ' img');
        var tagbarIndex = 0;
        var tagbar = $('.' + options.tagBar + ' img');
        var tagbarPerson = $('.' + options.tagBar + ' div');
        var personName = $('<p></p>').addClass('tag-Box-name').hide();
        var personGrade = $('<p></p>').addClass('tag-Box-grade').hide();
        var photoNumber = 10;
        var smallPhotoIndex = 0;
        var photoA = $('#' + options.aboutId + ' a');
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
        ];
        var itrPic = $('#' + options.aboutId + ' .' + options.introdutionPicture);
        var picture = $('<div></div>')
            .css({
                background: 'url(\'' + photos.eq(1).attr('photo') + '\')',
                height: 300,
                width: 400
            })
            .mouseenter(function()
            {
                display.show().stop().animate({
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
            .appendTo(itrPic);
        var display = $('<div></div>').addClass('about-display').hide().appendTo(picture);
        var photoBar = $('<div></div>').addClass('photo-bar').appendTo(display);
        var itr = $('#' + options.aboutId + ' .' + options.introdutionBlock).appendTo(blocks[0]);
        var block1Pic = $('<div></div>').addClass('about-block1Pic').appendTo(blocks[1]);
        var block1Tag = $('<div></div>').addClass('tag').appendTo(blocks[1]);
        var block1Txt = $('<div></div>').addClass('tag-txt').appendTo(blocks[1]);
        var block1Inf = $('#' + options.aboutId + ' .' + options.block1InfClass);
        block1Inf.each(function()
        {
            $(this).hide().appendTo(block1Txt);
        });
        tagbar.each(function(index)
        {
            $(this).addClass('about-tagbar').hide().appendTo(block1Tag);
        });
        $('#' + options.aboutId + ' .' + options.animationClass).each(function(index)
        {
            switch ( index )
            {
                case 0:
                    $(this).css({
                        width: 700,
                        height: 280
                    });
                    break;
                case 1:
                    $(this).css({
                        top: 12,
                        left: 36,
                        height: 132,
                        width: 122
                    });
                    break;
                case 2:
                    $(this).css({
                        top: 145,
                        left: 150,
                        height: 132,
                        width: 122
                    });
                    break;
                case 3:
                    $(this).css({
                        top: 146,
                        left: 379,
                        height: 132,
                        width: 122
                    });
                    break;
                case 4:
                    $(this).css({
                        top: 142,
                        left: 576,
                        height: 132,
                        width: 122
                    });
                    break;
                case 5:
                    $(this).css({
                        top: 11,
                        left: 573,
                        height: 132,
                        width: 122
                    });
                    break;
                 default:
                    break;
            }
            $(this).mouseenter(function()
            {
                $(this).css({
                    cursor: 'pointer'
                })
            })
            .click(function()
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
                    border: '5px solid white'
                });
                personName.text(tempObject.attr('name')).show().appendTo(tempObject);
                personGrade.text(tempObject.attr('grade')).show().appendTo(tempObject);
            })
            .mouseleave(function()
            {
                $(this).css({
                    border: ''
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
            if ( photoIndex < photoNumber - 1 )
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
            if ( index < photoNumber + 2 )
            {
                $(this).addClass('about-photos')
                .mouseenter(function()
                {
                    $(this).css('cursor', 'pointer');
                })
                .click(function()
                {
                    if ( index == 0 )
                    {
                        if ( smallPhotoIndex > 0 )
                        {
                            smallPhotoIndex--;
                            $('#' +  options.aboutId + ' .' + options.photoUl).stop().animate({
                                left: -40 + smallPhotoIndex * -50 
                            });
                        }
                    }
                    else if ( index == photoNumber + 1 )
                    {
                        if( smallPhotoIndex + 6 < photoNumber )
                        {
                            smallPhotoIndex++;
                            $('#' +  options.aboutId + ' .' + options.photoUl).stop().animate({
                                left: -40 + smallPhotoIndex * -50 
                            });
                        }
                    }
                    else
                    {
                        photoIndex = index;
                        picture.css({
                            background: 'url(\'' + photos.eq(index - 1).attr('photo') + '\')'
                        });
                    }
                })
            }
        });
        $('#' +  options.aboutId + ' .' + options.photoUl).appendTo(photoBar);
        photos.eq(0).css({
            left: 0,
            position: 'absolute'
        }).appendTo(display);
        photos.eq(photoNumber + 1).css({
            left: 350,
            position: 'absolute'
        }).appendTo(display);
        photoA.each(function(index)
        {
            $(this).click(function()
            {
                picture.css({
                    background: 'url(\'' + photos.eq(index + 1).attr('photo') + '\')'
                });
                return false;
            });
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