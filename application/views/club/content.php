<?php $this->beginWidget('system.web.widgets.CClipWidget', array('id' => 'script')); ?>
<script type="text/javascript">
jQuery(document).ready(function()
{
    jQuery('.club-picture1').click(function()
    {
		jQuery('#club-picture-dialog1').dialog(
        {
            height: 620,
            width: 820,
            modal: true,
            show: 
            {
                effect: 'flod',
                direction: 'down'
            }
        });
    });
	jQuery('.club-picture2').click(function()
    {
		jQuery('#club-picture-dialog2').dialog(
        {
            height: 620,
            width: 820,
            modal: true,
            show: 
            {
                effect: 'flod',
                direction: 'down'
            }
        });
    });
	jQuery('.club-picture3').click(function()
    {
		jQuery('#club-picture-dialog3').dialog(
        {
            height: 620,
            width: 820,
            modal: true,
            show: 
            {
                effect: 'flod',
                direction: 'down'
            }
        });
    });
	jQuery('.club-picture4').click(function()
    {
		jQuery('#club-picture-dialog4').dialog(
        {
            height: 620,
            width: 820,
            modal: true,
            show: 
            {
                effect: 'flod',
                direction: 'down'
            }
        });
    });
	
});
</script>
<?php $this->endWidget();?>
<div id="club-underpicture">
        <div id="club-menu-items">
            <div class="club-picture1">
                <img src="<?php echo Yii::app()->baseUrl . '/files/club/' . $id . '/1.jpg'; ?>"/>
            </div>
            <div class="club-picture2">
                <img src="<?php echo Yii::app()->baseUrl . '/files/club/' . $id . '/2.jpg'; ?>"/>
            </div>
            <div class="club-picture3">
                <img src="<?php echo Yii::app()->baseUrl . '/files/club/' . $id . '/3.jpg'; ?>"/>
            </div>
            <div class="club-picture4">
                <img src="<?php echo Yii::app()->baseUrl . '/files/club/' . $id . '/4.jpg'; ?>"/>
            </div>
        </div>
</div>

<div id="club-picture-dialog1">
	<div class="club-picture-display1">
        <img src="<?php echo Yii::app()->baseUrl . '/files/club/' . $id . '/1.jpg'; ?>"/>
    </div>
</div>
<div id="club-picture-dialog2">
	<div class="club-picture-display2">
        <img src="<?php echo Yii::app()->baseUrl . '/files/club/' . $id . '/2.jpg'; ?>"/>
    </div>
</div>
<div id="club-picture-dialog3">
	<div class="club-picture-display3">
        <img src="<?php echo Yii::app()->baseUrl . '/files/club/' . $id . '/3.jpg'; ?>"/>
    </div>
</div>
<div id="club-picture-dialog4">
	<div class="club-picture-display4">
        <img src="<?php echo Yii::app()->baseUrl . '/files/club/' . $id . '/4.jpg'; ?>"/>
    </div>
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
    <?php echo $data->introduction; ?>
    <div id="club-title"><?php if ( ! $data->category ) : ?>社長<?php else : ?>系代<?php endif; ?></div>
    <?php echo $data->leader; ?>
    <div id="club-title">手機:</div>
    <?php echo $data->leader_phone; ?>
    <div id="club-title">E-mail:</div>
    <?php echo $data->leader_e_mail; ?>
    <div id="club-title">二進位ID:</div>
    <?php echo $data->leader_binary_id; ?>
    <div id="club-title">MSN:</div>
    <?php echo $data->leader_msn; ?>
    <div id="club-title"><?php if ( ! $data->category ) : ?>副社長<?php else : ?>副系代<?php endif; ?></div>
    <?php echo $data->viceleader; ?>
    <div id="club-title">手機:</div>
    <?php echo $data->viceleader_phone; ?>
    <div id="club-title">E-mail:</div>
    <?php echo $data->viceleader_e_mail; ?>
    <div id="club-title">二進位ID:</div>
    <?php echo $data->viceleader_binaryid; ?>
    <div id="club-title">MSN:</div>
    <?php echo $data->viceleader_msn; ?>
    <div id="club-title">社站:</div>
    <?php echo $data->club_web; ?>
</div>