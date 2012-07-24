<form action="<?php echo Yii::app()->createUrl('club/modify',array('id'=>$id))?>" method="post">
<ul>
	<li>
    <h4>簡介:  </h4>
    <textarea name="club[introduction]" style="width:600px;height:300px;" type="text" size="500">
    <?php if ( empty($club['introduction']) ) echo $data->introduction; ?>
    </textarea>
    </li>
    <br/>
	<li>社長:  <input name="club[leader]" type="text" size="10" value="<?php if ( empty($club['leader']) ) echo $data->leader; ?>"/>
    </li>
    <br/>
    <li>手機:  <input name="club[leader_phone]" type="text" size="15" value="<?php if ( empty($club['leader_phone']) ) echo $data->leader_phone; ?>"/>
	</li>
    <br/>
    <li>E-mail:  <input name="club[leader_email]" type="text" size="30" value="<?php if ( empty($club['leader_email']) ) echo $data->leader_e_mail; ?>"/>
    </li>
    <br/>
    <li>二進位ID:  <input name="club[leader_ID]" type="text" size="15" value="<?php if ( empty($club['leader_ID']) ) echo $data->leader_binary_id; ?>"/>
    </li>
    <br/>
    <li>MSN:  <input name="club[leader_msn]" type="text" size="30" value="<?php if ( empty($club['leader_msn']) ) echo $data->leader_msn; ?>"/>
    </li>
    <br/>
    <li>副社長:  <input name="club[viceleader]" type="text" size="10" value="<?php if ( empty($club['viceleader']) ) echo $data->viceleader; ?>"/>
    </li>
    <br/>
    <li>手機:  <input name="club[viceleader_phone]" type="text" size="15" value="<?php if ( empty($club['viceleader_phone']) ) echo $data->viceleader_phone; ?>"/>
    </li>
    <br/>
    <li>E-mail:  <input name="club[viceleader_email]" type="text" size="30" value="<?php if ( empty($club['viceleader_email']) ) echo $data->viceleader_e_mail; ?>"/>
    </li>
    <br/>
    <li>二進位ID:  <input name="club[viceleader_ID]" type="text" size="15" value="<?php if ( empty($club['viceleader_ID']) ) echo $data->viceleader_binaryid; ?>"/>
    </li>
    <br/>
    <li>MSN:  <input name="club[viceleader_msn]" type="text" size="30" value="<?php if ( empty($club['viceleader_msn']) ) echo $data->viceleader_msn; ?>"/>
    </li>
    <br/>
    <li>社站:  <input name="club[web]" type="text" size="100" value="<?php if ( empty($club['web']) ) echo $data->club_web; ?>"/>
    </li>
</ul>
<div>
    <button name="save" type="submit" >儲存</button>
    <button name="cancel" type="submit" >取消</button>
</div>
<input type="hidden" name="token" value="<?php echo Yii::app()->security->getToken(); ?>" />
</form>

