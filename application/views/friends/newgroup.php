<form method="POST" action="<?php echo Yii::app()->createUrl('friends/newgroup');  ?>">
<input type="hidden" name="token" value="<?php echo Yii::app()->security->getToken();?>" />
    <div>
        <label>名稱: </label>
    <input type="text" name="group-name" required="true" />
        <label>描述: </label>
    <input type="text" name="group-description" />
        <br />
        <label>成員: </label>
    </div>
<div class="newgroup">
    <div class="friends-part2">
        <ul class="other-department">
<?php foreach ( $user->friends as $friend ) : ?>
            <li>
                <a href="<?php echo Yii::app()->createUrl('profile/otherprofile', array('friend_id' => $friend->profile->id));  ?>">
<?php $this->widget('Avatar', array(
    'id'        => $friend->profile->id
)); ?>
                </a>
                <input type="checkbox" name="friends[<?php echo $friend->profile->id;?>]" value="<?php echo $friend->profile->id ; ?>" />
                <h3>
<?php echo $friend->profile->name ; ?>
                </h3>
                <h4>
<?php echo $friend->profile->department->short_name ; ?>
                </h4>
            </li>
<?php endforeach ; ?>
        </ul>
    </div>
</div>
<button type="submit">新增</a>
</form>
<button onClick= "history.back()" >BACK</button>