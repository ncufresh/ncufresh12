<style>
#back-div
{
    background-color:yellow;
    position:relative;
}
#building
{
    height:100px;
    width:100px;
    position:absolute;
    z-index:2;
    left:0px;
    top:0px;
}
#building-list
{
    z-index:3;
    position:absolute;
    top:0px;
    left:0px;
    width:100px;
    color:white;
    border-radius:5px;
    background:gray;
    text-align:center;     
}
#building-list-ul
{
    display:none;
}
#building-list-ul-department, #building-list-ul-landscape, #building-list-ul-diet, #building-list-ul-government, #building-list-ul-dormitory
{
    position:absolute;
    display:none;
    z-index:3;
    top:20px;
    width:100px;
    left:100px;
    color:white;
    border-radius:5px;
    background:blue;
    text-align:center;  
}
#building-list-ul-diet
{
    position:absolute;
    display:none;
}
#building-list-ul-government
{
    position:absolute;
    display:none;
}
#building-list-ul-dormitory
{
    position:absolute;
    display:none;
}
#boy-11
{
    left:130px;
    top:420px;
}
#computer
{
    left:460px;
    top:180px;
}
#checkbox-1
{
    position:absolute;
    z-index:2;
    left:640px;
    top:50px;
}#checkbox-2
{
    position:absolute;
    z-index:2;
    left:640px;
    top:70px;
}#checkbox-3
{
    position:absolute;
    z-index:2;
    left:640px;
    top:90px;
}#checkbox-4
{
    position:absolute;
    z-index:2;
    left:640px;
    top:110px;
}#checkbox-5
{
    position:absolute;
    z-index:2;
    left:640px;
    top:130px;
}#checkbox-6
{
    position:absolute;
    z-index:2;
    left:640px;
    top:150px;
}
#cake
{
    left:400px;
    top:180px;
}
#dialog-div-1
{
    display:none;
    background:white;
}
#dialog1-up-div
{
    overflow:auto;
    background-color:red;
    height:400px;
}

#dialog1-down-div
{
    overflow:auto;
    background-color:green;
    height:250px;
}
#dialog-div-2
{
    display:none;
}
#dialog2-up-back
{
    height:350px;
    width:500px;
    background-color:black;
}
#dialog2-down-back
{
    height:50px;
    width:500px;
    background-color:white;
    position:absolute;
    left:0;
    bottom:0;
}
#dialog2-button-left
{
    position:absolute;
    left:0;
    bottom:0;
}
#dialog2-button-right
{
    position:absolute;
    right:0;
    bottom:0;
}
#electricity-5
{ 
    left:0px;
    top:100px; 
}
#electricity-1
{
    left:160px;
    top:240px;
}
#electricity-4
{
    left:100px;
    top:80px;
}
#flower
{
    left:250px;
    top:150px; 
}
#girl-14
{
    left:100px;
    top:390px;
}
#government
{
    left:380px;
    top:340px
}
#img1
{
    position:absolute;
    left:0px;
}
#img2
{
    position:absolute;
    left:50px;
}
#img3
{
    position:absolute;
    left:100px;
}
#kon-fu
{
    left:210px;
    top:280px; 
}
#library
{
    left:330px;
    top:300px
}
#little-man
{
    clear:both;
    float:left;
}
#landscape-text
{
    position:absolute;
    color:red;
}
#map-picture
{
    position:relative;
    height:622;
    width:572;
    margin-left:0;
    z-index:1;
}
#mose
{
    left:70px;
    top:180px;
}
#new
{
    left:540px;
    top:180px;
}
#picture-main
{
    float:right;    
    height:200px; 
    width:300px;
    background-color:gray;
}
#picture-other-1
{
    float:left;
    margin-right:10px;
    height:150px;
    width:250px;
    background-color:gray;
}
#picture-other-2
{    
    float:left;
    height:150px;
    width:250px;
    background-color:gray;
}
#street
{
    left:50px;
    top:340px
}
#tree
{   
    left:370px;
    top:210px;
}
.department-building
{    
}
.dormitory
{    
}
.diet
{    
}
.government
{    
}
.landscape
{    
}
.picture 
{       
    position:absolute;
    z-index:2;         
}
.picture img
{
    height:50px;
    width:50px;
}



