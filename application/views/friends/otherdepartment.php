<h1>其他科系</h1>
<div id="other-department">
<form class="friends-part2" method="POST" action="<?php echo $this->createUrl('friends/makefriends'); ?>">
<input type="hidden" name="token" value="<?php echo Yii::app()->security->getToken();?>" />
        <ul class="users-department">
<?php foreach ( $profiles as $profile ) : ?>
            <li>
<a href="<?php echo Yii::app()->createUrl('profile/otherprofile', array('friend_id' => $profile->id));  ?>">
<?php $this->widget('Avatar', array(
    'id'        => $profile->id
)); ?>
</a>
                <input type="checkbox" name="friends[<?php echo $profile->id;?>]" value="<?php echo $profile->id;?>"  />
                <h3>
<?php echo $profile->name;?>
                </h3>
                <h4>
<?php echo $profile->mydepartment->abbreviation; ?>
                </h4>
            </li>
<?php endforeach; ?>
        </ul>
    <button type="submit" class="button-addfriend"></button>
</form>
<button type="button" class="button-back"></button>
</div>