(function($){
    $(document).ready(function(){
        $('.game-display').scrollable({
            wheelSpeed: 90
        });

        $('#game-mission a').click(function()
        {
            var id = $(this).attr('href').replace('#', '');
            $('#game-mission-dialog').dialog({
                // dialogClass: 'game-mission'
            });
            $.getJSON($.configures.gameMissionUrl.replace(':id',id),function(data){
                $('#game-mission-dialog span').text(data.name);
                $('#game-mission-dialog .display').text(data.content);
            })
            return false;
        });

        //$('<div></div>').attr('id', 'game-mission-dialog').insertAfter($('#game-mission'));
    });
})(jQuery);