jQuery(document).ready(function()
{
    jQuery('.form-friends-self-editor').click(function()
    {
            jQuery('.group-friends').dialog(
            {
                /*dialogClass: 'group-friends',*/
                height: 120,
                width: 300,
                modal: true,
                show: 
                {
                    effect: 'explode',
                    direction: 'down'
                }
            });   
    });
});