.building-list-item li
{
    cursor: pointer;
}
.building-list-item li:hover
{
    color: black;
    background: yellow;
}
.building-list2-item:hover
{
    color: black;
    background: yellow;
}

#building-list-ul, #building-list-ul ul
{
    margin: 0;
    padding: 0;
}

#building-list-ul li
{
    list-style: none;
}
</style>

    
    <div>
        <img src="<?php echo Yii::app()->baseUrl?>/statics/little_man.jpg" style="position:absolute; top:0px; left:0px; z-index:5" id="imageimage">
    </div>
<div id="back-div">
    <img src="<?php echo Yii::app()->baseUrl?>/statics/pp.jpg" id="map-picture"><!--底圖-->
    <!--<a id="building" href="<?php //echo Yii::app()->createUrl('street/building', array('id' => 2));?>"><img src="<?php //echo Yii::app()->baseUrl?>/statics/marquee_star_icon.png" ></a>-->
    <!--系館-->
    <a id="electricity-5" class="department-building picture" href="#1"><img src="<?php echo Yii::app()->baseUrl?>/statics/building/college/555.png"></a>
    <a id="electricity-1" class="department-building picture" href="#2"><img src="<?php echo Yii::app()->baseUrl?>/statics/building/college/111.png"></a>
    <a id="electricity-4" class="department-building picture" href="#3"><img src="<?php echo Yii::app()->baseUrl?>/statics/building/college/444.png"></a>
    <!--景觀-->
    <a id="flower" class="landscape picture" href="<?php echo Yii::app()->createUrl('street/building',array('id' => 4));?>"><img src="<?php echo Yii::app()->baseUrl?>/statics/building/landscape/flower.png"></a>
    <a id="kon-fu" class="landscape picture" href="<?php echo Yii::app()->createUrl('street/building',array('id' => 5));?>"><img src="<?php echo Yii::app()->baseUrl?>/statics/building/landscape/kon_fu.png"></a>
    <a id="tree"class="landscape picture" href="<?php echo Yii::app()->createUrl('street/building',array('id' => 6));?>"><img src="<?php echo Yii::app()->baseUrl?>/statics/building/landscape/tree.png"></a>
    <!--飲食-->
    <a id="cake"class="diet picture" href="<?php echo Yii::app()->createUrl('street/building',array('id' => 7));?>"><img src="<?php echo Yii::app()->baseUrl?>/statics/building/food/cake.png" ></a>
    <a id="mose" class="diet picture" href="<?php echo Yii::app()->createUrl('street/building',array('id' => 8));?>"><img src="<?php echo Yii::app()->baseUrl?>/statics/building/food/mose.png"></a>
    <a id="street" class="diet picture" href="<?php echo Yii::app()->createUrl('street/building',array('id' => 9));?>"><img src="<?php echo Yii::app()->baseUrl?>/statics/building/food/street.png"></a>
    <!--行政-->
    <a id="computer" class="government picture" href="<?php echo Yii::app()->createUrl('street/building',array('id' => 10));?>"><img src="<?php echo Yii::app()->baseUrl?>/statics/building/government/computer.png"></a>
    <a id="government" class="government picture" href="<?php echo Yii::app()->createUrl('street/building',array('id' => 11));?>"><img src="<?php echo Yii::app()->baseUrl?>/statics/building/government/government.png"></a>
    <a id="library" class="government picture" href="<?php echo Yii::app()->createUrl('street/building',array('id' => 12));?>"><img src="<?php echo Yii::app()->baseUrl?>/statics/building/government/library.png"></a>
    <!--宿舍-->
    <a id="boy-11" class="dormitory picture" href="<?php echo Yii::app()->createUrl('street/building',array('id' => 13));?>"><img src="<?php echo Yii::app()->baseUrl?>/statics/building/dormitory/boy_11.png"></a>
    <a id="girl-14" class="dormitory picture" href="<?php echo Yii::app()->createUrl('street/building',array('id' => 14));?>"><img src="<?php echo Yii::app()->baseUrl?>/statics/building/dormitory/girl_14.png"></a>
    <a id="new" class="dormitory picture" href="<?php echo Yii::app()->createUrl('street/building',array('id' => 15));?>"><img src="<?php echo Yii::app()->baseUrl?>/statics/building/dormitory/new.png"></a>
    <!--綜觀-->
    <input type="checkbox" id="checkbox-1" class="building-checkbox">
    <input type="checkbox" id="checkbox-2" class="building-checkbox">
    <input type="checkbox" id="checkbox-3" class="building-checkbox">
    <input type="checkbox" id="checkbox-4" class="building-checkbox">
    <input type="checkbox" id="checkbox-5" class="building-checkbox">
    <input type="checkbox" id="checkbox-6" class="building-checkbox">
    
    <div id="building-list">
        <span>清單</span>
        <ul id="building-list-ul">
            <li class="building-list-item item1">
                系館     
                <ul id="building-list-ul-department">
                    <li class="building-list2-item item2-1-1">
                        工一                            
                    </li>
                    <li class="building-list2-item item2-1-2">
                        工二                            
                    </li>
                    <li class="building-list2-item item2-1-3">
                        工三                         
                    </li>
                    <li class="building-list2-item item2-1-4">
                        工五                  
                    </li>
                    <li class="building-list2-item item2-1-5">
                        國鼎光電大樓                         
                    </li>
                    <li class="building-list2-item item2-1-6">
                        科學一館                         
                    </li>
                    <li class="building-list2-item item2-1-7">
                        科學二館                    
                    </li>
                    <li class="building-list2-item item2-1-8">
                        科學三館                       
                    </li>
                    <li class="building-list2-item item2-1-9">
                        科學四館	                        
                    </li>
                    <li class="building-list2-item item2-1-10">
                        科學五館                            
                    </li>
                    <li class="building-list2-item item2-1-11">
                        理學院教學館                           
                    </li>
                    <li class="building-list2-item item2-1-12">
                        鴻經館                           
                    </li>
                    <li class="building-list2-item item2-1-13">
                        客家學院大樓                            
                    </li>
                    <li class="building-list2-item item2-1-14">
                        文學院                         
                    </li>
                    <li class="building-list2-item item2-1-15">
                        管學院                            
                    </li>
                    <li class="building-list2-item item2-1-16">
                        綜教館                           
                    </li>
                    <li class="building-list2-item item2-1-17">
                        綜合教學大樓                          
                    </li>
                </ul>
            </li>
            <li class="building-list-item item2">
                景觀
                <ul id="building-list-ul-landscape">
                    <li class="building-list2-item item2-2-1">
                        中大湖                        	
                    </li>                        
                    <li class="building-list2-item item2-2-2">
                        烏龜池                       	  
                    </li>
                    <li class="building-list2-item item2-2-3">
                        情人步道                       	   
                    </li>
                    <li class="building-list2-item item2-2-4">
                        坐聽‧松風                       	   
                    </li>
                    <li class="building-list2-item item2-2-5">
                        漫步雲端                       	    
                    </li>
                    <li class="building-list2-item item2-2-6">
                        大象五行                        	    
                    </li>
                    <li class="building-list2-item item2-2-7">
                        蘊‧行                       	    
                    </li>
                    <li class="building-list2-item item2-2-8">
                        百花川                        	    
                    </li>
                    <li class="building-list2-item item2-2-9">
                        國泰樹                       	    
                    </li>
                    <li class="building-list2-item item2-2-10">
                        筆墨紙硯                       	    
                    </li>
                    <li class="building-list2-item item2-2-11">
                        中大會館                       	    
                    </li>
                    <li class="building-list2-item item2-2-12">
                        松濤書閣                       	    
                    </li>
                    <li class="building-list2-item item2-2-13">
                        校園咖啡                      	    
                    </li>                                 
                </ul>
            </li> 
            <li class="building-list-item item3">
                飲食
                <ul id="building-list-ul-diet">
                    <li class="building-list3-item item2-3-1">
                        男七餐廳
                    </li>
                    <li class="building-list2-item item2-3-2">
                        男九餐廳
                    </li>
                    <li class="building-list2-item item2-3-3">
                        消夜街
                    </li>
                    <li class="building-list2-item item2-3-4">
                        後門
                    </li>
                    <li class="building-list2-item item2-3-5">
                        松濤小木屋區
                    </li>
                    <li class="building-list2-item item2-3-6">
                        小木屋鬆餅
                    </li>                       
                </ul>
            </li>
            <li class="building-list-item item4">
                行政
                <ul id="building-list-ul-government">
                    <li class="building-list2-item item2-4-1">
                        行政大樓
                    </li>
                    <li class="building-list2-item item2-4-2">
                        志希館 電算中心
                    </li>
                    <li class="building-list2-item item2-4-3">
                        校史館
                    </li>
                    <li class="building-list2-item item2-4-4">
                        育成中心
                    </li>
                    <li class="building-list2-item item2-4-5">
                    	學生活動中心
                    </li>
                </ul>
            </li>
            <li class="building-list-item item5">
                宿舍
                <ul id="building-list-ul-dormitory">
                    <li class="building-list2-item item2-5-1">  
                        女一 ~ 四舍
                    </li>
                    <li class="building-list2-item item2-5-2">  
                    	女五舍
                    </li>
                    <li class="building-list2-item item2-5-3">  
                    	男三舍
                    </li>
                    <li class="building-list2-item item2-5-4">  
                    	男五舍
                    </li>
                    <li class="building-list2-item item2-5-5">  
                    	男六舍
                    </li>
                    <li class="building-list2-item item2-5-6">  
                    	男七舍
                    </li>
                    <li class="building-list2-item item2-5-7">  
                    	男九舍
                    </li>
                    <li class="building-list2-item item2-5-8">  
                    	男11舍
                    </li>
                    <li class="building-list2-item item2-5-9">  
                    	男12舍
                    </li>
                    <li class="building-list2-item item2-5-10">  
                    	男13舍
                    </li>
                    <li class="building-list2-item item2-5-11">  
                    	女14舍
                    </li>
                    <li class="building-list2-item item2-5-12">  
                    	新研舍
                    </li>                
                </ul>
            </li>
            <li class="building-list-item item6">
                綜觀                  
            </li>
        </ul>            
    </div>
