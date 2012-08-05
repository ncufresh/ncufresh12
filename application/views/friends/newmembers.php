<form class="newmember" method="POST" action="<?php echo Yii::app()->createUrl('friends/addnewmembers', array('id'=>$id))  ?>">
<input type="hidden" name="token" value="<?php echo Yii::app()->security->getToken(); ?>" />
    <h4>新增成員</h4>
    <div class="a-group-users">
    <ul class="users-department">
<?php foreach ( $friends as $friend ) : ?>
        <li>
            <a href="<?php echo Yii::app()->createUrl('profile/otherprofile', array('friend_id' => $friend->profile->id));  ?>">
<?php $this->widget('Avatar', array(
    'id'        => $friend->profile->id
)); ?>
            </a>
            <input type="checkbox" name="friends[<?php echo $friend->profile->id; ?>]" value="<?php echo $friend->profile->id; ?>"  />
            <p class="user-name">
<?php echo $friend->profile->name; ?>
            </p>
            <p class="user-department">
<?php echo $friend->profile->mydepartment->abbreviation; ?>
            </p>
        </li>
<?php endforeach; ?>
    </ul>
    </div>
    <button type="submit" class="button-sure"></button>
    <button class="button-all-choose">全選</button>
    <a href="<?php echo $this->createUrl('friends/mygroups', array('id' => $id)); ?>" class="button-back"></a>
</form>


