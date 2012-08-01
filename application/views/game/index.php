
<h4> <<?php echo $nickname; ?> - <?php echo $username; ?>></h4>

<div class="experience">
<?php if ( $level < 20 ) : ?>
    <span class="text">LV. <?php echo $level; ?> [ <?php echo $exp; ?> / <?php echo $level_exp; ?> ]</span>
    <span class="bar" style="width:<?php echo 100 * $exp / $level_exp; ?>%;"></span>
<?php else : ?>
    <span class="text">LV. <?php echo $level; ?></span>
    <span class="bar max" style="width:100%;"></span>
<?php endif; ?>
</div>

<span>金錢：<?php echo $money; ?> 金幣 [ <?php echo $character_data->total_money; ?> (總獲得) ]</span>
<span>身價：<?php echo $character_data->getBodyPrice($watch_id); ?> 金幣
<span>登入：<?php echo $online_count; ?> 次</span>

<?php if ( $character_data->hair === null ) : ?>
<span>頭髮：光頭俠 [ 尚未裝備 ]</span>
<?php else : ?>
<span>頭髮：<?php echo $character_data->hair->name; ?> [ LV.<?php echo $character_data->hair->level; ?> / <?php echo $character_data->hair->price; ?> 金幣 ]</span>
<?php endif; ?>

<?php if ( $character_data->eyes === null ) : ?>
<span>臉部：無臉怪 [ 尚未裝備 ]</span>
<?php else : ?>
<span>臉部：<?php echo $character_data->eyes->name; ?> [ LV.<?php echo $character_data->eyes->level; ?> / <?php echo $character_data->eyes->price; ?> 金幣 ]</span>
<?php endif; ?>

<?php if ( $character_data->clothes === null ) : ?>
<span>衣服：打赤膊 [ 尚未裝備 ]</span>
<?php else : ?>
<span>衣服：<?php echo $character_data->clothes->name; ?> [ LV.<?php echo $character_data->clothes->level; ?> / <?php echo $character_data->clothes->price; ?> 金幣 ]</span>
<?php endif; ?>

<?php if ( $character_data->pants === null ) : ?>
<span>褲子：好害羞 [ 尚未裝備 ]</span>
<?php else : ?>
<span>褲子：<?php echo $character_data->pants->name; ?> [ LV.<?php echo $character_data->pants->level; ?> / <?php echo $character_data->pants->price; ?> 金幣 ]</span>
<?php endif; ?>

<?php if ( $character_data->shoes === null ) : ?>
<span>鞋子：赤腳中 [ 尚未裝備 ]</span>
<?php else : ?>
<span>鞋子：<?php echo $character_data->shoes->name; ?> [ LV.<?php echo $character_data->shoes->level; ?> / <?php echo $character_data->shoes->price; ?> 金幣 ]</span>
<?php endif; ?>

<?php if ( $character_data->skin === null ) : ?>
<span>皮膚：隱形人(錯誤~!!!)</span>
<?php else : ?>
<span>皮膚：<?php echo $character_data->skin->name; ?> [ LV.<?php echo $character_data->skin->level; ?> / 價值 <?php echo $character_data->skin->price; ?> 金幣 ]</span>
<?php endif; ?>

<?php if ( $character_data->others === null ) : ?>
<span>其他：三腳貓 [ 尚未裝備 ]</span>
<?php else : ?>
<span>其他：<?php echo $character_data->others->name; ?> [ LV.<?php echo $character_data->others->level; ?> / <?php echo $character_data->others->price; ?> 金幣 ]</span>
<?php endif ?>