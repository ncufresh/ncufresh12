系所列表<br />
<?php
	// $a = $list[0];
	// echo $a->name;
	foreach($list as $each){
		echo CHtml::link($each->name, $each->url).'<br />';
	}
	
?>