<h4>我的群組</h4>
<div class="allgroups">
    <div class="a-group-users">
        <ul class="all-groups">
<?php foreach ( $groups as $mygroup ) : ?>
            <li>
                <a href="<?php echo Yii::app()->createUrl('friends/mygroups', array('id'=>$mygroup->id));?>" class="mygroup-name"><?php echo $mygroup->name ; ?></a>
            </li>
<?php endforeach; ?>
        </ul>
    </div>
</div>
<a href="<?php echo $this->createUrl('friends/friends'); ?>" class="button-back">BACK</a>