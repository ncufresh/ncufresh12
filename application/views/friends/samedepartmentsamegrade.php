<form enctype="multipart/form-data" method="POST" action="<?php echo $this->createUrl('friends/makefriends'); ?>">
<input type="hidden" name="token" value="<?php echo Yii::app()->security->getToken();?>" />
<h1 class="friend-title">同屆同系</h1>
<div class="sameDsameG">
    <div class="friends-part2">
        <ul class="other-department">
<?php foreach ( $profiles as $profile ) : ?>
            <li>
<?php if ( $profile->picture !='' ):?>
                <img  width="100" height="120" src="<?php echo $target.'/'.$profile->picture; ?>" alt="Score image" />
<?php else: ?>
                <img  width="100" height="120" src="<?php echo $target.'/image1.jpg'; ?>" alt="Score image" />
<?php endif; ?>
                <input type="checkbox" name="friends[<?php echo $profile->id;?>]" value="<?php echo $profile->id;?>" />
                <h3>
<?php echo $profile->name;?>
                </h3>
                <h4>
<?php echo $user->profile->department->short_name; ?>
                </h4>
            </li>
<?php endforeach; ?>
        </ul>
    </div>
</div>
<button type="submit">確定加為好友</button>
</form>
<button><a href="<?php echo Yii::app()->createUrl('friends/samedepartmentsamegrade')  ?>">重選</a></button>
<button><a href="<?php echo Yii::app()->createUrl('friends/friends')  ?>">BACK</a></button>