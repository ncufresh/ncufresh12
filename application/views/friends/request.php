<h1 class="friend-title">好友確認</h1>
<form enctype="multipart/form-data" method="POST" action="<?php echo $this->createUrl('friends/request'); ?>">
<input type="hidden" name="token" value="<?php echo Yii::app()->security->getToken();?>" />
<div class="other-department">  
    <div class="friends-part2">
        <ul class="other-department">
<?php foreach ( $friends as $friend ) : ?>
            <li>
<?php $this->widget('Avatar', array(
    'id'        => Yii::app()->user->id
)); ?>
                <input type="checkbox" name="friends[<?php echo $friend->friend_request->id;?>]" value="<?php echo $friend->friend_request->id;?>"  />
                <h3>
<?php echo $friend->friend_request->name;?>
                </h3>
                <h4>
<?php echo $friend->friend_request->department->short_name; ?>
                </h4>
            </li>
<?php endforeach; ?>
        </ul>
    </div>
</div>
<button type="submit" name="agree">確認</button>
<button type="submit" name="cancel">取消</button>
</form>
<button><a href="<?php echo Yii::app()->createUrl('friends/friends')  ?>">BACK</a></button>