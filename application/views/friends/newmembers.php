<h4>新增成員</h4>
<div class="newmember">
<form class="A-group-users" method="POST" action="<?php echo Yii::app()->createUrl('friends/addnewmembers', array('id'=>$id))  ?>">
<input type="hidden" name="token" value="<?php echo Yii::app()->security->getToken(); ?>" />
    <ul class="users-department">
<?php foreach ( $friends as $friend ) : ?>
        <li>
            <a href="<?php echo Yii::app()->createUrl('profile/otherprofile', array('friend_id' => $friend->profile->id));  ?>">
<?php $this->widget('Avatar', array(
    'id'        => $friend->profile->id
)); ?>
            </a>
            <input type="checkbox" name="friends[<?php echo $friend->profile->id; ?>]" value="<?php echo $friend->profile->id; ?>"  />
            <h3>
<?php echo $friend->profile->name; ?>
            </h3>
            <h4>
<?php echo $friend->profile->mydepartment->abbreviation; ?>
            </h4>
        </li>
<?php endforeach; ?>
    </ul>
    <button type="submit" class="button-sure"></button>
</form>
<a href="<?php echo $this->createUrl('friends/mygroups'); ?>" class="button-back"></a>
</div>
