<div id="calendar-recycle">
    <h4>回收</h4><a class="back" href="<?php echo Yii::app()->createUrl('calendar/view');?>">返回</a>
    <div class="container">
<?php foreach ( $result as $key => $events ):?>
        <div>
            <h5><?php echo $key;?></h5>
            <ul>
<?php foreach ( $events as $event ) : ?>
                <li>
                    <span><?php echo $event->name; ?></span>
                    <a class="calendar-show-event" href="#<?php echo $event->id; ?>" title="復原事件">復原</a>
<?php if ( $event->calendar->getIsPersonal() && $event->calendar->getIsOwner() ) : ?>
                    <a class="calendar-hide-event" href="#<?php echo $event->id; ?>" title="刪除事件">刪除</a>
<?php endif; ?>
                </li>
<?php endforeach; ?>
            </ul>
        </div>
<?php endforeach; ?>
    </div>
</div>