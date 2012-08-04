<div id="personal-calendar" class="calendar">
    <div class="left"></div>
    <h4 class="date"></h4>
    <div class="right">
    </div>
    <a class="calendar-subscript-button calendar-buttons" href="<?php echo Yii::app()->createUrl('calendar/subscript');?>" title="訂閱行事曆">訂閱</a>
    <a class="calendar-hide-button calendar-buttons" href="<?php echo Yii::app()->createUrl('calendar/recycle');?>" title="回收桶">回收</a>
    <a class="calendar-create-button calendar-buttons" href="<?php echo Yii::app()->createUrl('calendar/createevent');?>" title="新增一筆行程">新增</a>
    <div class="prompt">
        <ul>
        </ul>
        <i></i>
    </div>
</div>

