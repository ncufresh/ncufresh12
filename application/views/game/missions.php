<div id="game-mission">
<h4> 任務列表 ( 進度：<?php echo round(($mission_count/93),4)*100 ?>% )</h4>
<ul>
<?php foreach ( $missions as $mission ) : ?>
    <li>
        <a href="#<?php echo $mission->id; ?>"><?php echo $mission->name; ?> < <?php echo $mission->money; ?> 金幣 / <?php echo $mission->experience; ?> 經驗> </a>
    </li>
<?php endforeach; ?>
<ul>

</div>