<?php Yii::app()->clientScript->registerCoreScript('jquery.ui'); ?>

<?php
	// <link type="text/css" rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.21/themes/base/jquery-ui.css" />
?>

<div style="background-color:black;position:relative" >

<img src="<?php echo Yii::app()->baseUrl?>/statics/pp.jpg" id="pp" style="height:622;width:572;margin-left:0;z-index:1;"><!--底圖-->

<img src="<?php echo Yii::app()->baseUrl?>/statics/Q13.jpg" id="Q13" style="height:350px;width:250px; position:absolute; z-index:2;left:0;"><!--girl-->

<button id="test"style="z-index:2;position:absolute;left:0;">test</button>

</div>



<div id="dialog_div_1" style="display:none;"><!--第一層-->
</div>

<div id="dialog_div_2" style="display:none;"><!--第二層-->
</div>




<script type="text/javascript">
$('#Q13').mouseenter(function(){
<?php  
  // class="ui-dialog-buttonpane ui-widget-content ui-helper-clearfix"
  ?>
});
var dialog_div_1 = $("#dialog_div_1");
  dialog_div_1.dialog({
	width: 800,
	height: 600,
	modal: true,
	draggable: false,
	buttons:{"I'm a button":function(){
			
		$('div#dialog_div_2').dialog('open');		
	}},
  }); 
  
  dialog_div_1.dialog('close');//dialog_1 瞬間出現再結束
  $('div.ui-dialog-buttonpane').css("background", "white");// 第一層底下
//---------------------------------------------------------------------------------------------
var dialog_div_2=$('div#dialog_div_2');
  dialog_div_2.dialog({ 
	 width:400,
	 height:300,
	 modal:true,
	 draggable:false,
});
$('div#dialog_div_2').css({
background:'yellow',
});
  dialog_div_2.dialog('close');//dialog_2 瞬間出現再結束 	  
//----------------------------------------------------------------------------------------------  
 $('#test').click(function(){ 
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

</script>


 <script>
 <?php
// $(document).ready(function() {
    // $(#test).hoverpulse({
        // size: 40,  // 圖片縮放的大小
        // speed: 400 // 圖片變換大小的速度 
    // });
// });
?>
function ChangeImage()
{
$("#")
}
</script>

</div>