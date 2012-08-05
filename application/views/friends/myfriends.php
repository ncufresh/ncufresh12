<form id="myfriend" method="POST" action="<?php echo $this->createUrl('friends/deletefriends'); ?>">
<input type="hidden" name="token" value="<?php echo Yii::app()->security->getToken();?>" />
    <h4>我的好友</h4>
    <div class="a-group-users">
        <ul class="users-department">
<?php foreach ( $user->friends as $friend ) :?>
            <li>
                <a href="<?php echo Yii::app()->createUrl('profile/otherprofile', array('friend_id' => $friend->profile->id));  ?>">
<?php $this->widget('Avatar', array(
    'id'        => $friend->profile->id
)); ?>
                </a>
                <input type="checkbox" name="friends[<?php echo $friend->profile->id;?>]" value="<?php echo $friend->profile->id;?>" />
                <p class="user-name">
<?php echo $friend->profile->name;?>
                </p>
                <p class="user-department">
<?php echo $friend->profile->mydepartment->abbreviation ?>
                </p>
            </li>
<?php endforeach;?>
        </ul>
    </div>
    <input id="myfriend-search" type="text" value="搜尋"/>
    <button type="submit" class="button-deletefriend">刪除好友</button>
    <button class="button-all-choose">全選</button>
    <a href="<?php echo $this->createUrl('friends/friends'); ?>" class="button-back">BACK</a>
</form>


