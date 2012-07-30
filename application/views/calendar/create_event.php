<form id="calendar-create-form" enctype="multiprt/form-data" action="<?php echo Yii::app()->createUrl('calendar/createevent'); ?>" method="POST">
<div class="form-top">
    <p id="calendar-create-text-number-check">新增事件</p>
    <dl>
        <dt>
            <label id="calendar-create-text-title" for="calendar-create-title">標題</label>
        </dt>
        <dd>
            <input id="calendar-create-title" type="text" name="event[name]" maxLength="20"/>
        </dd>
    </dl>
</div>
<div class="form-body">
    <dl class="content">
        <dt>
            <label for="form-create-content">內容</label>
        </dt>
        <dd>
            <textarea id="form-create-content" name="event[description]" cols="70" rows="10"></textarea>
        </dd>
    </dl>
</div>
<div class="form-foot">
    <button id="calendar-create-submit">發佈</button>
    <button class="calendar-cancel-button" type="reset">取消</button>
</div>
<input type="hidden" name="token" value="<?php echo Yii::app()->security->getToken(); ?>" />
</form>