<h4>同屆不同系</h4>
<div id="sameDdiffG">
<form class="A-group-users" method="POST" action="<?php echo $this->createUrl('friends/makefriends'); ?>">
        <ul class="users-department">
<?php foreach ( $profiles as $profile ) : ?>
            <li>
<a href="<?php echo Yii::app()->createUrl('profile/otherprofile', array('friend_id' => $profile->id));  ?>">
<?php $this->widget('Avatar', array(
    'id'        => $profile->id
)); ?>
</a>
                <input type="checkbox" name="friends[<?php echo $profile->id;?>]" value="<?php echo $profile->id;?>"  />
                <input type="hidden" name="friends-all-choose[<?php echo $profile->id;?>]" value="<?php echo $profile->id;?>" />
                <h3>
<?php echo $profile->name;?>
                </h3>
                <h4>
<?php echo $profile->mydepartment->abbreviation; ?>
                </h4>
            </li>
<?php endforeach; ?>
        </ul>
    <button type="submit" name="all-choose" class="button-all-choose">全選</button>
    <input type="hidden" name="token" value="<?php echo Yii::app()->security->getToken();?>" />
    <button type="submit" class="button-addfriends"></button>
</form>
<a href="<?php echo $this->createUrl('friends/friends'); ?>" class="button-back"></a>
</div>