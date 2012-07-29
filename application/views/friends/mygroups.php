<div>
<ul class="introduce-group">
<li><span id="introduce">群組名稱:</span><?php echo $mygroup->name; ?></li>
<li><span id="introduce">群組簡介:</span><?php echo $mygroup->description; ?></li>
<ul>
</div>
<div class="mygroup">
   <!-- <div class="friends-part2">-->
<form method="POST" action="<?php echo $this->createUrl('friends/deletegroup', array('id'=>$mygroup->id)); ?>">
    <input type="hidden" name="token" value="<?php echo Yii::app()->security->getToken();?>" />
        <ul class="other-department">
<?php foreach ($members as $member ): ?>
            <li>
<?php $profile = Profile::model()->findByPK($member->user_id); ?>
<?php if ( $profile->picture !='' ): ?>
                <img  width="100" height="120" src="<?php echo $target.'/'.$profile->picture; ?>" alt="Score image" />
<?php else: ?>
                <img  width="100" height="120" src="<?php echo $target.'/image1.jpg'; ?>" alt="Score image" />
<?php endif; ?>
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
     <button type="submit">刪除成員</button>
</form>
</div>
<button><a href="<?php echo Yii::app()->createUrl('friends/friends')  ?>">BACK</a></button>
<button><a href="<?php echo Yii::app()->createUrl('friends/deletegroup', array('id'=>$mygroup->id))  ?>">刪除群組</a></button>
<button><a href="<?php echo Yii::app()->createUrl('friends/newmembers', array('id'=>$mygroup->id))  ?>">+新成員</a></button>