(function($){
    $(document).ready(function(){
        $('.game-display').scrollable({
            wheelSpeed: 90
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
        
        
        $('#game-mission-dialog form').submit(function(){
            $.post($.configures.gameSolveUrl.replace(':id',id), {
                answer: $(this).find('input[name=answer]').val(),
                token: $.configures.token
            }, function(data){
                $.alert({
                    message: data.result ? '恭喜您～答對囉！獲取了金幣與經驗值' : '答錯囉～請再接再厲',
                    confirmed: function()
                    {
                        if ( data.result ) window.location.reload();
                    }
                });
                $.configures.token = data.token;
            });
            return false;
        });

        
        //$('<div></div>').attr('id', 'game-mission-dialog').insertAfter($('#game-mission'));
    });
})(jQuery);