</div>

<div id="dialog-div-1"><!--第一層-->
    <div id="dialog1-up-div">          
        <p id="dialog1-up-content">
        <div id="picture-main">
        <img id="main">
        <!--正視圖-->
        </div>  
        </p>
    </div> 
    
    <div id="dialog1-down-div">
        <div id="picture-other-1">
        <img id="other-1">
        <!--其他圖 1-->
        </div>    
        <div id="picture-other-2">
        <img id="other-2">
        <!--其他圖 2-->
        </div>
        <img src="<?php echo Yii::app()->baseUrl?>/statics/little_man.jpg" id="little-man">      
    </div>   
</div>

<div id="dialog-div-2"><!--第二層-->
    <div id="dialog2-up-back"><!--2-1-->
        <img src="<?php echo Yii::app()->baseUrl?>/statics/logo.png" id="dialog2_main_picture">
    </div>

    <div id="dialog2-down-back"><!--2-2-->
        <button id="dialog2-button-left">left</button>

        <div>
            <img id="img1" src="<?php echo Yii::app()->baseUrl?>/statics/1.jpg">
            <img id="img2" src="<?php echo Yii::app()->baseUrl?>/statics/2.png">
            <img id="img3" src="<?php echo Yii::app()->baseUrl?>/statics/3.jpg">
        </div>

        <button id="dialog2-button-right">right</button>
    </div>
