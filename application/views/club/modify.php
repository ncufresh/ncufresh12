<form action="<?php echo Yii::app()->createUrl('club/modify',array('id'=>$id))?>" method="post">
<table>
    <tr>
	<td>
    簡介:
    </td>
    <td>
    <textarea name="club[introduction]" style="width:300px;height:200px;" type="text" size="500">
    <?php if ( empty($club['introduction']) ) echo nl2br($data->introduction); ?>
    </textarea>
    </td>
    </tr>
    <tr>
	<td>社長:
    </td>
    <td>
    <input name="club[leader]" type="text" size="10" value="<?php if ( empty($club['leader']) ) echo $data->leader; ?>"/>
    </td>
    </tr>
    <tr>
    <td>手機:
    </td>
    <td>
    <input name="club[leader_phone]" type="text" size="15" value="<?php if ( empty($club['leader_phone']) ) echo $data->leader_phone; ?>"/>
	</td>
    </tr>
    <tr>
    <td>E-mail:
    </td>
    <td>
    <input name="club[leader_email]" type="text" size="30" value="<?php if ( empty($club['leader_email']) ) echo $data->leader_e_mail; ?>"/>
    </td>
    </tr>
    <tr>
    <td>二進位ID:
    </td>
    <td>
    <input name="club[leader_ID]" type="text" size="15" value="<?php if ( empty($club['leader_ID']) ) echo $data->leader_binary_id; ?>"/>
    </td>
    </tr>
    <tr>
    <td>MSN:
    </td>
    <td>
    <input name="club[leader_msn]" type="text" size="30" value="<?php if ( empty($club['leader_msn']) ) echo $data->leader_msn; ?>"/>
    </td>
    </tr>
    <tr>
    <td>副社長:
    </td>
    <td>
    <input name="club[viceleader]" type="text" size="10" value="<?php if ( empty($club['viceleader']) ) echo $data->viceleader; ?>"/>
    </td>
    </tr>
    <tr>
    <td>手機:
    </td>
    <td>
    <input name="club[viceleader_phone]" type="text" size="15" value="<?php if ( empty($club['viceleader_phone']) ) echo $data->viceleader_phone; ?>"/>
    </td>
    </tr>
    <tr>
    <td>E-mail:
    </td>
    <td>
    <input name="club[viceleader_email]" type="text" size="30" value="<?php if ( empty($club['viceleader_email']) ) echo $data->viceleader_e_mail; ?>"/>
    </td>
    </tr>
    <tr>
    <td>二進位ID:
    </td>
    <td>
    <input name="club[viceleader_ID]" type="text" size="15" value="<?php if ( empty($club['viceleader_ID']) ) echo $data->viceleader_binaryid; ?>"/>
    </td>
    </tr>
    <tr>
    <td>MSN:
    </td>
    <td>
    <input name="club[viceleader_msn]" type="text" size="30" value="<?php if ( empty($club['viceleader_msn']) ) echo $data->viceleader_msn; ?>"/>
    </td>
    </tr>
    <tr>
    <td>社站:
    </td>
    <td>
    <input name="club[web]" type="text" size="100" value="<?php if ( empty($club['web']) ) echo $data->club_web; ?>"/>
    </td>
    </tr>
    <input type="hidden" name="token" value="<?php echo Yii::app()->security->getToken(); ?>" />
    <tr>
    <td>
    </td>
    <td style="text-align:right">
    <button name="save" type="submit" >儲存</button>
    <button name="cancel" type="submit" >取消</button>
    </td>
    </tr>
</table>
</form>