<form class="friends-search">
    <dl>
        <dt>
            <label for="new-group-search">搜尋</label>
        </dt>
        <dd>
            <input id="new-group-search" type="text"/>
        </dd>
    </dl>
</form>
<form method="POST" action="<?php echo Yii::app()->createUrl('friends/newgroup');  ?>">
<input type="hidden" name="token" value="<?php echo Yii::app()->security->getToken();?>" />
    <label>名稱: </label>
<input type="text" name="group-name" required="true" />
    <label>描述: </label>
<input type="text" name="group-description" />
    <label>成員: </label>
    <div id="newgroup">
    <h4>可加成員(朋友)</h4>
    <div id="new-group-members">
        <ul class="users-department">
<?php foreach ( $user->friends as $friend ) : ?>
            <li>
                <a href="<?php echo Yii::app()->createUrl('profile/otherprofile', array('friend_id' => $friend->profile->id));  ?>">
<?php $this->widget('Avatar', array(
    'id'        => $friend->profile->id
)); ?>
                </a>
                <input type="checkbox" name="friends[<?php echo $friend->profile->id;?>]" value="<?php echo $friend->profile->id ; ?>" />
                <input type="hidden" name="friends-all-choose[<?php echo $friend->profile->id;?>]" value="<?php echo $friend->profile->id;?>" />    
                <p class="user-name"><?php echo $friend->profile->name ; ?></p>
                <p class="user-department"><?php echo $friend->profile->mydepartment->abbreviation ; ?></p>
            </li>
<?php endforeach ; ?>
        </ul>
    </div>
    <button class="button-all-choose">全選</button>
    <button type="submit" class="button-sure">確認</button>
    <a href="<?php echo $this->createUrl('friends/friends'); ?>" class="button-back">BACK</a>
    </div>
</form>
