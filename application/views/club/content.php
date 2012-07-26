<?php $this->beginWidget('system.web.widgets.CClipWidget', array('id' => 'script')); ?>
<script type="text/javascript">
jQuery(document).ready(function()
{
    $('#club-menu-items a').lightbox();
	
});
</script>
<?php $this->endWidget();?>
<div id="club-underpicture">
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
<div id="club-display">
<?php if ( ! $data->category ) : ?>
    <a href="<?php echo Yii::app()->createUrl('club/club');?>" title="社團">社團</a>
    <?php echo '→' . $data->name?>
<?php endif; ?>
<?php if ( $data->category ) : ?>
    <a href="<?php echo Yii::app()->createUrl('club/department');?>" title="系所">系所</a>
    <?php echo '→' . $data->name?>
<?php endif; ?>
<?php if ( $this->getIsAdmin($id) ) : ?>
    <a href="<?php echo Yii::app()->createUrl('club/modify/' . $id);?>" title="修改">修改</a>
    <a href="<?php echo Yii::app()->createUrl('club/uploadpicture/' . $id);?>" title="上傳圖片">上傳圖片</a>
<?php endif;?>
    <h1><?php echo $data->name;?></h1>
    <div id="club-title">簡介:</div>
    <div id="club-introduce">
    <?php echo $data->introduction; ?>
    </div>
    <div id="club-title"><?php if ( ! $data->category ) : ?>社長<?php else : ?>系代<?php endif; ?></div>
    <div class="club-item">
    <?php echo $data->leader; ?>
    </div>
    <div id="club-title">手機:</div>
    <div class="club-item">
    <?php echo $data->leader_phone; ?>
    </div>
    <div id="club-title">E-mail:</div>
    <div class="club-item">
    <?php echo $data->leader_e_mail; ?>
    </div>
    <div id="club-title">二進位ID:</div>
    <div class="club-item">
    <?php echo $data->leader_binary_id; ?>
    </div>
    <div id="club-title">MSN:</div>
    <div class="club-item">
    <?php echo $data->leader_msn; ?>
    </div>
    <div id="club-title"><?php if ( ! $data->category ) : ?>副社長<?php else : ?>副系代<?php endif; ?></div>
    <div class="club-item">
    <?php echo $data->viceleader; ?>
    </div>
    <div id="club-title">手機:</div>
    <div class="club-item">
    <?php echo $data->viceleader_phone; ?>
    </div>
    <div id="club-title">E-mail:</div>
    <div class="club-item">
    <?php echo $data->viceleader_e_mail; ?>
    </div>
    <div id="club-title">二進位ID:</div>
    <div class="club-item">
    <?php echo $data->viceleader_binaryid; ?>
    </div>
    <div id="club-title">MSN:</div>
    <div class="club-item">
    <?php echo $data->viceleader_msn; ?>
    </div>
    <?php if ( $data->club_web != null ) :?>
    <div id="club-title">網站:</div>
    <div class="club-item">
    <a href="<?php echo $data->club_web;?>"><?php echo $data->club_web;?></a>
    </div>
    <?php endif; ?>

</div>