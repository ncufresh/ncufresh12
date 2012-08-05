<div class="allgroups">
    <h4>我的群組</h4>
    <div class="a-group-users">
        <ul class="all-groups">
<?php foreach ( $groups as $mygroup ) : ?>
            <li>
                <a href="<?php echo Yii::app()->createUrl('friends/mygroups', array('id'=>$mygroup->id));?>" class="mygroup-name"><?php echo $mygroup->name ; ?></a>
            </li>
<?php endforeach; ?>
        </ul>
    </div>
    <a href="<?php echo $this->createUrl('friends/friends'); ?>" class="button-back">BACK</a>
<?php if ( Yii::app()->user->getFlash('delete-group-error') ) : ?>
    <span class="friends-wrong-message">刪除群組失敗!!</span>
<?php endif; ?>   
</div>