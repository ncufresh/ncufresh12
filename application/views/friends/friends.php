<h2>好友專區</h2>
<table class="sep-group">
    <tr class="friends-title" >
        <th colspan="4" class="form-friends-sort-title" >新增好友</a></th
    </tr>
    <tr class="friends-title" >
        <th colspan="4" class="form-friends-title"><a href="<?php echo Yii::app()->createUrl('friends/samedepartmentsamegrade'); ?>" title="同系同屆" class="form-friends-title">同系同屆</a></th> <!--重新導向一個自訂的網頁-->
    </tr>
    <tr>
<?php $account = 1; ?>
<?php foreach ( $profileFir as $profilefir ) : ?>
<?php if ( $account<=4 ):  ?>
<td class="friends-samediff-ones">
<?php if ( $profilefir->picture !='' ):?>
        <img  height="70" src=" <?php echo $target.'/'.$profilefir->picture; ?>" alt="Score image"/>
<?php echo $profilefir->name; ?>
<?php else: ?>
        <img  height="70" src=" <?php echo $target.'/image1.jpg'; ?>" alt="Score image"/>
<?php echo $profilefir->name; ?> 
<?php endif; ?>
        </td>
<?php $account++;?>
<?php endif; ?>
<?php break; ?>
<?php endforeach; ?>
    </tr>
    <tr class="friends-title">
        <th align="center";  colspan="4" class="form-friends-title" ><a href="<?php echo Yii::app()->createUrl('friends/samedepartmentdiffgrade'); ?>" title="同系不同屆" class="form-friends-title">同系不同屆</a></th> <!--重新導向一個自訂的網頁-->
    </tr>
    <tr>
<?php $account = 1;?>
<?php foreach ( $profileSec as $profilesec ) : ?>
<?php if ( $account<=4 ) :?>  
<td class="friends-samediff-ones">
<?php if ( $profilesec->picture !='' ): ?> 
        <img  height="70" src=" <?php echo $target.'/'.$profilesec->picture; ?>" alt="Score image"/>
<?php echo $profilesec->name;?>   
<?php else: ?>
        <img  height="70" src=" <?php echo $target.'/image1.jpg'; ?>" alt="Score image"/>
<?php echo $profilesec->name; ?> 
<?php endif; ?>
        </td>
<?php $account++; ?>
<?php else: ?>
<?php break; ?>
<?php endif; ?>
<?php endforeach; ?>
    </tr>
    <tr class="friends-title">
        <th colspan="4" class="form-friends-title" ><a href="<?php echo Yii::app()->createUrl('friends/otherdepartment'); ?>" title="其他科系" class="form-friends-title">其他科系</a></th> <!--重新導向一個自訂的網頁-->
    </tr>
    <tr>
<?php $account = 1 ; ?>
<?php foreach ( $profileThir as $profilethir ) :?>
<?php if ( $account<=4 ):?> 
<td class="friends-samediff-ones">
<?php if ( $profilethir->picture !='' ):?>
        <img  height="70" src=" <?php echo $target.'/'.$profilethir->picture ; ?>" alt="Score image"/>
<?php echo $profilethir->name ; ?>
<?php else : ?>
        <img  height="70" src=" <?php echo $target.'/image1.jpg'; ?>" alt="Score image"/>
<?php echo $profilethir->name ; ?>s    
<?php endif;?>
</td>
<?php $account++ ; ?>
<?php else : ?>
<?php break ; ?>
<?php endif ; ?>
<?php endforeach ; ?>
    </tr>
</table>
<table class="close-group">
    <tr class="friends-title" >
        <th colspan="5" class="form-friends-sort-title" >好友分類</a></th>
    </tr>
    <tr>
        <th colspan="5" class="form-friends-title" ><a href="<?php echo Yii::app()->createUrl('friends/myfriends') ; ?>" title="朋友" class="form-friends-title">朋友</a></th> <!--重新導向一個自訂的網頁-->
    </tr>
    <tr>
<?php  $account = 1;?>
<?php foreach ( $profileFor->friends as $friend ) : ?>
<?php if ( $account<=5 ) : ?> 
<td class="friends-close-ones">
<?php if ( $friend->profile->picture !='' ) : ?>
        <img  height="70" src=" <?php echo $target.'/'.$friend->profile->picture; ?>" alt="Score image"/>
<?php echo $friend->profile->name ; ?>
        </td>
<?php else : ?>
        <img  height="70" src=" <?php echo $target.'/image1.jpg'; ?>" alt="Score image"/>
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
        <th colspan="5" class="form-friends-title" ><a href="<?php echo Yii::app()->createUrl('friends/mygroups') ; ?>" title="群組" class="form-friends-title">我的群組</a></th>
    </tr>
</table>
<table>
    <tr>
        <th>
<?php
$account = 1;
$row = (integer)($amonut / 6)+1;
?>
    <ul>
<?php foreach($group->mygroups as $mygroup) : ?>
<?php if ( $account % $row <> 0 ) : ?>
<?php else : ?>
        </th>
        <th>
<?php endif ; ?>
            <li>
<a href="<?php echo Yii::app()->createUrl('friends/mygroups', array('id'=>$mygroup->id));?>"><?php echo $mygroup->name ; ?></a>
            </li>
<?php $account++ ; ?>
<?php endforeach ; ?>
<?php if ( $account%5==0 ) : ?>
        </th>
    </ul>
<?php endif ; ?>
        </th>
    </tr>
</table>
<table>
    <tr>
        <th class="form-friends-title"><a href="<?php echo Yii::app()->createUrl('friends/newgroup') ; ?>" title="自訂" class="form-friends-self-editor">自訂</a></th> 
    </tr>
</table>
