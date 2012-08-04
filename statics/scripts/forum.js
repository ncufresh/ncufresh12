(function($){
    // $('#form-create-content').ckeditor();
    $("#forum-reply-content").keydown(function(){
        var content_num = 20;
        /* 若content字數小於10則將submit disable */
        if($(this).val().length < content_num){
            $(".reply-submit").attr('disabled','');
        }
        else{
            $(".reply-submit").removeAttr('disabled');
        }
    });
    $(document).ready(function (){
        $('.article-delete').click(function (){
            $('.form-delete input').attr('value', $(this).attr('href').replace('#', ''));
            if(confirm("刪除文章?")){
                $('.form-delete').submit();            
            }
            return false;
        });
        $('.profile-add-friend a').click(function (){
            $('.form-addfriend .addfriend-input').attr('value', $(this).attr('href').replace('#', ''));
            $('.form-addfriend .addfriend-input').attr('name', 'friends['+$(this).attr('href').replace('#', '')+']');
            $('.form-addfriend').submit();
            return false;
        });
        $("#forum-forum-top2 #sort_list").change(function() {
            var url = $.configures.forumSortUrl;
            window.location = url.replace(':sort', $(this).val());
        });
        /*forum create*/
        /* title最多20字元 */
        var title_num = 20;
        /* content最少20字元 */
        var content_num = 20;
        counter=[];
        var content = $('#forum-create-text-number-check').html();
        function check_submit(){
            $("#forum-create-submit").attr('disabled','');
            check=0;
            for(i=0;i<2;i++){
                if(counter[i]!=1){
                    return false;
                }
                else if(counter[i]==1)
                    check=1;
            }
            if(check==1)
                return true;
        }
        $("#forum-create-title").keydown(function(){
            /* 若title字數超過20則將submit disable */
            if($(this).val().length > title_num){
                counter[0]=0;
                $(this).val($(this).val().substr(0, title_num));
                if(check_submit()==false){
                    $("#forum-create-submit").attr('disabled','');
                    $(".form-top p").html(content+" <strong>"+check_submit()+"</strong>");
                }
            }
            else if($(this).val().length < title_num && $(this).val().length > 0){
                counter[0]=1;
                if(!check_submit())
                    $(".form-top p").html(content+" <strong>文章字數須滿10字以上喔!</strong>");
                if(check_submit()==true)
                    $("#forum-create-submit").removeAttr('disabled');
            }
        });
        // $('#form-create-content').ckeditorGet().on('key', function(e) {
            // var keyCode = e.data.keyCode; // if you need to track the key
            // isModified = true;
            console.log($(this).val().length);
        // });

        $("#form-create-content").keydown(function(){
            /* 若content字數小於10則將submit disable */
            if($(this).val().length < content_num){
                counter[1]=0;
                $(this).val($(this).val().substr(0, content_num));
                if(check_submit()==false){
                    $("#forum-create-submit").attr('disabled','');
                    $(".form-top p").html(content+" <strong>文章內容字數不足</strong>");
                }
            }
            else{
                counter[1]=1;
                $("#forum-create-text-number-check").html(content);
                if(check_submit()==true){
                    $("#forum-create-submit").removeAttr('disabled');
                    $(".form-top p").html(content);
                }
            }
        });
        $('.forum-cancel-button').click(function()
        {
            $.confirm({
                message: '確定取消編輯此篇文章？',
                confirmed: function(result)
                {
                    if ( result ) window.location = $.configures.forumCancelUrl;
                    return false;
                }
            });
            return false;
        });
    });
})(jQuery);