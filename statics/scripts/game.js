(function($){
    $(document).ready(function(){
        $('.game-display').scrollable({
        });
        
        var id = 0;
        $('#game-mission a').click(function()
        {
            id = $(this).attr('href').replace('#', '');
            $('#game-mission-dialog').dialog({
                // dialogClass: 'game-mission'
            });
            $.getJSON($.configures.gameMissionUrl.replace(':id',id),function(data){
                $('#game-mission-dialog .MissionName').text(data.name);
                $('#game-mission-dialog .display').text(data.content);
            })
            return false;
        });
        
        $('#game-mission-dialog form').submit(function()
        {
            $('#game-mission-dialog form input, #game-mission-dialog form button').prop('disabled', true);
            $.post($.configures.gameSolveUrl.replace(':id',id), {
                answer: $(this).find('input[name=answer]').val(),
                token: $.configures.token
            }, function(data){
                $.alert({
                    message: data.result ? '恭喜您～答對囉！獲取了金幣與經驗值' : '答錯囉～請再接再厲',
                    confirmed: function()
                    {
                        $('#game-mission-dialog form input, #game-mission-dialog form button').prop('disabled', false);
                        if ( data.result ) window.location.reload();
                    }
                });
                $.configures.token = data.token;
            });
            return false;
        });

        $('.item-description,.mission-description').each(function()
        {
            var icon = $(this).parent();
            var description = $(this).detach();
            icon.data('description', description.appendTo($('body')));
            icon.hover(function()
            {
                var description = $(this).data('description');
                description.css({
                    left: $(this).offset().left,
                    top: $(this).offset().top
                });
                description.stop(true, true).fadeIn();
            }, function()
            {
                var description = $(this).data('description');
                description.stop(true, true).fadeOut();
            });
        });

        $('.own-items').click(function()
        {
            var target = $(this);
            $.confirm({
                message: '您確定要裝備此物品嗎？',
                confirmed: function(result)
                {
                    if ( result )
                    {
                        window.location = target.attr('href');
                    }
                }
            });
            return false;
        });
        $('.shop-items').click(function()
        {
            var target = $(this);
            $.confirm({
                message: '您確定要購買或是裝備此物品嗎？',
                confirmed: function(result)
                {
                    if ( result )
                    {
                        window.location = target.attr('href');
                    }
                }
            });
            return false;
        }); 
    });
})(jQuery);