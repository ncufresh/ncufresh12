
<h4 class="game-title"><?php echo $nickname; ?></h4>

<div class="experience">
<?php if ( $level < 20 ) : ?>
    <span class="text">LV. <?php echo $level; ?> [ <?php echo $exp; ?> / <?php echo $level_exp; ?> ]</span>
    <span class="bar" style="width:<?php echo 100 * $exp / $level_exp; ?>%;"></span>
<?php else : ?>
    <span class="text">LV. <?php echo $level; ?> [ <?php echo $exp; ?> / ∞ ]</span>
    <span class="bar max" style="width:100%;"></span>
<?php endif; ?>
</div>

<?php if ( $character_data->hairs === null ) : ?>
<div class="first-row-items">
<img src="<?php echo Yii::app()->request->baseUrl; ?>/statics/game/icons/question-mark.png" alt="尚未裝備">
    <div class="item-description">
        <h4>&lt; 省電高亮度燈泡 &gt;</h4>
        <span class="description">相傳只要拔到蝨子的鬃毛就可以毛髮叢生；拔到獅子的鬃毛就可以成為高單位亮度的燈泡</span>
        <span>[ 尚未裝備物品 ]</span>
    </div>
</div>
<?php else : ?>
<div class="first-row-items">
<img src="<?php echo Yii::app()->request->baseUrl; ?>/statics/game/icons/hairs/<?php echo $character_data->hairs->filename; ?>.png" alt="<?php $character_data->hairs->name; ?>">
    <div class="item-description">
        <h4>&lt; <?php echo $character_data->hairs->name; ?> &gt;</h4>
        <span class="description"><?php echo $character_data->hairs->description; ?></span>
        <span>[ 需求等級：LV.<?php echo $character_data->hairs->level; ?> / 價值：<?php echo $character_data->hairs->price; ?> 金幣 ]</span>
    </div>
</div>
<?php endif; ?>

<?php if ( $character_data->eyes === null ) : ?>
<div class="first-row-items">
<img src="<?php echo Yii::app()->request->baseUrl; ?>/statics/game/icons/question-mark.png" alt="尚未裝備">
    <div class="item-description">
        <h4>&lt; 你是我的眼 &gt;</h4>
        <span class="description">你是我的眼，帶我領略四季的變化。快給我一雙眼吧，我想要自己看啊！</span>
        <span>[ 尚未裝備物品 ]</span>
    </div>
</div>
<?php else : ?>
<div class="first-row-items">
<img src="<?php echo Yii::app()->request->baseUrl; ?>/statics/game/icons/eyes/<?php echo $character_data->eyes->filename; ?>.png" alt="<?php $character_data->eyes->name; ?>">
    <div class="item-description">
        <h4>&lt; <?php echo $character_data->eyes->name; ?> &gt;</h4>
        <span class="description"><?php echo $character_data->eyes->description; ?></span>
        <span>[ 需求等級：LV.<?php echo $character_data->eyes->level; ?> / 價值：<?php echo $character_data->eyes->price; ?> 金幣 ]</span>
    </div>
</div>
<?php endif; ?>

<?php if ( $character_data->clothes === null ) : ?>
<div class="first-row-items">
<img src="<?php echo Yii::app()->request->baseUrl; ?>/statics/game/icons/question-mark.png" alt="尚未裝備">
    <div class="item-description">
        <h4>&lt; 一桶江山‧油 &gt;</h4>
        <span class="description">八塊腹肌有什麼了不起？</span>
        <span class="description">我可是一桶江山，一桶油的王者。要比團結，你的軍隊一定比我分裂</span>
        <span>[ 尚未裝備物品 ]</span>
    </div>
</div>
<?php else : ?>
<div class="first-row-items">
<img src="<?php echo Yii::app()->request->baseUrl; ?>/statics/game/icons/clothes/<?php echo $character_data->clothes->filename; ?>.png" alt="<?php $character_data->clothes->name; ?>">
    <div class="item-description">
        <h4>&lt; <?php echo $character_data->clothes->name; ?> &gt;</h4>
        <span class="description"><?php echo $character_data->clothes->description; ?></span>
        <span>[ 需求等級：LV.<?php echo $character_data->clothes->level; ?> / 價值：<?php echo $character_data->clothes->price; ?> 金幣 ]</span>
    </div>
</div>
<?php endif; ?>

<?php if ( $character_data->pants === null ) : ?>
<div class="first-row-items">
<img src="<?php echo Yii::app()->request->baseUrl; ?>/statics/game/icons/question-mark.png" alt="尚未裝備">
    <div class="item-description">
        <h4>&lt; 十一號公車看光光 &gt;</h4>
        <span class="description">到底是誰家的十一號公車？</span>
        <span class="description">竟然就這樣開到了公開場合，也太害羞了吧！</span>
        <span>[ 尚未裝備物品 ]</span>
    </div>
</div>
<?php else : ?>
<div class="first-row-items">
<img src="<?php echo Yii::app()->request->baseUrl; ?>/statics/game/icons/pants/<?php echo $character_data->pants->filename; ?>.png" alt="<?php $character_data->pants->name; ?>">
    <div class="item-description">
        <h4>&lt; <?php echo $character_data->pants->name; ?> &gt;</h4>
        <span class="description"><?php echo $character_data->pants->description; ?></span>
        <span>[ 需求等級：LV.<?php echo $character_data->pants->level; ?> / 價值：<?php echo $character_data->pants->price; ?> 金幣 ]</span>
    </div>
