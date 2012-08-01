(function($){
    $(document).ready(function()
    {
        $('select.month').change(function()
        {
            var days = $.daysInMonth($('select.year').val(), $('select.month').val());
            $('select.day').empty();
            for ( var i = 1 ; i <= days ; ++i )
            {
                $('<option></option>').text(i).appendTo($('select.day')).val(i);
            }
        });
        /*$('#register > form').scrollable();*/
    });
})(jQuery);