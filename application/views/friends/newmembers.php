<form method="POST" action="<?php echo Yii::app()->createUrl('friends/addnewmembers', array('id'=>$id))  ?>">
<input type="hidden" name="token" value="<?php echo Yii::app()->security->getToken(); ?>" />
<h1>成員</h1>
<div class="newmember">
    <div class="friends-part2">
        <ul class="other-department">
<?php foreach ( $user->friends as $friend ) : ?>
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
<?php echo $friend->profile->mydepartment->short_name; ?>
                </h4>
           </li>
<?php endforeach; ?>
        </ul>
    </div>
</div>
<button type="submit">新增</button>
</form>
<a href="<?php echo Yii::app()->createUrl('friends/newmembers', array('id'=>$id)); ?>">取消</a>
<button onClick= "history.back()" >BACK</button>
