<script type="text/javascript">
jQuery(document).ready(function()
{
    setInterval(function()
    {
        jQuery('.life-picture').fadeOut(500).eq(jQuery.random(0, $('.life-picture').length - 1)).fadeIn(500);
    }, 1000);
});
</script>
<div id="life-container">
<div id="life-head">
-------------這裡是中大生活唷-----------
</div>

<div id="life-body">
    <div id="linkk">  
         <a id="ncu-food" href="<?php echo Yii::app()->createUrl('nculife/food'); ?>" title="food">food</a>
         <a id="ncu-health" href="<?php echo Yii::app()->createUrl('nculife/health');?>" title="health">health</a>
         <a id="ncu-car" href="<?php echo Yii::app()->createUrl('nculife/car'); ?>" title="car">car</a>
         <a id="ncu-sport" href="<?php echo Yii::app()->createUrl('nculife/sport');?>" title="sport">sport</a>
         <a id="ncu-outside" href="<?php echo Yii::app()->createUrl('nculife/outside'); ?>" title="outside">outside</a>
         <a id="ncu-house" href="<?php echo Yii::app()->createUrl('nculife/house');?>" title="house">house</a>
         <a id="ncu-live" href="<?php echo Yii::app()->createUrl('nculife/live'); ?>" title="live">live</a>
         <a id="life-test1" class="life-picture"></a>
         <a id="life-test2" class="life-picture"></a>
         <a id="life-test3" class="life-picture"></a>
    </div>
</div>

<div id="life-bottom">
</div>
</div>
