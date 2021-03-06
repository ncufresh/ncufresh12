<div class="calendar-create">
    <form id="calendar-create-form" enctype="multiprt/form-data" action="<?php echo Yii::app()->createUrl('calendar/createclubevent', array('id'=>$id)); ?>" method="POST">
    <h4 id="calendar-create-text-number-check">新增事件</h4>
    <dl>
        <dt>
            <label id="calendar-create-text-title" for="calendar-create-title">標題</label>
        </dt>
        <dd>
            <input id="calendar-create-title" type="text" name="event[name]" maxLength="20"/>
        </dd>
    </dl>
    <dl class="content">
        <dt>
            <label for="calendar-create-start">起始日</label>
        </dt>
        <dd>
            <input class="datepicker" id="calendar-create-start" type="text" name="event[start]" maxLength="10"/>
        </dd>
    </dl>
    <dl class="content">
        <dt>
            <label for="calendar-create-end">結束日</label>
        </dt>
        <dd>
            <input class="datepicker" id="calendar-create-end" type="text" name="event[end]" maxLength="10"/>
        </dd>
    </dl>
    <dl class="content">
        <dt>
            <label for="form-create-content">內容</label>
        </dt>
        <dd>
            <textarea id="form-create-content" name="event[description]" cols="70" rows="10"></textarea>
        </dd>
    </dl>
    <div class="buttons">
        <button id="calendar-create-submit">發佈</button>
        <button class="calendar-cancel-button" club="<?php echo $id;?>" type="reset">取消</button>
        <input type="hidden" name="token" value="<?php echo Yii::app()->security->getToken(); ?>" />
    </div>
    </form>
</div>
