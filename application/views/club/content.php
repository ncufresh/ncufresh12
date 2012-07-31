<?php $this->beginWidget('system.web.widgets.CClipWidget', array('id' => 'script')); ?>
<?php $this->endWidget();?>
<div class="club-underpicture">
    <div class="schedule">
        <div id="club-schedule-button">
        
        </div>
        <div id="club-schedule-content">
        
        </div>
    </div>
        <ul id="club-menu-items">
            <li class="club-picture">
<?php if( file_exists( Yii::app()->basePath . '/../files/club/' . $id  . '/1.jpg' ) ):?>
                <a href="<?php echo Yii::app()->baseUrl . '/files/club/' . $id . '/1.jpg'; ?>" title="<?php echo $data->name;?> 照片1">
                <img src="<?php echo Yii::app()->baseUrl . '/files/club/' . $id . '/1.jpg'; ?>" />
                </a>
<?php endif;?>
            </li>
            <li class="club-picture">
<?php if( file_exists( Yii::app()->basePath . '/../files/club/' . $id  . '/2.jpg' ) ):?>
                <a href="<?php echo Yii::app()->baseUrl . '/files/club/' . $id . '/2.jpg'; ?>" title="<?php echo $data->name;?> 照片2">
                <img src="<?php echo Yii::app()->baseUrl . '/files/club/' . $id . '/2.jpg'; ?>"/>
                </a>
<?php endif; ?>
            </li>
            <li class="club-picture">
<?php if( file_exists( Yii::app()->basePath . '/../files/club/' . $id  . '/3.jpg' ) ):?>
                <a href="<?php echo Yii::app()->baseUrl . '/files/club/' . $id . '/3.jpg'; ?>" title="<?php echo $data->name;?> 照片3">
                <img src="<?php echo Yii::app()->baseUrl . '/files/club/' . $id . '/3.jpg'; ?>"/>
                </a>
<?php endif; ?>
            </li>
        </ul>
</div>
<div class="club-display-head" id="club-head-<?php echo $data->category;?>">
<?php if ( Club::model()->getIsAdmin($id) ) : ?>
    <a href="<?php echo Yii::app()->createUrl('club/modify/' . $id);?>" title="修改">修改</a>
    <a href="<?php echo Yii::app()->createUrl('club/uploadpicture/' . $id);?>" title="上傳圖片">上傳圖片</a>
<?php endif;?>
<h4><?php echo $data->name;?></h4>    
</div>    
<div class="club-display" id="club-<?php echo $data->category;?>">
    <div class="club-title">簡介:</div>
    <div class="club-item">
<?php echo $data->introduction; ?>
    </div>
    <div class="club-title"><?php if ( $data->category !=2 ) : ?>社長:<?php else : ?>系代:<?php endif; ?></div>
    <div class="club-item">
<?php echo $data->leader; ?>
    </div>
    <div class="club-title">手機:</div>
    <div class="club-item">
<?php echo $data->leader_phone; ?>
    </div>
    <div class="club-title">E-mail:</div>
    <div class="club-item">
<?php echo $data->leader_email; ?>
    </div>
    <div class="club-title">二進位ID:</div>
    <div class="club-item">
<?php echo $data->leader_binary; ?>
    </div>
    <div class="club-title">MSN:</div>
    <div class="club-item">
<?php echo $data->leader_msn; ?>
    </div>
    <div class="club-title"><?php if ( $data->category !=2 ) : ?>副社長:<?php else : ?>副系代:<?php endif; ?></div>
    <div class="club-item">
<?php echo $data->viceleader; ?>
    </div>
    <div class="club-title">手機:</div>
    <div class="club-item">
<?php echo $data->viceleader_phone; ?>
    </div>
    <div class="club-title">E-mail:</div>
    <div class="club-item">
<?php echo $data->viceleader_email; ?>
    </div>
    <div class="club-title">二進位ID:</div>
    <div class="club-item">
<?php echo $data->viceleader_binary; ?>
    </div>
    <div class="club-title">MSN:</div>
    <div class="club-item">
<?php echo $data->viceleader_msn; ?>
    </div>
<?php if ( $data->website != null ):?>
    <div class="club-title">網站:</div>
    <div class="club-item">
    <a href="<?php echo $data->website;?>"><?php echo $data->website;?></a>
    </div>
<?php endif;?>
</div>
<div class="club-display-bottom" id="club-bottom-<?php echo $data->category;?>">
<a class="back">回上一頁</a>
</div>