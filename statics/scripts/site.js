(function($){
    $(document).ready(function(){
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
        /*$('#register > form').scrollable();*/
    });
})(jQuery);