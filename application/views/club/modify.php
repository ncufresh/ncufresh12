<form action="<?php echo Yii::app()->createUrl('club/modify',array('id'=>$id))?>" method="post">
<ul>
	<li>簡介:<input name="club[introduction]" style="width:600px;height:300px;" type="text" size="500" value="<?php if ( empty($club['introduction']) ) echo $data->introduction; ?>"/></li>
	<ul><li>社長:<input name="club[leader]" type="text" size="10" value="<?php if ( empty($club['leader']) ) echo $data->leader; ?>"/><li>
        <br/>
		<li>手機:<input name="club[leader_phone]" type="text" size="15" value="<?php if ( empty($club['leader_phone']) ) echo $data->leader_phone; ?>"/></li>
		<br/>
        <li>E-mail:<input name="club[leader_email]" type="text" size="30" value="<?php if ( empty($club['leader_email']) ) echo $data->leader_e_mail; ?>"/></li>
		<br/>
        <li>二進位ID:<input name="club[leader_ID]" type="text" size="15" value="<?php if ( empty($club['leader_ID']) ) echo $data->leader_binary_id; ?>"/></li>
		<br/>
        <li>MSN:<input name="club[leader_msn]" type="text" size="30" value="<?php if ( empty($club['leader_msn']) ) echo $data->leader_msn; ?>"/></li>
	</ul>
	<ul><li>副社長:<input name="club[viceleader]" type="text" size="10" value="<?php if ( empty($club['viceleader']) ) echo $data->viceleader; ?>"/></li>
		<br/>
        <li>手機:<input name="club[viceleader_phone]" type="text" size="15" value="<?php if ( empty($club['viceleader_phone']) ) echo $data->viceleader_phone; ?>"/></li>
		<br/>
        <li>E-mail:<input name="club[viceleader_email]" type="text" size="30" value="<?php if ( empty($club['viceleader_email']) ) echo $data->viceleader_e_mail; ?>"/></li>
		<br/>
        <li>二進位ID:<input name="club[viceleader_ID]" type="text" size="15" value="<?php if ( empty($club['viceleader_ID']) ) echo $data->viceleader_binaryid; ?>"/></li>
		<br/>
        <li>MSN:<input name="club[viceleader_msn]" type="text" size="30" value="<?php if ( empty($club['viceleader_msn']) ) echo $data->viceleader_msn; ?>"/></li>
		<br/>
        <li>社站:<input name="club[web]" type="text" size="100" value="<?php if ( empty($club['web']) ) echo $data->club_web; ?>"/></li>
	</ul>
</ul>
<input type="submit" value="儲存"/>
<input type="submit" value="取消" />
<input type="hidden" name="token" value="<?php echo Yii::app()->security->getToken(); ?>" />
</form>
<form name="picture1" method="post" enctype="multipart/form-data" action="<?php echo Yii::app()->createUrl('club/modify',array('id'=>$id))?>" >
    <h3>上傳圖片1</h3>
    <input type="file" name="picture1"/><input type="submit" value="上傳"/>
    <h3>上傳圖片2</h3>
    <input type="file" name="picture1"/><input type="submit" value="上傳"/>
    <h3>上傳圖片3</h3>
    <input type="file" name="picture1"/><input type="submit" value="上傳"/>
    <h3>上傳圖片4</h3>
    <input type="file" name="picture1"/><input type="submit" value="上傳"/>
    <br/>
</form>

