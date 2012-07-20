<div id="all">
	<div id="display">
		
		<h1><?php echo $data->name;?></h1>
		
		<div id="title">簡介:</div>
		<br/>
		<?php
			echo $data->introduction;		
		?>
		<div id="title">社長:</div>
		<?php
			echo $data->leader;
		?>
		<div id="title">手機:</div>
		<?php
			echo $data->l_phone;
		?>
		<div id="title">E-mail:</div>
		<?php
			echo $data->l_e_mail;
		?>
		<div id="title">二進位ID:</div>
		<?php
			echo $data->l_binary_id;
		?>
		<div id="title">MSN:</div>
		<?php
			echo $data->l_msn;
		?>
		<div id="title">副社長:</div>
		<?php
			echo $data->viceleader;
		?>
		<div id="title">手機:</div>
		<?php
			echo $data->v_phone;
		?>
		<div id="title">E-mail:</div>
		<?php
			echo $data->v_e_mail;
		?>
		<div id="title">二進位ID:</div>
		<?php
			echo $data->v_binaryid;
		?>
		<div id="title">MSN:</div>
		<?php
			echo $data->v_msn;
		?>
		<div id="title">社站:</div>
		<?php
			echo $data->club_web;
		?>
	</div>
</div>
	