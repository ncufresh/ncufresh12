<?php Yii::app()->clientScript->registerCoreScript('jquery.ui'); ?>

<?php
	// <link type='text/css' rel='stylesheet' href='http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.21/themes/base/jquery-ui.css' />    
?>

<?php
$content='額額額額額額額額額額額額額額額額額額額額額
        額額額額額額額額額額額額額額額額額額額額額
        額額額額額額額額額額額額額額額額額額額額額
        額額額額額額額額額額額額額額額額額額額額額
        額額額額額額額額額額額額額額額額額額額額額
        額額額額額額額額額額額額額額額額額額額額額
        額額額額額額額額額額額額額額額額額額額額額
        額額額額額額額額額額額額額額額額額額額額額
        額額額額額額額額額額額額額額額額額額額額額
        額額額額額額額額額額額額額額額額額額額額額
        額額額額額額額額額額額額額額額額額額額額額
        額額額額額額額額額額額額額額額額額額額額額
        額額額額額額額額額額額額額額額額額額額額額
        額額額額額額額額額額額額額額額額額額額額額
        額額額額額額額額額額額額額額額額額額額額額
        額額額額額額額額額額額額額額額額額額額額額
        額額額額額額額額額額額額額額額額額額額額額
        額額額額額額額額額額額額額額額額額額額額額
        額額額額額額額額額額額額額額額額額額額額額
        額額額額額額額額額額額額額額額額額額額額額
        額額額額額額額額額額額額額額額額額額額額額
        額額額額額額額額額額額額額額額額額額額額額
        額額額額額額額額額額額額額額額額額額額額額
        額額額額額額額額額額額額額額額額額額額額額
        額額額額額額額額額額額額額額額額額額額額額
        額額額額額額額額額額額額額額額額額額額額額
        額額額額額額額額額額額額額額額額額額額額額
        額額額額額額額額額額額額額額額額額額額額額
        額額額額額額額額額額額額額額額額額額額額額
        額額額額額額額額額額額額額額額額額額額額額
        額額額額額額額額額額額額額額額額額額額額額
        額額額額額額額額額額額額額額額額額額額額額
        額額額額額額額額額額額額額額額額額額額額額
        額額額額額額額額額額額額額額額額額額額額額
        額額額額額額額額額額額額額額額額額額額額額
        額額額額額額額額額額額額額額額額額額額額額
        額額額額額額額額額額額額額額額額額額額額額
        額額額額額額額額額額額額額額額額額額額額額';
        // echo $test;
        echo $data->content;
