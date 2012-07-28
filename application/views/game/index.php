
<h2> <<?php echo $nickname; ?> - <?php echo $username ?>></h2>
<a> 目前等級：LV.<?php echo $level;?> [ <?php echo $exp;?> / <?php if($level<20) echo $level_exp.' (下一等級)'; else echo '∞ (最高等級)';?> ]</a>
<a>