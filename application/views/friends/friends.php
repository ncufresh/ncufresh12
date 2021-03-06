<div class="friends">
<div class="all-sorts-of-friends">
<h4>好友專區</h4>
<ul class="friends-title">
    <li>
        <a href="<?php echo Yii::app()->createUrl('friends/samedepartmentsamegrade'); ?>" title="同系同屆" class="friends-title">同系同屆</a>
    </li>
    <li>
        <a href="<?php echo Yii::app()->createUrl('friends/samedepartmentdiffgrade'); ?>" title="同系不同屆" class="friends-title">同系不同屆</a>
    </li>
    <li>
        <a href="<?php echo Yii::app()->createUrl('friends/otherdepartment'); ?>" title="其他科系" class="friends-title">其他科系</a>
    </li>
</ul>
<div class="friends-addfriend">
<ul class="friends-sort" >
<?php $account = 1; ?>
<?php foreach ( $profileFir as $profilefir ) : ?>
<?php if ( $account<=4 ):  ?>
    <li>
<a href="<?php echo Yii::app()->createUrl('profile/otherprofile', array('friend_id' => $profilefir->id));  ?>">
<?php $this->widget('Avatar', array(
    'id'        => $profilefir->id
)); ?>
</a>    
<?php echo $profilefir->name;?> 
<?php $account++;?>
<?php endif; ?>
     </li>
<?php endforeach; ?>
</ul>
<ul class="friends-sort" >
<?php $account = 1;?>
<?php foreach ( $profileSec as $profilesec ) : ?>
<?php if ( $account<=4 ) :?>
    <li>
<a href="<?php echo Yii::app()->createUrl('profile/otherprofile', array('friend_id' => $profilesec->id));  ?>">
<?php $this->widget('Avatar', array(
    'id'        => $profilesec->id
)); ?>
</a>
<?php echo $profilesec->name; ?>
<?php $account++;?>
<?php endif; ?>
    </li>
<?php endforeach; ?>
</ul>
<ul class="friends-sort">
<?php $account = 1 ; ?>
<?php foreach ( $profileThir as $profilethir ) :?>
<?php if ( $account <= 4 ):?> 
    <li>
        <a href="<?php echo Yii::app()->createUrl('profile/otherprofile', array('friend_id' => $profilethir->id));  ?>">
<?php $this->widget('Avatar', array(
    'id'        => $profilethir->id
)); ?>
        </a>
<?php echo $profilethir->name ; ?>
<?php $account++;?>
<?php endif; ?>
     </li>
<?php endforeach; ?>
</ul>
</div>
<h4>
好友分類
<a href="<?php echo Yii::app()->createUrl('friends/request'); ?>" title="好友確認" class="friends-title">好友確認</a>
</h4>
<div class="friends-sortfriend">
<ul class="friends-self">
    <li>
        <a href="<?php echo Yii::app()->createUrl('friends/myfriends') ; ?>" title="朋友" class="friends-title">
        朋友(
<?php echo $friend_amount; ?> 
        人)
        </a>
        <a href="<?php echo Yii::app()->createUrl('friends/allgroups')  ?>" title="我的群組" class="friends-title">我的群組</a>
        <a href="<?php echo Yii::app()->createUrl('friends/newgroup') ; ?>" title="自訂" class="friends-title">自訂類別</a>
    </li>
<?php  $account = 1;?>
<?php foreach ( $user->friends as $friend ) : ?>
<?php if ( $account<=5 ) : ?> 
    <li>
<a href="<?php echo Yii::app()->createUrl('profile/otherprofile', array('friend_id' => $friend->profile->id));  ?>">
<?php $this->widget('Avatar', array(
    'id'        => $friend->profile->id
)); ?>
</a>
<?php echo $friend->profile->name ; ?>     
<?php $account++ ; ?>
<?php endif ; ?>
    </li>
<?php endforeach ; ?>
</ul>
</div>
</div>
<?php if ( Yii::app()->user->getFlash('add-new-group-error') ) : ?>
    <span class="friends-wrong-message">新增群組失敗!!</span>
<?php endif; ?>
</div>