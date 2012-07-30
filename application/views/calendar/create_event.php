<form id="calendar-create-form" enctype="multiprt/form-data" action="<?php echo Yii::app()->createUrl('calendar/create'); ?>" method="POST">
<div class="form-top">
    <p id="calendar-create-text-number-check">�s�W�ƥ�</p>
    <dl>
        <dt>
            <label id="calendar-create-text-title" for="calendar-create-title">���D</label>
        </dt>
        <dd>
            <input id="calendar-create-title" type="text" name="event[title]" maxLength="20"/>
        </dd>
    </dl>
</div>
<div class="form-body">
    <dl class="content">
        <dt>
            <label for="form-create-content">���e</label>
        </dt>
        <dd>
            <textarea id="form-create-content" name="event[content]" cols="70" rows="10"></textarea>
        </dd>
    </dl>
</div>
<div class="form-foot">
    <input type="hidden" name="event[fid]" value="<?php echo $fid; ?>" />
    <button id="calendar-create-submit" disabled>�o�G</button>
    <button class="calendar-cancel-button" type="reset">����</button>
</div>
<input type="hidden" name="token" value="<?php echo Yii::app()->security->getToken(); ?>" />
</form>