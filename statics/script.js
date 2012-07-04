jQuery.extend({
    random: function(min, max) {
        return Math.floor(Math.random() * (max - min + 1) + min);
    }
});

jQuery.fn.extend({
    marquee: function(settings) {
        return this.each(function() {
            var options = jQuery.extend({
                speed:                  1000,
                duration:               500
            }, settings);
            var items = jQuery(this).children('li');
            var animation = function() {
                var position = parseInt(items.css('top'), 10) - items.height();
                if ( position <= -1 * items.length * items.height() ) {
                    position = 0;
                }
                items.animate({
                    top: position
                }, options.duration);
                timer = setTimeout(arguments.callee, options.speed);
            };
            var timer = setTimeout(animation, options.speed);

            jQuery(this).hover(function() {
                clearTimeout(timer);
            }, function() {
                timer = setTimeout(animation, options.speed);
            });
        });
    },
    star: function(settings) {
        return this.each(function() {
            var options = jQuery.extend({
                speed:                  2000,
                minDensity:             0.02,
                maxDensity:             0.05,
                minSize:                1,
                maxSize:                3,
                backgroundColor:        '#FFFFFF'
            }, settings);
            var width = jQuery(document).width();
            var height = jQuery(this).height();
            var number = jQuery.random(
                width * options.minDensity,
                width * options.maxDensity
            );
            var object = jQuery(this);
            var generator = function() {
                object.children('span').remove();
                for ( var n = 0 ; n < number ; ++n ) {
                    var x = jQuery.random(0, width);
                    var y = jQuery.random(0, height);
                    var s = jQuery.random(options.minSize, options.maxSize);

                    jQuery('<span></span>').css({
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

$(document).ready(function() {
    $('#header').star();
    $('#marquee').marquee();
});