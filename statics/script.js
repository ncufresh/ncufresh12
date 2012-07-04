(function($) {
    $.extend({
        random: function(min, max) {
            return Math.floor(Math.random() * (max - min + 1) + min);
        }
    });

    $.fn.extend({
        marquee: function(settings) {
            return this.each(function() {
                var options = $.extend({
                    speed:                  1000,
                    duration:               500
                }, settings);
                var items = $(this).children('li');
                var animation = function() {
                    var position = parseInt(
                        items.css('top'),
                        10
                    ) - items.height();
                    if ( position <= -1 * items.length * items.height() ) {
                        position = 0;
                    }
                    items.animate({
                        top: position
                    }, options.duration);
                    timer = setTimeout(arguments.callee, options.speed);
                };
                var timer = setTimeout(animation, options.speed);

                $(this).hover(function() {
                    clearTimeout(timer);
                }, function() {
                    timer = setTimeout(animation, options.speed);
                });
            });
        },
        star: function(settings) {
            return this.each(function() {
                var options = $.extend({
                    speed:                  2000,
                    minDensity:             0.02,
                    maxDensity:             0.05,
                    minSize:                1,
                    maxSize:                3,
                    backgroundColor:        '#FFFFFF'
                }, settings);
                var width = $(document).width();
                var height = $(this).height();
                var number = $.random(
                    width * options.minDensity,
                    width * options.maxDensity
                );
                var object = $(this);
                var generator = function() {
                    object.children('span').remove();
                    for ( var n = 0 ; n < number ; ++n ) {
                        var x = $.random(0, width);
                        var y = $.random(0, height);
                        var s = $.random(options.minSize, options.maxSize);

                        $('<span></span>').css({
                            WebkitBorderRadius: s,
                            borderRadius: s,
                            background: options.backgroundColor,
                            height: s,
                            left: x,
                            position: 'absolute',
                            top: y,
                            width: s
                        }).prependTo(object);
                    }
                    setTimeout(arguments.callee, options.speed);
                };
                setTimeout(generator, 0);
            });
        }
    });
})(jQuery);

$(document).ready(function() {
    $('#header').star();
    $('#marquee').marquee();
    $('form input').each(function() {
        var input = $(this);
        var label = $('label[for="' + $(this).attr('id') + '"]');
        if ( label.length ) {
            var update = function() {
                if ( input.val() != '' ) {
                    label.css({
                        display: 'none'
                    });
                } else {
                    label.css({
                        display: 'block'
                    });
                }
            };
            label.css({
                cursor: 'text',
                display: 'block'
            }).click(function() {
                input.focus();
            });
            input.focusout(function() {
                update();
            })
            update();  
        } 
    });
});


function checkFileSize(name)
{
	if( typeof checkFileSize.counter == 'undefined')
		checkFileSize.counter = 0;
	var id;
	if( checkFileSize.counter == 0 )
		id = name;
	else
		id = name + '_F' + checkFileSize.counter;
	checkFileSize.counter++;
	var f = document.getElementById(id);
	var file_size = 0;
	if($.browser.msie)
	{
		var img = new Image();
		img.onload = function()
		{
			file_size = this.fileSize;
		}
		img.src = f.value;
	}
	else
	{
		file_size = f.files.item(0).size;
	}
	$('.MultiFile-label:last').append( ' (' + Math.ceil(file_size/1024) + ' KB)')
}

