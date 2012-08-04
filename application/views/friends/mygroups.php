<div>
<ul class="introduce-group">
    <li><span id="introduce">群組名稱:</span><?php echo $mygroup->name; ?></li>
    <li><span id="introduce">群組簡介:</span><?php echo $mygroup->description; ?></li>
<ul>
</div>
<div id="mygroup">
<form class="a-group-users" method="POST" action="<?php echo $this->createUrl('friends/deletemembers', array('id'=>$mygroup->id)); ?>">
    <input type="hidden" name="token" value="<?php echo Yii::app()->security->getToken();?>" />
        <ul class="users-department">
<?php foreach ($members as $member ): ?>
            <li>
<?php $profile = Profile::model()->findByPK($member->user_id); ?>
                <a href="<?php echo Yii::app()->createUrl('profile/otherprofile', array('friend_id' => $profile->id));  ?>">
<?php $this->widget('Avatar', array(
    'id'        => $profile->id
)); ?>
                </a>
                <input type="checkbox" name="group-members[<?php echo $profile->id; ?>]" value="<?php echo $profile->id; ?>" />
                <h3>
<?php echo $profile->name; ?>
                </h3>
                <h4>
<?php echo $profile->mydepartment->abbreviation; ?>
                </h4>
            </li>
<?php endforeach; ?>
        </ul>
    <a href="<?php echo Yii::app()->createUrl('friends/newmembers', array('id'=>$mygroup->id))  ?>" id="button-addmember" >新增成員</a>
    <button class="button-all-choose">全選</button>
    <button type="submit" id="button-deletemember">刪除成員</button>
    <a href="<?php echo Yii::app()->createUrl('friends/deletegroup', array('id'=>$mygroup->id))  ?>" id="button-deletegroup" >刪除群組</a>
</form>
</div>
<a href="<?php echo $this->createUrl('friends/allgroups'); ?>" class="button-back">BACK</a>