</div>
<?php endif; ?>

<?php if ( $character_data->shoes === null ) : ?>
<div class="second-row-items the-first-item">
<img src="<?php echo Yii::app()->request->baseUrl; ?>/statics/game/icons/question-mark.png" alt="尚未裝備">
    <div class="item-description">
        <h4>&lt; 步步驚心踩到釘 &gt;</h4>
        <span class="description">腳踏實地，一步一腳印才是做人的根本到理。但是一不小心，可是會變成讓人驚心的一步一鐵釘啊！</span>
        <span>[ 尚未裝備物品 ]</span>
    </div>
</div>
<?php else : ?>
<div class="second-row-items the-first-item">
<img src="<?php echo Yii::app()->request->baseUrl; ?>/statics/game/icons/shoes/<?php echo $character_data->shoes->filename; ?>.png" alt="<?php $character_data->shoes->name; ?>">
    <div class="item-description">
        <h4>&lt; <?php echo $character_data->shoes->name; ?> &gt;</h4>
        <span class="description"><?php echo $character_data->shoes->description; ?></span>
        <span>[ 需求等級：LV.<?php echo $character_data->shoes->level; ?> / 價值：<?php echo $character_data->shoes->price; ?> 金幣 ]</span>
    </div>
</div>
<?php endif; ?>

<?php if ( $character_data->skins === null ) : ?>
<div class="second-row-items">
<img src="<?php echo Yii::app()->request->baseUrl; ?>/statics/game/icons/question-mark.png" alt="尚未裝備">
    <div class="item-description">
        <h4>&lt; 無皮膚 &gt;</h4>
        <span class="description">這是錯誤的代表，請重新申請一個帳號吧！</span>
        <span>[ 資料庫嚴重錯誤 ]</span>
    </div>
</div>
<?php else : ?>
<div class="second-row-items">
<img src="<?php echo Yii::app()->request->baseUrl; ?>/statics/game/icons/skins/<?php echo $character_data->skins->filename; ?>.png" alt="<?php $character_data->skins->name; ?>">
    <div class="item-description">
        <h4>&lt; <?php echo $character_data->skins->name; ?> &gt;</h4>
        <span class="description"><?php echo $character_data->skins->description; ?></span>
        <span>[ 需求等級：LV.<?php echo $character_data->skins->level; ?> / 價值：<?php echo $character_data->skins->price; ?> 金幣 ]</span>
    </div>
</div>
<?php endif; ?>

<?php if ( $character_data->others === null ) : ?>
<div class="second-row-items">
<img src="<?php echo Yii::app()->request->baseUrl; ?>/statics/game/icons/question-mark.png" alt="尚未裝備">
    <div class="item-description">
        <h4>&lt; 至尊‧手無縛雞之力 &gt;</h4>
        <span class="description">雙手萬能，沒有錢卻萬萬不能！</span>
        <span class="description">所以最強的力量莫過於兩隻手抓起八隻雞的驚人之力了！</span>
        <span>[ 尚未裝備物品 ]</span>
    </div>
</div>
<?php else : ?>
<div class="second-row-items">
<img src="<?php echo Yii::app()->request->baseUrl; ?>/statics/game/icons/others/<?php echo $character_data->others->filename; ?>.png" alt="<?php $character_data->others->name; ?>">
    <div class="item-description">
        <h4>&lt; <?php echo $character_data->others->name; ?> &gt;</h4>
        <span class="description"><?php echo $character_data->others->description; ?></span>
        <span>[ 需求等級：LV.<?php echo $character_data->others->level; ?> / 價值：<?php echo $character_data->others->price; ?> 金幣 ]</span>
    </div>
</div>
<?php endif; ?>
<span class="index-data">等級：LV.<?php echo $level; ?></span>
<?php if ( $level < 20 ) : ?>
    <span class="index-data">經驗值：<?php echo $exp; ?> / <?php echo $level_exp; ?></span>
<?php else : ?>
    <span class="index-data">經驗值：<?php echo $exp; ?> / ∞</span>
<?php endif; ?>

<?php Yii::import('application.models.Forum.*'); ?>
<span class="index-data">剩餘：<?php echo $money; ?> 金幣</span>
<span class="index-data">總獲得：<?php echo $character_data->total_money; ?> 金幣</span>
<span class="index-data">總花費：<?php echo $character_data->total_money-$money; ?> 金幣</span>
<span class="index-data">總登入：<?php echo $online_count; ?> 次</span>
<span class="index-data">好友數：<?php echo Friend::model()->getAmount($watch_id); ?> 人</span>
<span class="index-data">文章數：<?php echo Article::model()->getArticlesNumOfUser($watch_id); ?> 篇</span>
<span class="index-data">回覆數：<?php echo Reply::model()->getRepliesNumOfUser($watch_id); ?> 則</span>
<span class="index-data">道具數：<?php echo ItemBag::model()->getClothesNum($watch_id); ?> 個</span>
<span class="index-data">目前身價：<?php echo $character_data->getBodyPrice($watch_id); ?> 金幣</span>


