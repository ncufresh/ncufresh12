<form method="POST" action="<?php echo $this->createUrl('friends/deletemembers', array('id'=>$mygroup->id)); ?>">
<input type="hidden" name="token" value="<?php echo Yii::app()->security->getToken();?>" />
<div>
<ul class="introduce-group">
<li><span id="introduce">群組名稱:</span><?php echo $mygroup->name; ?></li>
<li><span id="introduce">群組簡介:</span><?php echo $mygroup->description; ?></li>
<ul>
</div>
<div class="mygroup">
<table>
    <tr>
<?php 
    $row = 0;
    $col = 1;
?>
<?php  foreach ($members as $member ): ?>
<?php $profile = Profile::model()->findByPK($member->user_id); ?>
<?php if ( $row <= 4 ) : ?> 
        <td>
<?php if ( $profile->picture !='' ): ?>
        <img  height="70" src="<?php echo $target.'/'.$profile->picture; ?>" alt="Score image" />
<?php else: ?>
        <img  height="70" src="<?php echo $target.'/image1.jpg'; ?>" alt="Score image" />
<?php endif; ?>
    <ul class="member-name-department">
        <li><input type="checkbox" name="members[<?php echo $profile->id; ?>]" value="<?php echo $profile->id; ?>" />
        </li>
        <li>
<?php echo $profile->name; ?>
        </li>
        <li>
<?php echo $profile->department->short_name; ?>
        </li>
    </ul>
        </td>
<?php if ( $col %5 == 0 ): ?>
 <?php $row+=1; ?>
    </tr>
    <tr>
<?php endif; ?>
<?php endif; ?>
<?php $col++; ?>
<?php endforeach; ?>
<?php if ( $col %5 != 0 ): ?>
    </tr>
<?php endif;?>
</table>
</div>
<button type="submit">刪除成員</button>
</form>
<button><a href="<?php echo Yii::app()->createUrl('friends/friends')  ?>">BACK</a></button>
<button><a href="<?php echo Yii::app()->createUrl('friends/deletegroup', array('id'=>$mygroup->id))  ?>">刪除群組</a></button>
<button><a href="<?php echo Yii::app()->createUrl('friends/newmembers', array('id'=>$mygroup->id))  ?>">+新成員</a></button>