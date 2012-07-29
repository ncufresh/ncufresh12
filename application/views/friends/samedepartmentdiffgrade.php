<form enctype="multipart/form-data" method="POST" action="<?php echo $this->createUrl('friends/makefriends'); ?>">
<input type="hidden" name="token" value="<?php echo Yii::app()->security->getToken();?>" />
<h1 class="friend-title">同屆不同系</h1>
<div class="sameDdiffG">
    <div class="friends-part2">
        <ul class="other-department">
<?php foreach ( $profiles as $profile ) : ?>
            <li>
<a href="<?php echo Yii::app()->createUrl('friends/samedepartmentdiffgrade');  ?>">
<?php $this->widget('Avatar', array(
    'id'        => Yii::app()->user->id
)); ?>
</a>
                <input type="checkbox" name="friends[<?php echo $profile->id;?>]" value="<?php echo $profile->id;?>"  />
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
<button><a href="<?php echo Yii::app()->createUrl('friends/samedepartmentdiffgrade');  ?>">重選</a></button>
<button><a href="<?php echo Yii::app()->createUrl('friends/friends');  ?>">BACK</a></button>