?>
<style>
#back-div
{
    background-color:yellow;
    position:relative;
}
#map-picture
{
    position:relative;
    height:622;
    width:572;
    margin-left:0;
    z-index:1;
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
#electricity-5
{
    position:absolute;
    height:50px;
    width:50px;
    z-index:2;
    left:0px;
    top:100px;
}
#electricity-1
{
    position:absolute;
    height:50px;
    width:50px;
    z-index:2;
    left:160px;
    top:240px;
}
#electricity-4
{
    position:absolute;
    height:50px;
    width:50px;
    z-index:2;
    left:100px;
    top:80px;
}
#flower
{
    position:absolute;
    height:50px;
    width:50px;
    z-index:2;
    left:250px;
    top:150px; 
}
#kon-fu
{
    position:absolute;
    height:50px;
    width:50px;
    z-index:2;
    left:210px;
    top:280px; 
}
#tree
{
    position:absolute;
    height:50px;
    width:50px;
    z-index:2;
    left:370px;
    top:210px;
}
#cake
{
    position:absolute;
    height:50px;
    width:50px;
    z-index:2;
    left:400px;
    top:180px;
}
#mose
{
    position:absolute;
    height:50px;
    width:50px;
    z-index:2;
    left:70px;
    top:180px;
}
#street
{
    position:absolute;
    height:50px;
    width:50px;
    z-index:2;
    left:50px;
    top:340px
}
#computer
{
    position:absolute;
    height:50px;
    width:50px;
    z-index:2;
    left:460px;
    top:180px;
}
#government
{
    position:absolute;
    height:50px;
    width:50px;
    z-index:2;
    left:380px;
    top:340px
}
#library
{
    position:absolute;
    height:50px;
    width:50px;
    z-index:2;
    left:330px;
    top:300px
}
#boy-11
{
    position:absolute;
    height:50px;
    width:50px;
    z-index:2;
    left:130px;
    top:420px;
}
#girl-14
{
    position:absolute;
    height:50px;
    width:50px;
    z-index:2;
    left:100px;
    top:390px;
}
#new
{
    position:absolute;
    height:50px;
    width:50px;
    z-index:2;
    left:540px;
    top:180px;
}
#checkbox-1
{
    position:absolute;
    z-index:2;
    left:640px;
    top:50px;
}
#landscape-text
{
    position:absolute;
    color:red;
}
#dialog-div-1
{
    display:none;
}
#picture-main
{
    float:right;    
    height:200px; 
    width:300px;
    background-color:gray;
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
#dialog2-button-right
{
    position:absolute;
    right:0;
    bottom:0;
}
#little-man
{
    clear:both;
    float:left;
}
</style>

<div id="back-div">
    <img src="<?php echo Yii::app()->baseUrl?>/statics/pp.jpg" id="map-picture"><!--底圖-->
    <a href="<?php echo Yii::app()->createUrl('street/Picture',array('id' => 2));?>"><img src="<?php echo Yii::app()->baseUrl?>/statics/marquee_star_icon.png" id="building"></a><!--建築-->
    <!--系館-->
    <img src="<?php echo Yii::app()->baseUrl?>/statics/building/college/555.png" id="electricity-5">
    <img src="<?php echo Yii::app()->baseUrl?>/statics/building/college/111.png" id="electricity-1">
    <img src="<?php echo Yii::app()->baseUrl?>/statics/building/college/444.png" id="electricity-4">
    <!--景觀-->
    <img src="<?php echo Yii::app()->baseUrl?>/statics/building/landscape/flower.png" id="flower">
    <img src="<?php echo Yii::app()->baseUrl?>/statics/building/landscape/kon_fu.png" id="kon-fu">
    <img src="<?php echo Yii::app()->baseUrl?>/statics/building/landscape/tree.png" id="tree">
    <!--飲食-->
    <img src="<?php echo Yii::app()->baseUrl?>/statics/building/food/cake.png" id="cake">
    <img src="<?php echo Yii::app()->baseUrl?>/statics/building/food/mose.png" id="mose">
    <img src="<?php echo Yii::app()->baseUrl?>/statics/building/food/street.png" id="street">
    <!--行政-->
    <img src="<?php echo Yii::app()->baseUrl?>/statics/building/government/computer.png" id="computer">
    <img src="<?php echo Yii::app()->baseUrl?>/statics/building/government/government.png" id="government">
    <img src="<?php echo Yii::app()->baseUrl?>/statics/building/government/library.png" id="library">
    <!--宿舍-->
    <img src="<?php echo Yii::app()->baseUrl?>/statics/building/dormitory/boy_11.png" id="boy-11">
    <img src="<?php echo Yii::app()->baseUrl?>/statics/building/dormitory/girl_14.png" id="girl-14">
    <img src="<?php echo Yii::app()->baseUrl?>/statics/building/dormitory/new.png" id="new">
    <!--綜觀-->
    <input type="checkbox" id="checkbox-1">
    <p id="landscape-text">
    景觀
    </p>
      
</div>

<div id="dialog-div-1"><!--第一層-->

    <div id="dialog1-up-div">          
        <p>
        <div id="picture-main">
        正視圖
        </div>  
        <?php
        echo $content;
        ?>
        
        </p>
    </div> 
    
    <div id="dialog1-down-div">
        <div id="picture-other-1">
        其他圖 1
        </div>    
        <div id="picture-other-2">
        其他圖 2
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
/////////////////////////////////////////dialog
var dialog_div_1 = $('#dialog-div-1');
dialog_div_1.dialog({
    width: 999,
    height: 700,
    modal: true,
    draggable: false, 
    buttons:{'button!!':function(){
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

$('div#dialog-div-2').css({
background:'yellow',
});

dialog_div_2.dialog('close');//dialog_2 瞬間出現再結束 	  
//----------------------------------------------------------------------------------------------  
 
</script>


 <script>
 //////////////////////////////picture
$('#building').mouseenter(function(){
    $('#building').attr('src','<?php echo Yii::app()->baseUrl?>/statics/chat.png');
});

$('#building').mouseleave(function(){
    $('#building').attr('src','<?php echo Yii::app()->baseUrl?>/statics/marquee_star_icon.png' );
});

$('#building').click(function(){//打開第一層
    dialog_div_1.dialog('open');
	
    $('div#dialog-div-1').css({
        background:'white' 
    });
    $('span.ui-icon').text('關閉');//關閉鈕
    $('.ui-dialog-titlebar-close').css({
        right: 0,
        position: 'absolute',
        background:'gray'
    }); 
return false;    
});
 <?php
// $(document).ready(function() {
    // $(#test).hoverpulse({
        // size: 40,  // 圖片縮放的大小
        // speed: 400 // 圖片變換大小的速度 
    // });
// });

//$('#building').src();
?>

$('#dialog2-button-left').click(function() {$('#img1').animate({left:'0px'});});
$('#dialog2-button-right').click(function() {$('#img1').animate({left:'80px'});});

$('#img1').click(function(){
    $('#dialog2_main_picture').attr('src','<?php echo Yii::app()->request->baseUrl;?>/statics/1.jpg');
});

$('#img2').click(function(){
    $('#dialog2_main_picture').attr('src','<?php echo Yii::app()->request->baseUrl;?>/statics/2.png');
});

$('#img3').click(function(){
    $('#dialog2_main_picture').attr('src','<?php echo Yii::app()->request->baseUrl;?>/statics/3.jpg');
});
</script>

</div>
