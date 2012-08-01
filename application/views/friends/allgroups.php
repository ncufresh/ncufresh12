<h1>我的群組</h1>
<div class="allgroups">
    <div class="friends-part2">
        <ul class="all-groups">
<?php foreach ( $groups as $mygroup ) : ?>
            <li>
                <a href="<?php echo Yii::app()->createUrl('friends/mygroups', array('id'=>$mygroup->id));?>" class="mygroup-name"><?php echo $mygroup->name ; ?></a>
            </li>
<?php endforeach; ?>
        </ul>
    </div>
</div>
<button type="button" class="button-back"></button>