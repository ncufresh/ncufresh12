<h1 class="friend-title">好友確認</h1>
<form enctype="multipart/form-data" method="POST" action="<?php echo $this->createUrl('friends/request'); ?>">
<input type="hidden" name="token" value="<?php echo Yii::app()->security->getToken();?>" />
<div class="request">  
    <div class="friends-part2">
        <ul class="other-department">
<?php foreach ( $friends as $friend ) : ?>
            <li>
<a href="<?php echo Yii::app()->createUrl('profile/otherprofile', array('friend_id' => $friend->friend_request->id));  ?>">
<?php $this->widget('Avatar', array(
    'id'        => $friend->friend_request->id
)); ?>
</a>
                <input type="checkbox" name="friends[<?php echo $friend->friend_request->id;?>]" value="<?php echo $friend->friend_request->id;?>"  />
                <h3>
<?php echo $friend->friend_request->name;?>
                </h3>
                <h4>
<?php echo $friend->friend_request->mydepartment->abbreviation; ?>
                </h4>
            </li>
<?php endforeach; ?>
        </ul>
    </div>
</div>
<button type="submit" name="agree" class="button-makefriend"></button>
<button type="submit" name="cancel" class="button-cancel"></button>
<button type="button" class="button-back"></button>
</form>
