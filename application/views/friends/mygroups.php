<div>
<ul class="introduce-group">
    <li><span id="introduce">群組名稱:</span><?php echo $mygroup->name; ?></li>
    <li><span id="introduce">群組簡介:</span><?php echo $mygroup->description; ?></li>
<ul>
</div>
<form method="POST" action="<?php echo $this->createUrl('friends/deletegroup', array('id'=>$mygroup->id)); ?>">
<div class="mygroup">
   <div class="friends-part2">
    <input type="hidden" name="token" value="<?php echo Yii::app()->security->getToken();?>" />
        <ul class="other-department">
<?php foreach ($members as $member ): ?>
            <li>
<?php $profile = Profile::model()->findByPK($member->user_id); ?>
<a href="<?php echo Yii::app()->createUrl('profile/otherprofile', array('friend_id' => $profile->id));  ?>">
<?php $this->widget('Avatar', array(
    'id'        => $profile->id
)); ?>
</a>
                <input type="checkbox" name="members[<?php echo $profile->id; ?>]" value="<?php echo $profile->id; ?>" />
                <h3>
<?php echo $profile->name; ?>
                </h3>
                <h4>
<?php echo $profile->department->short_name; ?>
                </h4>
            </li>
<?php endforeach; ?>
        </ul>
    </div>
</div>
<button type="submit">刪除成員</button>
</form>
<button onClick= "history.back()" >BACK</button>
<button><a href="<?php echo Yii::app()->createUrl('friends/deletegroup', array('id'=>$mygroup->id))  ?>">刪除群組</a></button>
<button><a href="<?php echo Yii::app()->createUrl('friends/newmembers', array('id'=>$mygroup->id))  ?>">+新成員</a></button>