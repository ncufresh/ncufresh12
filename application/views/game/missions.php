<div id="game-mission">
<h4 class="game-title">任務列表 ( 進度：<?php echo round(($mission_count/113),4)*100 ?>% )</h4>
<ul>
<?php foreach ( $missions as $mission ) : ?>
    <li>
        <a href="#<?php echo $mission->id; ?>"><?php echo $mission->name; ?></a>
        <div class="mission-description">
            <h4>&lt; 任務：<?php echo $mission->name ?> &gt;</h4>
            <span class="description">完成將獲得：</span>
            <span class="description">[ <?php echo $mission->experience ?> 經驗 / <?php echo $mission->money ?> 金幣 ]</span>
            <span class="more">[ 再次解任務之經驗值與金幣獲取量將大幅降低 ]</span>
            <span class="more">[ 亦可於論壇發表、回復文章獲取經驗值與金幣 ]</span>
        </div>
    </li>
<?php endforeach; ?>
<ul>

</div>

<audio id="game-mission-correct">
    <source type="audio/ogg" src="<?php echo Yii::app()->request->baseUrl; ?>/statics/correct.ogg">
    <source type="audio/mp3" src="<?php echo Yii::app()->request->baseUrl; ?>/statics/correct.mp3">
    <source type="audio/wav" src="<?php echo Yii::app()->request->baseUrl; ?>/statics/correct.mp3">
</audio>

<audio id="game-mission-wrong">
    <source type="audio/ogg" src="<?php echo Yii::app()->request->baseUrl; ?>/statics/wrong.ogg">
    <source type="audio/mp3" src="<?php echo Yii::app()->request->baseUrl; ?>/statics/wrong.mp3">
    <source type="audio/wav" src="<?php echo Yii::app()->request->baseUrl; ?>/statics/wrong.mp3">
</audio>