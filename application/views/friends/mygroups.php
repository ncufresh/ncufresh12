<div>
<ul class="introduce-group">
    <li><span id="introduce">群組名稱:</span><?php echo $mygroup->name; ?></li>
    <li><span id="introduce">群組簡介:</span><?php echo $mygroup->description; ?></li>
<ul>
</div>
<form id="mygroup" method="POST" action="<?php echo $this->createUrl('friends/deletemembers', array('id'=>$mygroup->id)); ?>">
    <input type="hidden" name="token" value="<?php echo Yii::app()->security->getToken();?>" />
    <h4>群組成員</h4>
    <div class="a-group-users">
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
                <p class="user-name">
<?php echo $profile->name; ?>
                </p>
                <p class="user-department">
<?php echo $profile->mydepartment->abbreviation; ?>
                </p>
            </li>
<?php endforeach; ?>
        </ul>
    </div>
    <a href="<?php echo Yii::app()->createUrl('friends/newmembers', array('id'=>$mygroup->id))  ?>" id="button-addmember" >新增成員</a>
    <button class="button-all-choose">全選</button>
    <button type="submit" id="button-deletemember">刪除成員</button>
    <a href="<?php echo Yii::app()->createUrl('friends/deletegroup', array('id'=>$mygroup->id))  ?>" id="button-deletegroup" >刪除群組</a>
    <a href="<?php echo $this->createUrl('friends/allgroups'); ?>" class="button-back">BACK</a>
</form>

