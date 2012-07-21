<script type="text/javascript">
jQuery(document).ready(function()
{
    jQuery('.nculife-food .dialog').click(function()
    {
        jQuery('#nculife-dialog').dialog(
        {
            dialogClass: 'nculife-dialog',
            height: 500,
            width: 700,
            modal: true,
            show: 
            {
                effect: 'explode',
                direction: 'down'
            }
        });
    });

    $('.life-tab').click(function(){
        
        var id = $(this).attr('href').replace('#','');
        $.ajax(
        {
            type: 'GET',
            url: jQuery.configures.ncuLife.replace(':id', id),
            dataType: 'json',
            success: function(data)
            { 
                $('#nculife-cv').html(data.content);
            },
        });
        $.ajax(
        {
            type: 'GET',
            url: '/ncufresh12/nculife/foodContent.html',
            data:
            {
                id: id
            },
            dataType: 'json',
            success: function(data)
            { 
                $('#nculife-ct').html(data.content);
            },
        });	
    });

    $('#haha1').click(function()
    {
        var url = 'index.html';
        $.ajax(
        {
            type: 'GET',
            url: '/ncufresh12/nculife/foodContent.html',
            data:
            {
                id: 1
            },
            dataType: 'html',
            success: function(data)
            { 
                $('#nculife-cv').html(data);
            },
        });
        var url = 'index.html';
        $.ajax(
        {
            type: 'GET',
            url: '/ncufresh12/nculife/foodContent.html',
            data:
            {
                id: 1
            },
            dataType: 'html',
            success: function(data)
            { 
                $('#nculife-ct').html(data);
            },
        });	
        return false;
    });

    $('#haha2').click(function()
    {
        var url = 'index.html';
        $.ajax(
        {
            type: 'GET',
            url: '/ncufresh12/nculife/foodContent.html',
            data:
            {
                id: 2
            },
            dataType: 'html',
            success: function(data)
            { 
                $('#nculife-cv').html(data);
            },
        });
        return false;
    });
});
</script>
<div class="nculife-food">
    食在中央
    <Button class="dialog">校園美食</Button>
    <Button class="dialog">露天咖啡廳</Button>
    <Button class="dialog">學生餐廳</Button>
    <Button class="dialog">消夜街</Button>
    <Button class="dialog">後門</Button>

    <div id="nculife-dialog" title="Basic modal dialog">
        <div id="nculife-dh">
            <a href="#1" id="haha1" class="life-tab">TAB1</a>
            <a href="#2" id="haha2" class="life-tab">TAB2</a>
            <a>TAB3</a>
        </div><!-- end nculife-dh -->
        <div id="nculife-db">
            <div id="nculife-cv">
                View
            </div><!-- end nculife-cv -->
            <div id="nculife-ct">
                Text
            </div><!-- end nculife-ct -->
        </div><!-- end nculife-db -->
    </div><!-- end nculife-dialog -->
</div><!-- end nculife-food --><!-- end -->




