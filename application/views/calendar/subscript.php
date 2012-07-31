<form id="calendar-subscript" name="calendar-subscript" action="<?php echo Yii::app()->createUrl('calendar/subscript'); ?>" method="POST">
<?php
foreach($clubs as $each):
    echo $each->id.' ';
    echo $each->clubs->name.' ';
    echo $each->subscriptions?'isSubscript':'NULL' .'<br/>';
endforeach;
?>
<?php
foreach($clubs as $each):
?>
    <input type="checkbox" name="subscript[<?php echo $each->id; ?>]" value="1" <?php if( isset($each->subscriptions->invisible) && $each->subscriptions->invisible == 0) echo 'checked'; ?>/> <?php echo $each->clubs->name; ?>
<?php
endforeach;
?>
<button type="submit" id="subscript-submit">確定</button>
<input type="hidden" name="token" value="<?php echo Yii::app()->security->getToken(); ?>" />
</form>