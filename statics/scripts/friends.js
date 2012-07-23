jQuery(document).ready(function()
{
    jQuery('.form-friends-self-editor').click(function()
    {
            jQuery('.group-friends').dialog(
            {
                dialogClass: 'group-friends',
                height: 500,
                width: 450,
                modal: true,
                show: 
                {
                    effect: 'explode',
                    direction: 'down'
                },
                /*buttons: 
                [{
                        text: "關閉",
                        click: function() { $(this).dialog("close"); }
                }] */
            });
            jQuery('.form-add-new-group').click(function()
            {
                
            });
           
            return false;            
    });
});