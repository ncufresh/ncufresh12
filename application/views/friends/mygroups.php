<form method="POST" action="<?php echo $this->createUrl('friends/deletemembers', array('id'=>$mygroup->id)); ?>">
<input type="hidden" name="token" value="<?php echo Yii::app()->security->getToken();?>" />
<table>
    <tr>
    <th colspan="5" class="mygroup-name" ><?php echo $mygroup->name; ?></ th>
    </tr>
    <tr>
<?php 
    $row = 0;
    $col = 1;
?>
<?php  foreach ($members as $member ): ?>
<?php $profile = Profile::model()->findByPK($member->user_id); ?>
<?php if ( $row<=4 ) : ?> 
        <td>
<?php if ( $profile->picture !='' ): ?>
        <img  height="70" src="<?php echo $target.'/'.$profile->picture; ?>" alt="Score image" />
<?php else: ?>
        <img  height="70" src="<?php echo $target.'/image1.jpg'; ?>" alt="Score image" />
<?php endif; ?>
        <input type="checkbox" name="members[<?php echo $profile->id; ?>]" value="<?php echo $profile->id; ?>" />
<?php echo $profile->name; ?>
<?php echo $profile->department->short_name; ?>
        </td>
<?php if ( $col%5==0 ): ?>
 <?php $row+=1;?>
    </tr>
    <tr>
<?php endif; ?>
<?php endif; ?>
<?php $col++; ?>
<?php endforeach; ?>
<?php if ( $col%5!=0 ): ?>
    </tr>
<?php endif;?>
</table>
<button type="submit">刪除成員</button>
</form>
<button><a href="<?php echo Yii::app()->createUrl('friends/friends')  ?>">BACK</a></button>
<button><a href="<?php echo Yii::app()->createUrl('friends/deletegroup', array('id'=>$mygroup->id))  ?>">刪除群組</a></button>
<button><a href="<?php echo Yii::app()->createUrl('friends/newmembers', array('id'=>$mygroup->id))  ?>">+新成員</a></button>