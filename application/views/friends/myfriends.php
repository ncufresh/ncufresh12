<form method="POST" action="<?php echo $this->createUrl('friends/deletefriends'); ?>">
<input type="hidden" name="token" value="<?php echo Yii::app()->security->getToken();?>" />
<h1 class="friend-title">我的好友</h1>
<div class="myfriend">
    <div class="friends-part2">
        <ul class="other-department">
<?php foreach ( $user->friends as $friend ) :?>
            <li>
<a href="<?php echo Yii::app()->createUrl('profile/otherprofile', array('friend_id' => $friend->profile->id));  ?>">
<?php $this->widget('Avatar', array(
    'id'        => $friend->profile->id
)); ?>
</a>
                <input type="checkbox" name="friends[<?php echo $friend->profile->id;?>]" value="<?php echo $friend->profile->id;?>" />
                <h3>
<?php echo $friend->profile->name;?>
                </h3>
                <h4>
<?php echo $friend->profile->mydepartment->abbreviation ?>
                </h4>
            </li>
<?php endforeach;?>
        </ul>
    </div>
</div>
<button type="submit">取消好友</button>
</form>
<button onClick= "history.back()" >BACK</button>