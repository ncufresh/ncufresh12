$(document).ready(function() {
    marquee($('#index_marquee ul'));
});

function marquee(object) {
    var speed = 1000;
    var duration = 500;
    var items = object.children('li');
    var length = items.length;
    var animation = function() {
        var position = parseInt(items.css('top'), 10) - items.height();
        if ( position <= -1 * length * items.height() ) position = 0;
        items.animate({
            top: position
        }, duration);
        timer = setTimeout(arguments.callee, speed);
    };
    var timer = setTimeout(animation, speed);

    object.hover(function() {
        clearTimeout(timer);
    }, function() {
        timer = setTimeout(arguments.callee, speed);
    });
}