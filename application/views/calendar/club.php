<div id="calendar-club" club="<?php echo $id;?>"  class="calendar">
    <div class="left"></div>
    <h4 class="date"></h4>
    <div class="right">
    </div>
    <a class="calendar-create-button calendar-buttons" href="<?php echo Yii::app()->createUrl('calendar/createclubevent', array('id'=> $id));?>">新增</a>
    <div class="prompt">
        <ul>
        </ul>
        <i></i>
    </div>
</div>


