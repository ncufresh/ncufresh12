<h1>我的好友</h1>
<div id="myfriend">
<form class="friends-part2" method="POST" action="<?php echo $this->createUrl('friends/deletefriends'); ?>">
<input type="hidden" name="token" value="<?php echo Yii::app()->security->getToken();?>" />
        <ul class="users-department">
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
    <button type="submit" class="button-deletefriend"></button>
</form>
<button type="button" class="button-back"></button>
</div>
