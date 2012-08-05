(function($)
{
    $.about = function(options)
    {
        var options = $.extend({
            aboutId:                         'about',
            titleClass:                      'title',
            introdutionBlock:                'itrodution-block',
            introdutionPicture:              'about-picture',
            photoUl:                         'photo-ul',
            introduceId:                     'introdution',
            tagBar:                          'tag-bar',
            animationClass:                  'animation',
            block1InfClass:                  'about-block1Inf',
            tagClass:                        'tag',
            tagTxtClass:                     'tag-txt',
            title1Class:                     'title1',
            title2Class:                     'title2',
            PictureBarSpeed:                     1000,
            PictureAutoSpeed:                    6000,
            tagBarSpeed:                     30000
        }, options);
        var photoIndex = 0;
        var button = [$('#' + options.aboutId + ' .button-left'), $('#' + options.aboutId + ' .button-right')];
        var photos = $('#' + options.aboutId + ' img');
        var tagbarIndex = 0;
        var tagbar = $('.' + options.tagBar + ' .tag-image').each(function(index)
        {
            $(this).addClass('tag-bar' + index);
        });
        var tagbarPerson = $('.' + options.tagBar + ' .person');
        var personName = $('<p></p>').addClass('tag-box-name').hide();
        var personGrade = $('<p></p>').addClass('tag-box-grade').hide();
        var photoNumber = 31;
        var smallPhotoIndex = 0;
        var photoA = $('#' + options.aboutId + ' a');
        var tagBool = true;
        var jumpTo = function()
        {   
            tagbar.each(function(){
                $(this).hide();
            });
            block1Inf.each(function(){
                $(this).hide();
            });
            if ( tagbarIndex != 6 )
            {
                block1Inf.eq(tagbarIndex).show();
                tagbarPerson.each(function(){
                    $(this).hide();
                });
                for (var p = 0; p < 9; p++)
                {
                    tagbarPerson.eq(tagbarIndex * 9 + p).show();
                    if ( tagbarIndex == 4 && p == 1 )
                    {
                        break;
                    }
                }
            }
            tagbar.eq(tagbarIndex).show();
        };
        var blocks = [$('#' + options.aboutId + ' .block1'), $('#' + options.aboutId + ' .block2')];
        var itrodutionPicture = $('#' + options.aboutId + ' .' + options.introdutionPicture);
        var picture = $('<div></div>')
            .css({
                borderRadius: 10,
                background: 'url(\'' + photoA.eq(1).attr('href') + '\')',
                height: 300,
                width: 400
            })
            .mouseenter(function()
            {
                display.show().stop().animate({
                    height: 50,
                    opacity: 1
                }, options.PictureBarSpeed);
            })
            .mouseleave(function()
            {
                display.stop().animate({
                    height: 0,
                    opacity: 0
                }, options.PictureBarSpeed);
            })
            .appendTo(itrodutionPicture);
        var display = $('<div></div>').addClass('about-display').hide().appendTo(picture);
        var photoBar = $('<div></div>').addClass('photo-bar').appendTo(display);
        var itrodution = $('#' + options.aboutId + ' .' + options.introdutionBlock).appendTo(blocks[0]);
        var block1Picture = $('<div></div>').addClass('about-block1Picture').appendTo(blocks[1]);
        var block1Tag = $('#' + options.aboutId + ' .' + options.tagClass).appendTo(blocks[1]);
        var block1Txt = $('#' + options.aboutId + ' .' + options.tagTxtClass).appendTo(blocks[1]);
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
            $(this).addClass('about-small-' + index ).mouseenter(function()
            {
                if ( index != 0 )
                {
                    $(this).css({
                        cursor: 'pointer'
                    })
                }
            })
            .click(function()
            {
                if ( index == 0 ) return false;
                tagBool = false;
                for ( var i = 0; i < 5; i++)
                {
                    block1Inf.eq(i).hide();
                }
                tagbarIndex = index - 1;
                jumpTo();
            })
            .appendTo(block1Picture);
        });
        tagbarPerson.each(function(){
            $(this).css({
                position: 'absolute',
                top: 45 + parseInt($(this).attr('top')),
                left: 67 + parseInt($(this).attr('left')),
                height: $(this).attr('height'),
                width: $(this).attr('width'),
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
            picture.css('background-image', 'url(\'' + photoA.eq(photoIndex).attr('href') + '\')');
        },options.PictureAutoSpeed);
        setInterval(function()
        {
            if ( tagBool )
            {
                if ( tagbarIndex < 5 )
                {
                    tagbarIndex++;
                }
                else
                {
                    tagbarIndex = 0;
                }
                jumpTo();
            }
        },options.tagBarSpeed);
        $('#' + options.aboutId + ' .' + options.title1Class).appendTo($('#' + options.aboutId));
        blocks[0].appendTo($('#' + options.aboutId));
        $('#' + options.aboutId + ' .' + options.title2Class).appendTo($('#' + options.aboutId));
        blocks[1].appendTo($('#' + options.aboutId));
        photos.each(function(index)
        {
            if ( index < photoNumber )
            {
                $(this).addClass('about-photos')
                .mouseenter(function()
                {
                    $(this).css('cursor', 'pointer');
                })
                .click(function()
                {
                    photoIndex = index;
                    picture.css({
                        background: 'url(\'' + photoA.eq(index).attr('href') + '\')'
                    });
                })
            }
        });
        $('#' +  options.aboutId + ' .' + options.photoUl).appendTo(photoBar).show();
        button[0].css({
            left: 0,
            position: 'absolute'
        }).click(function()
        {
            if ( smallPhotoIndex > 0 )
            {
                smallPhotoIndex--;
                $('#' +  options.aboutId + ' .' + options.photoUl).stop().animate({
                    left: -40 + smallPhotoIndex * -50 
                });
            }
        }).appendTo(display).show();
        button[1].css({
            left: 350,
            position: 'absolute'
        }).click(function()
        {
            if( smallPhotoIndex + 6 < photoNumber )
            {
                smallPhotoIndex++;
                $('#' +  options.aboutId + ' .' + options.photoUl).stop().animate({
                    left: -40 + smallPhotoIndex * -50 
                });
            }
        }).appendTo(display).show();
        photoA.each(function(index)
        {
            $(this).click(function()
            {
                picture.css({
                    background: 'url(\'' + $(this).attr('href') + '\')'
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