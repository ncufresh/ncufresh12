<h2>好友專區</h2>
<div class="friends">
<div class="friends-part1">
<h4>新增好友</h4>
<a href="<?php echo Yii::app()->createUrl('friends/samedepartmentsamegrade'); ?>" title="同系同屆" class="friends-title">同系同屆</a>
<a href="<?php echo Yii::app()->createUrl('friends/samedepartmentdiffgrade'); ?>" title="同系不同屆" class="friends-title">同系不同屆</a>
<a href="<?php echo Yii::app()->createUrl('friends/otherdepartment'); ?>" title="其他科系" class="friends-title">其他科系</a>
<div class="friends-addfriend">
<ul id="friends-sort" >
<?php $account = 1; ?>
<?php foreach ( $profileFir as $profilefir ) : ?>
<?php if ( $account<=4 ):  ?>
    <li>
<?php if ( $profilefir->picture !='' ):?>
        <img  width="90" height="45" src=" <?php echo $target.'/'.$profilefir->picture; ?>" alt="Score image" />
<?php echo $profilefir->name; ?>
<?php else: ?>
        <img  width="90" height="45" src=" <?php echo $target.'/image1.jpg'; ?>" alt="Score image" />
<?php echo $profilefir->name; ?>
</ul>
<?php endif; ?>     
<?php $account++;?>
<?php endif; ?>
     </li>
<?php endforeach; ?>
</ul>
<ul id="friends-sort" >
<?php $account = 1;?>
<?php foreach ( $profileSec as $profilesec ) : ?>
<?php if ( $account<=4 ) :?>
    <li>
<?php if ( $profilesec->picture !='' ): ?> 
        <img  width="90" height="45"src=" <?php echo $target.'/'.$profilesec->picture; ?>" alt="Score image"/>
<?php echo $profilesec->name;?>   
<?php else: ?>
        <img  width="90" height="45" src=" <?php echo $target.'/image1.jpg'; ?>" alt="Score image"/>
<?php echo $profilesec->name; ?> 
<?php endif; ?>
<?php $account++;?>
<?php endif; ?>
    <li>
<?php endforeach; ?>
</ul>
<ul id="friends-sort">
<?php $account = 1 ; ?>
<?php foreach ( $profileThir as $profilethir ) :?>
<?php if ( $account <= 4 ):?> 
    <li>
<?php if ( $profilethir->picture !='' ):?>
        <img  width="90" height="45" src=" <?php echo $target.'/'.$profilethir->picture ; ?>" alt="Score image"/>
<?php echo $profilethir->name ; ?>
<?php else : ?>
        <img  width="90" height="45" src=" <?php echo $target.'/image1.jpg'; ?>" alt="Score image"/>
<?php echo $profilethir->name ; ?>s    
<?php endif; ?>     
<?php $account++;?>
<?php endif; ?>
     </li>
<?php endforeach; ?>
</ul>
</div>
<h4>好友分類</h4>
<div class="friends-sortfriend">
<ul id="friends-self">
    <li>
        <a href="<?php echo Yii::app()->createUrl('friends/myfriends') ; ?>" title="朋友" class="friends-title">朋友</a>
    </li>
<?php  $account = 1;?>
<?php foreach ( $user->friends as $friend ) : ?>
<?php if ( $account<=5 ) : ?> 
    <li>
<?php if ( $friend->profile->picture !='' ) : ?>
        <img width="90" height="60" src=" <?php echo $target.'/'.$friend->profile->picture; ?>" alt="Score image"/>
<?php echo $friend->profile->name ; ?>
<?php else : ?>
        <img width="90" height="60" src=" <?php echo $target.'/image1.jpg'; ?>" alt="Score image"/>
<?php echo $friend->profile->name ; ?>     
<?php endif ; ?>
<?php $account++ ; ?>
<?php endif ; ?>
    </li>
<?php endforeach ; ?>
</ul>
<ul id="friend-other-sort">
    <li>
        <a href="<?php echo Yii::app()->createUrl('friends/allgroups')  ?>" title="我的群組" class="friends-title">我的群組</a>
    </li>
    <li>
        <a href="<?php echo Yii::app()->createUrl('friends/newgroup') ; ?>" title="自訂" class="friends-title">自訂類別</a>
    </li>
</ul>
</div>
</div>
</div>