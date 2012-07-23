<form action="<?php echo Yii::app()->createUrl('club/content')?>" method="post">
<ul>
	<li>簡介:<input name="introduce" type="text" size="500"/></li>
	<ul><li>社長:<input name="leader" type="text" size="10"/><li>
		<li>手機:<input name="l_phone" type="text" size="15"/></li>
		<li>E-mail:<input name="l_email" type="text" size="30"/></li>
		<li>二進位ID:<input name="l_ID" type="text" size="15"/></li>
		<li>MSN:<input name="l_msn" type="text" size="30"/></li>
	</ul>
	<ul><li>副社長:<input name="vice_leader" type="text" size="10"/></li>
		<li>手機:<input name="v_phone" type="text" size="15"/></li>
		<li>E-mail:<input name="v_email" type="text" size="30"/></li>
		<li>二進位ID:<input name="v_ID" type="text" size="15"/></li>
		<li>MSN:<input name="v_msn" type="text" size="30"/></li>
		<li>社站:<input name="web" type="text" size="100"/></li>
	</ul>
</ul>
<input type="submit" value="儲存"/>
<input class="cancel" type="button" value="取消" />
<input type="hidden" name="token" value="<?php echo Yii::app()->security->getToken(); ?>" />
</form>