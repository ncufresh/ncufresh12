

<div id='club-underpicture'>
	<div id="club-picture-menu">
            <button>UP</button>
            <button>DOWN</button>
            <div id="club-menu-items">
                <a class="club-picture1"></a>
                <a class="club-picture2"></a>
                <a class="club-picture3"></a>
				<a class="club-picture4"></a>
            </div>
        </div>
</div>
<div id="club-display">	
	<?php if((integer)$_GET['id']>=1&&(integer)$_GET['id']<=77)
			{?>
				<a href="<?php echo Yii::app()->createUrl('club/club');?>" title="社團">社團</a>
				<?php echo "→".$data->name?>
		   <?}?>
	<?php if((integer)$_GET['id']>77&&(integer)$_GET['id']<=98)
			{?>
				<a href="<?php echo Yii::app()->createUrl('club/department');?>" title="系所">系所</a>
				<?php echo "→".$data->name?>
		   <?}?>
	<h1><?php echo $data->name;?></h1>	
	<div id="club-title">簡介:</div>
	<br/>
	<?php
		echo $data->introduction;		
	?>
	<div id="club-title"><?php if( !$data->category ) : ?>社長<?php else : ?>系代<?php endif; ?></div>
	<?php
		echo $data->leader;
	?>
	<div id="club-title">手機:</div>
	<?php
		echo $data->l_phone;
	?>
	<div id="club-title">E-mail:</div>
	<?php
		echo $data->l_e_mail;
	?>
	<div id="club-title">二進位ID:</div>
	<?php
		echo $data->l_binary_id;
	?>
	<div id="club-title">MSN:</div>
	<?php
		echo $data->l_msn;
	?>
	<div id="club-title"><?php if( !$data->category ) : ?>副社長<?php else : ?>副系代<?php endif; ?></div>
	<?php
		echo $data->viceleader;
	?>
	<div id="club-title">手機:</div>
	<?php
		echo $data->v_phone;
	?>
	<div id="club-title">E-mail:</div>
	<?php
		echo $data->v_e_mail;
	?>
	<div id="club-title">二進位ID:</div>
	<?php
		echo $data->v_binaryid;
	?>
	<div id="club-title">MSN:</div>
	<?php
		echo $data->v_msn;
	?>
	<div id="club-title">社站:</div>
	<?php
		echo $data->club_web;
	?>
</div>