
<h2> <<?php echo $nickname; ?> - <?php echo $username ?>></h2>
<span> 等級：LV.<?php echo $level;?> [ <?php echo $exp;?> / <?php if($level<20) echo $level_exp.' (下一等級)'; else echo '∞ (最高等級)';?> ]</br></span>
<span> 金錢：<?php echo $money; ?>金幣 </br></span>

<span> 褲子：<?php if($character_data->pants==null){ echo '尚未裝備';} else { echo $character_data->pants->name;?> [ LV.<?php echo $character_data->skin->level; ?> / <?php echo $character_data->skin->price.'金幣 ] '; }?></br></span>
<span> 鞋子：<?php if($character_data->shoes==null){ echo '尚未裝備';} else { echo $character_data->shoes->name;?> [ LV.<?php echo $character_data->skin->level; ?> / <?php echo $character_data->skin->price.'金幣 ] '; }?></br></span>
<span> 皮膚：<?php if($character_data->skin==null){ echo '尚未裝備';} else { echo $character_data->skin->name;?> [ LV.<?php echo $character_data->skin->level; ?> / <?php echo $character_data->skin->price.'金幣 ] '; }?></br></span>
<span> 其他：<?php if($character_data->others==null){ ?>尚未裝備<?php ;} else { echo $character_data->others->name;?> [ LV.<?php echo $character_data->skin->level; ?> / <?php echo $character_data->skin->price.'金幣 ] '; }?></br></span>