<form id="request" method="POST" action="<?php echo $this->createUrl('friends/request'); ?>">
<input type="hidden" name="token" value="<?php echo Yii::app()->security->getToken();?>" />
    <h4>好友確認</h4>
    <div class="a-group-users">
        <ul class="users-department">
<?php foreach ( $friends as $friend ) : ?>
            <li>
                <a href="<?php echo Yii::app()->createUrl('profile/otherprofile', array('friend_id' => $friend->friend_request->id));  ?>">
<?php $this->widget('Avatar', array(
    'id'        => $friend->friend_request->id
)); ?>
                </a>
                <input type="checkbox" name="friends[<?php echo $friend->friend_request->id;?>]" value="<?php echo $friend->friend_request->id;?>"  />
                <p class="user-name">
<?php echo $friend->friend_request->name;?>
                </p>
                <p class="user-department">
<?php echo $friend->friend_request->mydepartment->abbreviation; ?>
                </p>
            </li>
<?php endforeach; ?>
        </ul>
    </div>
    <input id="request-search" type="text" value="搜尋"/>
    <button type="submit" name="agree" class="button-makefriend">好友確認</button>
    <button type="submit" name="cancel" class="button-cancel">取消</button>
    <button class="button-all-choose">全選</button>
    <a href="<?php echo $this->createUrl('friends/friends'); ?>" class="button-back">BACK</a>
</form>

