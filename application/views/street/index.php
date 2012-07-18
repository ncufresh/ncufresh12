<?php Yii::app()->clientScript->registerCoreScript('jquery.ui'); ?>

<?php
	// <link type="text/css" rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.21/themes/base/jquery-ui.css" />
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
?>
<style>
#back_div
{
    background-color:black;
    position:relative;
}
#map_picture
{
    height:622;
    width:572;
    margin-left:0;
    z-index:1;
}
#Q13
{
    height:350px;
    width:250px; 
    position:absolute; 
    z-index:2;
    left:0;
}
#dialog_div_1
{
    display:none;
}
#picture_main
{
    float:right;    
    height:200px; 
    width:300px;
    background-color:gray;
}
#dialog1_up_div
{
    overflow:auto;
    background-color:red;
    height:400px;
}
#dialog1_down_div
{
    overflow:auto;
    background-color:green;
    height:250px;
}
#picture_other_1
{
    float:left;
    margin-right:10px;
    height:150px;
    width:250px;
    background-color:gray;
}
#picture_other_2
{    
    float:left;
    height:150px;
    width:250px;
    background-color:gray;
}
#dialog_div_2
{
    display:none;
}
#dialog2_up_back
{
    height:350px;
    width:500px;
    background-color:black;
}
#dialog2_down_back
{
    height:50px;
    width:500px;
    background-color:white;
    position:absolute;
    left:0;
    bottom:0;
}
#dialog2_button_left
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
#dialog2_button_right
{
    position:absolute;
    right:0;
    bottom:0;
}
</style>

<div id="back_div">
    <img src="<?php echo Yii::app()->baseUrl?>/statics/pp.jpg" id="map_picture"><!--底圖-->
    <img src="<?php echo Yii::app()->baseUrl?>/statics/Q13.jpg" id="Q13"><!--girl-->
</div>

<div id="dialog_div_1"><!--第一層-->

    <div id="dialog1_up_div">          
        <p>
        <div id="picture_main">
        正視圖
        </div>  
        <?php
        echo $content;
        ?>
        
        </p>
    </div> 
    
    <div id="dialog1_down_div">
        <div id="picture_other_1">
        其他圖 1
        </div>    
        <div id="picture_other_2">
        其他圖 2
        </div>
        <img src="<?php echo Yii::app()->baseUrl?>/statics/little_man.jpg" style="float:left;">
    </div>
</div>

<div id="dialog_div_2"><!--第二層-->
    <div id="dialog2_up_back"><!--2-1-->
        <img src="<?php echo Yii::app()->baseUrl?>/statics/logo.png" id="dialog2_main_picture">
    </div>

    <div id="dialog2_down_back"><!--2-2-->
        <button id="dialog2_button_left">left</button>

        <div>
            <img id="img1" src="<?php echo Yii::app()->baseUrl?>/statics/1.jpg">
            <img id="img2" src="<?php echo Yii::app()->baseUrl?>/statics/2.png">
            <img id="img3" src="<?php echo Yii::app()->baseUrl?>/statics/3.jpg">
        </div>

        <button id="dialog2_button_right">right</button>
    </div>

</div>


<script type="text/javascript">
/////////////////////////////////////////dialog
var dialog_div_1 = $("#dialog_div_1");
dialog_div_1.dialog({
    width: 999,
    height: 700,
    modal: true,
    draggable: false, 
    buttons:{"I'm a button":function(){
    $('div#dialog_div_2').dialog('open');		
    }},
}); 
dialog_div_1.dialog('close');//dialog_1 瞬間出現再結束
$('div.ui-dialog-buttonpane').css("background", "yellow");// 第一層底下區域
//---------------------------------------------------------------------------------------------
var dialog_div_2=$('div#dialog_div_2');
    dialog_div_2.dialog({ 
	width:500,
	height:400,
	modal:true,
	draggable:false,
});

$('div#dialog_div_2').css({
background:'yellow',
});

dialog_div_2.dialog('close');//dialog_2 瞬間出現再結束 	  
//----------------------------------------------------------------------------------------------  
 
</script>


 <script>
 //////////////////////////////picture
$('#Q13').mouseenter(function(){
    $('#Q13').attr("src","<?php echo Yii::app()->baseUrl?>/statics/chat.png");
});

$('#Q13').mouseleave(function(){
    $('#Q13').attr("src","<?php echo Yii::app()->baseUrl?>/statics/Q13.jpg" );
});

$('#Q13').click(function(){//打開第一層
    dialog_div_1.dialog('open');
	
    $('div#dialog_div_1').css({
        background:'white' 
    });
    $('span.ui-icon').text('關閉');//關閉鈕
    $('.ui-dialog-titlebar-close').css({
        right: 0,
        position: 'absolute',
        background:'gray'
    });

});
 <?php
// $(document).ready(function() {
    // $(#test).hoverpulse({
        // size: 40,  // 圖片縮放的大小
        // speed: 400 // 圖片變換大小的速度 
    // });
// });

//$("#Q13").src();
?>

$('#dialog2_button_left').click(function() {$('#img1').animate({left:"0px"});});
$('#dialog2_button_right').click(function() {$('#img1').animate({left:"80px"});});

$('#img1').click(function(){
    $('#dialog2_main_picture').attr("src","<?php echo Yii::app()->request->baseUrl;?>/statics/1.jpg");
});

$('#img2').click(function(){
    $('#dialog2_main_picture').attr("src","<?php echo Yii::app()->request->baseUrl;?>/statics/2.png");
});

$('#img3').click(function(){
    $('#dialog2_main_picture').attr("src","<?php echo Yii::app()->request->baseUrl;?>/statics/3.jpg");
});
</script>

</div>
