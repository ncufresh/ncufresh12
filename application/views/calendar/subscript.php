<div id="calendar-subscript">
    <h4>訂閱</h4>
    <div class="category-wrapper">
<?php foreach($result as $key => $clubs): ?>
        <a class="category-button" href="#<?php echo $key?>"><?php echo Club::getCategoryName($key); ?></a>
<?php endforeach; ?>
    </div>
    <form name="calendar-subscript" action="<?php echo Yii::app()->createUrl('calendar/subscript'); ?>" method="POST">
        <div class="calendar-subscript-container">
<?php foreach($result as $key => $clubs): ?>
            <div id="calendar-subscript-category-<?php echo $key?>" class="calendar-subscript-category" style="width: auto;">
<?php foreach($clubs as $club): ?>
            <dl>
                <dt><label for="form-subscript-<?php echo $club->club->id; ?>"><?php echo $club->club->name; ?></label></dt>
                <dd>
                    <input id="form-subscript-<?php echo $club->club->id; ?>" type="checkbox" name="subscript[<?php echo $club->id; ?>]" value="1" <?php if( isset($club->subscriptions->invisible) && $club->subscriptions->invisible == 0) echo 'checked'; ?>/> 
                </dd>
            </dl>
<?php endforeach; ?>
            </div>
<?php endforeach; ?>
        </div>
        <button type="submit" id="subscript-submit">確定</button>
        <input type="hidden" name="token" value="<?php echo Yii::app()->security->getToken(); ?>" />
    </form>
</div>