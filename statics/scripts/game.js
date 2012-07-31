(function($){
    $(document).ready(function(){
        $('.game-display').scrollable({
            wheelSpeed: 90
        });

        $('#game-mission a').click(function()
        {
            var id = $(this).attr('href').replace('#', '');
            $('#game-mission-dialog').dialog({
                dialogClass: ''
            });
            return false;
        });
        $('<div></div>').attr('id', 'game-mission-dialog').insertAfter($('#game-mission'));
    });
})(jQuery);