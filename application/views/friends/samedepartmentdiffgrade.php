<form enctype="multipart/form-data" method="POST" action="<?php echo $this->createUrl('friends/makefriends'); ?>">
<input type="hidden" name="token" value="<?php echo Yii::app()->security->getToken();?>" />
<h1 class="friend-title">同屆不同系</h1>
<div class="sameDdiffG">
    <div class="friends-part2">
        <ul class="ousers-department">
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
    </div>
</div>
<button type="submit" class="button-addfriend"></button>
<button type="button" class="button-back" ></button>
</form>