</div>



<script type="text/javascript"> 
// $(document).mousemove(function(e) {
$(document).mousemove(function(event) { // 相對於 back-div 的座標
 // + document.documentElement.scrollLeft

// console.log($('#back-div').offset().left);
// x=$('#back-div').offset().left;
// y=$('#back-div').offset().top;
// x = event.clientX;
// y = event.clientY;
// x = event.screenX;
// y = event.screenY;
x = event.pageX;
y = event.pageY;
// alert('x: '+x+'~~y: '+y);
$('#imageimage').css(
{
    top:y+'px',
    left:x+'px',
});
});




    $('.item1, .item2, .item3, .item4, .item5, .item6').attr('item:checked','checked');
    $('#checkbox-1, .item1').click(function()
    {//系館
        $('.department-building, .landscape, .diet, .government, .dormitory').show();
        $("#checkbox-2, #checkbox-3, #checkbox-4, #checkbox-5, #checkbox-6").removeAttr('checked');                
        if($('#checkbox-1').prop('checked')||$('.item1').attr('item:checked')=='checked')
        {
            $('.landscape, .diet, .government, .dormitory').hide();
        }
        else
        {        
            $('.landscape, .diet, .government, .dormitory').show();
        }
    });
    $('#checkbox-2, .item2').click(function()
    {//景觀
        $('.department-building, .landscape, .diet, .government, .dormitory').show();
        $("#checkbox-1, #checkbox-3, #checkbox-4, #checkbox-5, #checkbox-6").removeAttr('checked');
        if($('#checkbox-2').prop('checked')||$('.item2').attr('item:checked')=='checked')
        {
            $('.department-building, .diet, .government, .dormitory').hide(); 
        }
        else
        {
            $('.department-building, .diet, .government, .dormitory').show();
        }
    });
    $('#checkbox-3, .item3').click(function()
    {//飲食
        $('.department-building, .landscape, .diet, .government, .dormitory').show();
        $("#checkbox-1, #checkbox-2, #checkbox-4, #checkbox-5, #checkbox-6").removeAttr('checked');
        if($('#checkbox-3').prop('checked')||$('.item3').attr('item:checked')=='checked')
        {
            $('.department-building, .landscape, .government, .dormitory').hide();
        }
        else
        {
            $('.department-building, .landscape, .government, .dormitory').show();
        }
    });
    $('#checkbox-4, .item4').click(function()
    {//行政
        $('.department-building, .landscape, .diet, .government, .dormitory').show();
        $("#checkbox-1 #checkbox-2, #checkbox-3, #checkbox-5, #checkbox-6").removeAttr('checked');
        if($('#checkbox-4').prop('checked')||$('.item4').attr('item:checked')=='checked')
        {
            $('.department-building, .landscape, .diet, .dormitory').hide();
        }
        else
        {
            $('.department-building, .landscape, .diet, .dormitory').show();
        }
    });
    $('#checkbox-5, .item5').click(function()
    {//宿舍
        $('.department-building, .landscape, .diet, .government, .dormitory').show();
        $("#checkbox-1, #checkbox-2, #checkbox-3, #checkbox-4, #checkbox-6").removeAttr('checked');
        if($('#checkbox-5').prop('checked')||$('.item5').attr('item:checked')=='checked')
        {
            $('.department-building, .landscape, .diet, .government').hide();
        }
        else
        {
            $('.department-building, .landscape, .diet, .government').show();
        }
    });  
    $('#checkbox-6, .item6').click(function()
    {//綜觀     
        $('.department-building, .landscape, .diet, .government, .dormitory').show();
        $("#checkbox-1, #checkbox-2, #checkbox-3, #checkbox-4, #checkbox-5").removeAttr('checked');
    });
    
    $('#building-list').hover(function() // 第一層 ul
    {
        if(!$('#building-list-ul').hasClass('active'))
        {
            $('#building-list-ul').slideDown(500, function(){
                $('#building-list-ul').removeClass('active');
            });
            $('#building-list-ul').addClass('active');
        }
    },function()
    {
        if(!$('#building-list-ul').hasClass('active'))
        {
            $('#building-list-ul').slideUp(500, function(){
                $('#building-list-ul').removeClass('active');
            });
            $('#building-list-ul').addClass('active');
        }
    });
    
    $('#building-list-ul li').mouseenter(function() // 第二層 ul
    {
        $(this).children('ul').fadeIn(500);
    });
    $('#building-list-ul li').mouseleave(function()
    {
        $(this).children('ul').fadeOut(500);
    });

    
    var dialog_div_1 = $('#dialog-div-1');
    dialog_div_1.dialog({
        width: 999,
        height: 700,
        modal: true,
        draggable: false,
        buttons:{'button!!':function()
        {
        $('div#dialog-div-2').dialog('open');
        }},
    });
    dialog_div_1.dialog('close');//dialog_1 瞬間出現再結束
    $('div.ui-dialog-buttonpane').css('background', 'yellow');// 第一層底下區域
