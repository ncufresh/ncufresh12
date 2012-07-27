<h2>好友專區</h2>
<div class="friend">
<div class="add-friend" >
<div>
<span class="form-friends-sort-title" >新增好友</span>
</div>
<table class="group">
    <tr class="friends-title" >
        <th colspan="2" class="form-friends-title"><a href="<?php echo Yii::app()->createUrl('friends/samedepartmentsamegrade'); ?>" title="同系同屆" class="friends-title">同系同屆</a></th>
    </tr>
    <tr>
<?php $account = 1; ?>
<?php foreach ( $profileFir as $profilefir ) : ?>
<?php if ( $account<=4 ):  ?>
        <td class="friends-samediff-ones">
<?php if ( $profilefir->picture !='' ):?>
        <img  height="30" src=" <?php echo $target.'/'.$profilefir->picture; ?>" alt="Score image" />
<?php echo $profilefir->name; ?>
<?php else: ?>
        <img  height="30" src=" <?php echo $target.'/image1.jpg'; ?>" alt="Score image" />
<?php echo $profilefir->name; ?>
<?php endif; ?>
        </td>
<?php if ( $account == 2 ) :?>
    </tr>
    <tr>
<?php endif; ?>
<?php $account++;?>
<?php else: ?>
<?php break; ?>
<?php endif; ?>
<?php endforeach; ?>
    </tr>
</table>
<table class="group">
    <tr class="friends-title">
        <th colspan="2" class="form-friends-title"><a href="<?php echo Yii::app()->createUrl('friends/samedepartmentdiffgrade'); ?>" title="同系不同屆" class="friends-title">同系不同屆</a></th>
    </tr>
    <tr>
<?php $account = 1;?>
<?php foreach ( $profileSec as $profilesec ) : ?>
<?php if ( $account<=4 ) :?>  
<td class="friends-samediff-ones">
<?php if ( $profilesec->picture !='' ): ?> 
        <img  height="30" src=" <?php echo $target.'/'.$profilesec->picture; ?>" alt="Score image"/>
<?php echo $profilesec->name;?>   
<?php else: ?>
        <img  height="30" src=" <?php echo $target.'/image1.jpg'; ?>" alt="Score image"/>
<?php echo $profilesec->name; ?> 
<?php endif; ?>
        </td>
<?php if ( $account == 2 ) :?>
    </tr>
    <tr>
<?php endif; ?>
<?php $account++;?>
<?php else: ?>
<?php break; ?>
<?php endif; ?>
<?php endforeach; ?>
    </tr>
</table>
<table class="group">
    <tr>
        <th class="form-friends-title"><a href="<?php echo Yii::app()->createUrl('friends/otherdepartment'); ?>" title="其他科系" class="friends-title">其他科系</a></th>
    </tr>
    <tr>
<?php $account = 1 ; ?>
<?php foreach ( $profileThir as $profilethir ) :?>
<?php if ( $account <= 4 ):?> 
<td class="friends-samediff-ones">
<?php if ( $profilethir->picture !='' ):?>
        <img  height="30" src=" <?php echo $target.'/'.$profilethir->picture ; ?>" alt="Score image"/>
<?php echo $profilethir->name ; ?>
<?php else : ?>
        <img  height="30" src=" <?php echo $target.'/image1.jpg'; ?>" alt="Score image"/>
<?php echo $profilethir->name ; ?>s    
<?php endif; ?>
        </td>
<?php if ( $account == 2 ) :?>
    </tr>
    <tr>
<?php endif; ?>
<?php $account++;?>
<?php else: ?>
<?php break; ?>
<?php endif; ?>
<?php endforeach; ?>
    </tr>
</table>
</div>
<div>
<span class="form-friends-sort-title" >新增好友</span>
</div>
<table>
    <tr>
        <th class="form-friends-title"><a href="<?php echo Yii::app()->createUrl('friends/myfriends') ; ?>" title="朋友" class="friends-title">朋友</a></th> 
    </tr>
    <tr>
<?php  $account = 1;?>
<?php foreach ( $user->friends as $friend ) : ?>
<?php if ( $account<=5 ) : ?> 
<td class="friends-close-ones">
<?php if ( $friend->profile->picture !='' ) : ?>
        <img  height="30" src=" <?php echo $target.'/'.$friend->profile->picture; ?>" alt="Score image"/>
<?php echo $friend->profile->name ; ?>
        </td>
<?php else : ?>
        <img  height="30" src=" <?php echo $target.'/image1.jpg'; ?>" alt="Score image"/>
<?php echo $friend->profile->name ; ?>     
<?php endif ; ?>
</td>
<?php $account++ ; ?>
<?php else : ?>
<?php break ; ?>
<?php endif ; ?>
<?php endforeach ; ?>
    </tr>
    <tr>
        <th class="form-friends-title"><a href="<?php echo Yii::app()->createUrl('friends/allgroups')  ?>" title="我的群組" class="friends-title">我的群組</a></th>
    </tr>
    <tr>
        <th class="form-friends-title"><a href="<?php echo Yii::app()->createUrl('friends/newgroup') ; ?>" title="自訂" class="friends-title">自訂類別</a></th> 
    </tr>
</table>
</div>