<form method="POST" action="<?php echo Yii::app()->createUrl('friends/addnewmembers', array('id'=>$id))  ?>">
<input type="hidden" name="token" value="<?php echo Yii::app()->security->getToken(); ?>" />
<h1>成員</h1>
<div class="newmember">
    <div class="friends-part2">
        <ul class="other-department">
<?php foreach ( $user->friends as $friend ) : ?>
            <li>
<?php $this->widget('Avatar', array(
    'id'        => Yii::app()->user->id
)); ?>
                <input type="checkbox" name="friends[<?php echo $friend->profile->id; ?>]" value="<?php echo $friend->profile->id; ?>"  />
                <h3>
<?php echo $friend->profile->name; ?>
                </h3>
                <h4>
<?php echo $friend->profile->department->short_name; ?>
                </h4>
           </li>
<?php endforeach; ?>
        </ul>
    </div>
</div>
<button type="submit">新增</button>
</form>
<button><a href="<?php echo Yii::app()->createUrl('friends/newmembers', array('id'=>$id)); ?>">取消</a></button>
<button><a href="<?php echo Yii::app()->createUrl('friends/mygroups', array('id'=>$id)); ?>">BACK</a></button>
