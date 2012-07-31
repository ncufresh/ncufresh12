<form id="calendar-subscript" name="calendar-subscript" action="<?php echo Yii::app()->createUrl('calendar/subscript'); ?>" method="POST">
<?php
    for($i=0;$i<count($calendar_id);$i++):
        echo $clubs_category[$i].' '.$clubs_name[$i].' '.$calendar_id[$i].' '.$check[$i].'<br/>';
    endfor;
    for($i=0;$i<count($calendar_id);$i++):
?>
    <input type="checkbox" name="calendar[<?php echo $calendar_id[$i]?>]" <?php if($check[$i] == 1) echo 'checked';?> value='1' /><?php echo $clubs_name[$i];?>
<?php
    endfor;
?>
<button type="submit" id="subscript-submit">確定</button>
<input type="hidden" name="token" value="<?php echo Yii::app()->security->getToken(); ?>" />
</form>