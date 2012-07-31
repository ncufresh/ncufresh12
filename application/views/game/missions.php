<div id="game-mission">
<h1> 任務列表 </h1>
<h3> 任務進度：<?php echo ($mission_count/93)*100 ?>% ( <?php echo $mission_count ?> / 91)</h3>
<ul>
<?php foreach ( $missions as $mission ) : ?>
    <li>
        <a href="#<?php echo $mission->id; ?>"><?php echo $mission->name; ?></a>
        <span> <?php echo $mission->content; ?></span>
    </li>
<?php endforeach; ?>
<ul>

</div>