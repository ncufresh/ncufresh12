(function($){
    $(document).ready(function(){
        $('.allmessages').scrollable({
            wheelSpeed: 90
        });
        $('.my-all-messages').scrollable({
            wheelSpeed: 90
        });
        $('.self-messages').scrollable({
            wheelSpeed: 90
        });
         var daysInMonth = function(iYear, iMonth)
        {
            return 32 - new Date(iYear, iMonth-1, 32).getDate();
        }
        $("select.month").change(function(){
            var days = daysInMonth($("select.year").val(), $("select.month").val());
            $("select.day").empty();
            for( var i = 1; i<=days; i++ )
            {
                $('<option></option>').text(i).appendTo($("select.day")).val(i);
            }
        });
        jQuery('.button-back').click(function()
        {
            window.history.back();
        });
    });
})(jQuery);