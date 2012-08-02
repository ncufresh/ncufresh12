(function($){
    $(document).ready(function(){
        $('.friends-part3').scrollable({
            wheelSpeed: 90
        });
        $('.friends-part2').scrollable({
            wheelSpeed: 90
        });
        /*$('.other-department').scrollable({
            wheelSpeed: 90
        });*/
        /*$('.sameDdiffG').scrollable({
            wheelSpeed: 90
        });*/
        $('.users-group').scrollable({
            wheelSpeed: 90
        });
        jQuery('.button-back').click(function()
        {
            window.history.back();
        }); 
    });
})(jQuery);