//---------------------------------------------------------------------------------------------
    var dialog_div_2=$('div#dialog-div-2');
        dialog_div_2.dialog({
        width:500,
        height:400,
        modal:true,
        draggable:false,
    });
    dialog_div_2.dialog('close'); // dialog_2 瞬間出現再結束       
//----------------------------------------------------------------------------------------------  
    // $('#building').mouseenter(function()
    // {
        // $('#building').attr('src','<?php echo Yii::app()->baseUrl?>/statics/chat.png');
    // });
    // $('#building').mouseleave(function()
    // {
        // $('#building').attr('src','<?php echo Yii::app()->baseUrl?>/statics/marquee_star_icon.png' );
    // }); 
    
    // $('#electricity-5, #electricity-1 ,#electricity-4, #flower,#kon-fu, #tree, #cake, #mose, #street, #computer, #government, #library, #boy-11, #girl-14, #new').click(function()
    // {        
        // $.getJSON($('#'+$(this).attr('id')).attr('href'), function(data)
        // {
            // $('#dialog1-up-content').text(data.content);
        // });    

    $('#electricity-5, #electricity-1 ,#electricity-4, #flower,#kon-fu, #tree, #cake, #mose, #street, #computer, #government, #library, #boy-11, #girl-14, #new').click(function()
    {    
        dialog_div_1.dialog('open'); // 打開第一層
        $('span.ui-icon').text('關閉'); // 關閉鈕
        $('.ui-dialog-titlebar-close').css({
            right: 0,
            position: 'absolute',
            background:'gray'
        });
        var id = $(this).attr('href').replace('#','');        
         $.ajax(
        {
            type: 'GET',
            url: 'http://localhost/ncufresh12/street/building/'+id+'.html',
            dataType:'json',
            success:function(data)
            {                
                $('#dialog1-up-content').text(data.content);
                $('#main').attr('src',data.picture_main);
                $('#other-1').attr('src',data.picture_other_1);
                $('#other-2').attr('src',data.picture_other_2);              
            },
        });
        return false;
    });

    $('#dialog2-button-left').click(function()
    {
        $('#img1').animate({left:'0px'});
    });
    $('#dialog2-button-right').click(function()
    {
        $('#img1').animate({left:'80px'});
    });

    $('#img1').click(function()
    {
        $('#dialog2_main_picture').attr('src','<?php echo Yii::app()->request->baseUrl;?>/statics/1.jpg');
    });
    $('#img2').click(function()
    {
        $('#dialog2_main_picture').attr('src','<?php echo Yii::app()->request->baseUrl;?>/statics/2.png');
    });
    $('#img3').click(function()
    {
        $('#dialog2_main_picture').attr('src','<?php echo Yii::app()->request->baseUrl;?>/statics/3.jpg');
    });
</script>
</div>
