<?php $counter_get = 0; $counter_all = 0; ?>
<?php foreach($achievements as $achievement) : ?>
<?php $counter_all++; ?>
<?php if ( $achievement['get'] == true ) : ?>
<?php $counter_get++; ?>
<?php endif ?>
<?php endforeach; ?>
<h4 class="game-title">成就列表 （<?php echo $counter_get; ?> / <?php echo $counter_all; ?>）</h4>
<?php $id_counter = 0; ?>
<?php foreach($achievements as $achievement) : ?>
<?php $id_counter++; ?>
<div class="achievement-icons">
<?php if ( $achievement['get'] == true ) : ?>
    <img src="<?php echo Yii::app()->request->baseUrl ?>/statics/game/icons/achievements/<?php echo $id_counter; ?>.png" alt="<?php $achievement['name'] ?>">
    <div class="item-description">
        <h4>&lt; <?php echo $achievement['name'] ?> &gt;</h4>
        <span class="description"><?php echo $achievement['description'] ?></span>
    </div>
<?php else : ?>
    <img src="<?php echo Yii::app()->request->baseUrl ?>/statics/game/icons/question-mark.png" alt="<?php $achievement['name'] ?>">
    <div class="item-description">
        <h4>&lt; ？？？ &gt;</h4>
        <span class="description">尚未探索，未知的旅程。</span>
    </div>
<?php endif; ?>
</div>
<?php endforeach; ?>
