$(document).ready(function() {
    star($('#header'));
    marquee($('#marquee'));
});

function random(min, max) {
    return Math.floor(Math.random() * (max - min + 1) + min);
}

function marquee(object) {
    var timer;
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
    timer = setTimeout(animation, speed);

    object.hover(function() {
        clearTimeout(timer);
    }, function() {
        timer = setTimeout(arguments.callee, speed);
    });
}

function star(object) {
    var timer;
    var speed = 2000;
    var width = $(document).width();
    var height = object.height();
    var number = random(30, 40);
    var generator = function() {
        $(object).children('span').remove();
        for ( var n = 0 ; n < number ; ++n ) {
            var x = random(0, width);
            var y = random(0, height);
            var s = random(1, 3);

            $('<span></span>').css({
                WebkitBorderRadius: s,
                borderRadius: s,
                background: '#FFFFFF',
                height: s,
                left: x,
                position: 'absolute',
                top: y,
                width: s
            }).prependTo(object);
        }
        timer = setTimeout(arguments.callee, speed);
    };
    generator();
}

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

