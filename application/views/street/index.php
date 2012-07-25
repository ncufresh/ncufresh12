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
#electricity-3
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

.one-image
{
    position:absolute;
    height:50px;
    width:50px;
    z-index:1;
}
</style>
    
    <img src="<?php echo Yii::app()->baseUrl?>/statics/little_man.jpg" style="position:absolute; top:0px; left:0px; z-index:4" id="imageimage">
<div id="back-div">
               
            <img src="<?php echo Yii::app()->baseUrl?>/statics/building/arrow-up.png" class="arrow" style="position:absolute; z-index:4; left:260px; top:200px; display:none;">
            <img src="<?php echo Yii::app()->baseUrl?>/statics/building/arrow-down.png" class="arrow" style="position:absolute; z-index:4; left:260px; top:320px; display:none;">
            <img src="<?php echo Yii::app()->baseUrl?>/statics/building/arrow-left.png" class="arrow" style="position:absolute; z-index:4; left:160px; top:260px;display:none;">
            <img src="<?php echo Yii::app()->baseUrl?>/statics/building/arrow-right.png" class="arrow" style="position:absolute; z-index:4; left:360px; top:260px; display:none;">
            <img src="<?php echo Yii::app()->baseUrl?>/statics/building/right-turn.png" class="arrow" style="position:absolute; z-index:4; left:380px; top:350px;display:none;">
            <img src="<?php echo Yii::app()->baseUrl?>/statics/building/left-turn.png" class="arrow" style="position:absolute; z-index:4; left:140px; top:350px; display:none;">
            
            <img src="<?php echo Yii::app()->baseUrl?>/statics/building/back.png" class="arrow" style="position:absolute; z-index:4; left:670px; top:0px; display:none;">
            <img src="<?php echo Yii::app()->baseUrl?>/statics/building/day.png" class="arrow" style="position:absolute; z-index:4; left:0px; top:0px; display:none;">
            <img src="<?php echo Yii::app()->baseUrl?>/statics/building/hide.png" class="arrow" style="position:absolute; z-index:4; left:0px; top:382px; display:none;">
            <!--<img >
            總寬:750px 總高:422px  窗簾:250px  地圖:寬500px高422px 
            <img >-->
   
    
    <img src="<?php echo Yii::app()->baseUrl?>/statics/pp.png" id="map-picture"><!--底圖-->
    <!--<a id="building" href="<?php //echo Yii::app()->createUrl('street/building', array('id' => 2));?>"><img src="<?php //echo Yii::app()->baseUrl?>/statics/marquee_star_icon.png" ></a>-->
    <!--系館-->
    <a id="electricity-5" class="department-building picture" showMe="department-building" href="#1"><img src="<?php echo Yii::app()->baseUrl?>/statics/building/college/555.png"></a>
    <a id="electricity-3" class="department-building picture" showMe="department-building" href="#3"><img src="<?php echo Yii::app()->baseUrl?>/statics/building/college/444.png"></a>
    <!--<a id="electricity-2" class="department-building picture" showMe="department-building"><img></a>-->
    <a id="electricity-1" class="department-building picture" showMe="department-building" href="#2"><img src="<?php echo Yii::app()->baseUrl?>/statics/building/college/111.png"></a>
        
    <a><img></a>
    <a><img></a>
    <a><img></a>
    <a><img></a>
    <a><img></a>
    <a><img></a>
    <a><img></a>
    <a><img></a>
    <a><img></a>
    <a><img></a>
    <a><img></a>
    <a><img></a>
    <a><img></a>
    <!--景觀-->
    <a id="flower" class="landscape picture" showMe="landscape" href="<?php echo Yii::app()->createUrl('street/building',array('id' => 4));?>"><img src="<?php echo Yii::app()->baseUrl?>/statics/building/landscape/flower.png"></a>
    <a id="kon-fu" class="landscape picture" showMe="landscape" href="<?php echo Yii::app()->createUrl('street/building',array('id' => 5));?>"><img src="<?php echo Yii::app()->baseUrl?>/statics/building/landscape/kon_fu.png"></a>
    <a id="tree"class="landscape picture" showMe="landscape" href="<?php echo Yii::app()->createUrl('street/building',array('id' => 6));?>"><img src="<?php echo Yii::app()->baseUrl?>/statics/building/landscape/tree.png"></a>
    <a><img></a>
    <a><img></a>
    <a><img></a>
    <a><img></a>
    <a><img></a>
    <a><img></a>
    <a><img></a>
    <a><img></a>
    <a><img></a>
    <a><img></a>
    <!--飲食-->
    <a id="cake"class="diet picture" showMe="diet" href="<?php echo Yii::app()->createUrl('street/building',array('id' => 7));?>"><img src="<?php echo Yii::app()->baseUrl?>/statics/building/food/cake.png" ></a>
    <a id="mose" class="diet picture" showMe="diet" href="<?php echo Yii::app()->createUrl('street/building',array('id' => 8));?>"><img src="<?php echo Yii::app()->baseUrl?>/statics/building/food/mose.png"></a>
    <a id="street" class="diet picture" showMe="diet" href="<?php echo Yii::app()->createUrl('street/building',array('id' => 9));?>"><img src="<?php echo Yii::app()->baseUrl?>/statics/building/food/street.png"></a>
    <a><img></a>
    <a><img></a>
    <a><img></a>
    <!--行政-->
    <a id="computer" class="government picture" showMe="government" href="<?php echo Yii::app()->createUrl('street/building',array('id' => 10));?>"><img src="<?php echo Yii::app()->baseUrl?>/statics/building/government/computer.png"></a>
    <a id="government" class="government picture" showMe="government" href="<?php echo Yii::app()->createUrl('street/building',array('id' => 11));?>"><img src="<?php echo Yii::app()->baseUrl?>/statics/building/government/government.png"></a>
    <a id="library" class="government picture" showMe="government" href="<?php echo Yii::app()->createUrl('street/building',array('id' => 12));?>"><img src="<?php echo Yii::app()->baseUrl?>/statics/building/government/library.png"></a>
    <a><img></a>
    <a><img></a>
    <!--宿舍-->
    <a id="boy-11" class="dormitory picture" showMe="dormitory" href="<?php echo Yii::app()->createUrl('street/building',array('id' => 13));?>"><img src="<?php echo Yii::app()->baseUrl?>/statics/building/dormitory/boy_11.png"></a>
    <a id="girl-14" class="dormitory picture" showMe="dormitory" href="<?php echo Yii::app()->createUrl('street/building',array('id' => 14));?>"><img src="<?php echo Yii::app()->baseUrl?>/statics/building/dormitory/girl_14.png"></a>
    <a id="new" class="dormitory picture" showMe="dormitory" href="<?php echo Yii::app()->createUrl('street/building',array('id' => 15));?>"><img src="<?php echo Yii::app()->baseUrl?>/statics/building/dormitory/new.png"></a>
    <a><img></a>
    <a><img></a>
    <a><img></a>
    <a><img></a>
    <a><img></a>
    <a><img></a>
    <a><img></a>
    <a><img></a>
    <a><img></a>
    <!--選擇鈕-->
    <img src="<?php echo Yii::app()->baseUrl?>/statics/building/dormitory/dormitory.png" class="one-image dormitory" showMe="dormitory" style="top:50px;left:660px;">
    <img src="<?php echo Yii::app()->baseUrl?>/statics/building/food/food.png" class="one-image diet" showMe="diet" style="top:110px;left:660px;">
    <img src="<?php echo Yii::app()->baseUrl?>/statics/building/college/college.png" class="one-image department-building" showMe="department-building" style="top:170px;left:660px;">
    <img src="<?php echo Yii::app()->baseUrl?>/statics/building/landscape/landscape.png" class="one-image landscape" showMe="landscape" style="top:230px;left:660px;">
    <img src="<?php echo Yii::app()->baseUrl?>/statics/building/government/government-out.png" class="one-image government" showMe="government" style="top:290px;left:660px;">
    <img src="<?php echo Yii::app()->baseUrl?>/statics/building/click.png" class="one-image image6" style="top:350px;left:660px;">
    <!--窗簾-->
    <div>
    <img src="<?php echo Yii::app()->baseUrl?>/statics/building/curtain.png" style=" position:absolute; z-index:2; top:0px;left:750px;" id="curtain">
    <img src="<?php echo Yii::app()->baseUrl?>/statics/building/unclick.png" style=" position:absolute; z-index:2; top:372px;left:750px;" id="unclick">
    </div>
    <!--<div style="position:absolute; z-index:6; height:150px; width:150px; background-color:red; top:0px; left:600px;">
    </div>-->
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
        <img src="<?php echo Yii::app()->baseUrl?>/statics/little_man.jpg" id="dialog2_main_picture">
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
<?php $this->beginWidget('system.web.widgets.CClipWidget', array('id' => 'script')); ?>
<script type="text/javascript">
    $('#imageimage').mousedown(function()
    {
        $(document).mousemove(mousemove);
    });    
    var mouseInId;
    var isInPicture = false;
    var mousemove = function(event)
    {
        x = event.pageX;
        y = event.pageY;
        $('#imageimage').css(
        {
        top:y+15+'px',
        left:x+'px',
        });        
    };    
    $('.picture').mouseenter(function()
    {
        isInPicture = true;
        mouseInId = $(this).attr('id');       
    });    
    $('.picture').mouseleave(function()
    {        
        isInPicture = false;
    });
    var mouseup = function()
    {
        // alert(isInPicture);
        if( isInPicture == true)
        {
            // alert(mouseInId);        
            $('#map-picture').attr('src','<?php echo Yii::app()->baseUrl?>/statics/building/college/555-big.png');
            $('#map-picture').css({
                zIndex:'3',
            });
            $('.arrow').show();
            isInPicture=false;
        }   
            $(document).unbind('mousemove', mousemove);
            $('#imageimage').css(
            {
            top:0,
            left:0,
            });
            isInPicture = false;
    };
    $(document).mouseup(mouseup); 

    $('.one-image, picture').click(function() // building icon show 
    {
        $('.picture').hide();
        $('.' + $(this).attr('showMe')).show();
    });
    
    $('.image6').click(function()
    {// 窗簾     
        $('#curtain').animate({left:'600px'});
        $('#unclick').animate({left:'700px'});        
    });
    $('#unclick').click(function()
    {// 窗簾     
        $('#curtain').animate({left:'750px'});
        $('#unclick').animate({left:'750px'});        
    });  

    
    // $('.arrow').eq(0).click(function()
    // {     
        // $('#map-picture').attr('src','<?php echo Yii::app()->request->baseUrl;?>/statics/building/college/444-big.png');
    // });
    // $('.arrow').eq(1).click(function()
    // {     
        // $('#map-picture').attr('src','<?php echo Yii::app()->request->baseUrl;?>/statics/building/college/111-big.png');
    // });
    // $('.arrow').eq(2).click(function()
    // {     
        // $('#map-picture').attr('src','<?php echo Yii::app()->request->baseUrl;?>/statics/building/college/555-big.png');
    // });
    // $('.arrow').eq(3).click(function()
    // {     
        // $('#map-picture').attr('src','<?php echo Yii::app()->request->baseUrl;?>/statics/building/college/444-big.png');
    // });
    // $('.arrow').eq(4).click(function()
    // {     
        // $('#map-picture').attr('src','<?php echo Yii::app()->request->baseUrl;?>/statics/building/college/111-big.png');
    // });
    // $('.arrow').eq(5).click(function()
    // {     
        // $('#map-picture').attr('src','<?php echo Yii::app()->request->baseUrl;?>/statics/building/college/555-big.png');
    // });
    
    $('.arrow').eq(6).click(function() // 親身體驗 back
    {     
        $('#map-picture').attr('src', '<?php echo Yii::app()->request->baseUrl;?>/statics/pp.png');
        $('.arrow').hide();
        $('#map-picture').css(
        {
            zIndex:0,
        });
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

    $('.picture').click(function()
    {    
        dialog_div_1.dialog('open'); // 打開第一層
        $('span.ui-icon').text('關閉'); // 關閉鈕
        $('.ui-dialog-titlebar-close').css({
            right: 0,
            position: 'absolute',
            background:'gray'
        });
        
        $('#map-picture').attr('src', '<?php echo Yii::app()->request->baseUrl;?>/statics/pp.png');
        $('.arrow').hide();
        $('#map-picture').css(
        {
            zIndex:0,
        });
        isInPicture = false;
        
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
//http://www.dotblogs.com.tw/shadow/archive/2012/04/17/71588.aspx
     
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
<?php $this->endWidget();?>
</div>
