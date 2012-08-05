<form id="other-department" method="POST" action="<?php echo $this->createUrl('friends/makefriends'); ?>">
<input type="hidden" name="token" value="<?php echo Yii::app()->security->getToken();?>" />
    <h4>其他科系</h4>
    <div class="a-group-users">
        <ul class="users-department">
<?php foreach ( $profiles as $profile ) : ?>
            <li>
<a href="<?php echo Yii::app()->createUrl('profile/otherprofile', array('friend_id' => $profile->id));  ?>">
<?php $this->widget('Avatar', array(
    'id'        => $profile->id
)); ?>
</a>
                <input type="checkbox" name="friends[<?php echo $profile->id;?>]" value="<?php echo $profile->id;?>"  />
                <p class="user-name">
<?php echo $profile->name;?>
                </p>
                <p class="user-department">
<?php echo $profile->mydepartment->abbreviation; ?>
                </p>
            </li>
<?php endforeach; ?>
        </ul>
    </div>
    <input type="text" value="搜尋"/>
    <button class="button-all-choose">全選</button>
    <button type="submit" class="button-addfriends">新增好友</button>
    <a href="<?php echo $this->createUrl('friends/friends'); ?>" class="button-back">BACK</a>
</form>

