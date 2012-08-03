<h4>同屆不同系</h4>
<div id="sameDdiffG">
<form class="friends-part2" method="POST" action="<?php echo $this->createUrl('friends/makefriends'); ?>">
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
<?php echo $user->profile->mydepartment->abbreviation; ?>
                </h4>
            </li>
<?php endforeach; ?>
        </ul>
    <input type="hidden" name="token" value="<?php echo Yii::app()->security->getToken();?>" />
    <button type="submit" class="button-addfriends"></button>
</form>
<a href="<?php echo $this->createUrl('friends/friends'); ?>" class="button-back"></a>
</div>