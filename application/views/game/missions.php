<h1> 任務列表 </h1>
<h1> 任務進度：<?php echo ($mission_count/93)*100 ?>% ( <?php echo $mission_count ?> / 91)</h1>
<?php foreach ( $missions as $mission ) : ?>
<h3> <?php echo $mission->name ?> </h3>
<span> <?php echo $mission->content ?> </span>
<?php endforeach; ?>