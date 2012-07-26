<form method="POST" action="<?php echo Yii::app()->createUrl('friends/addnewmembers', array('id'=>$id))  ?>">
<input type="hidden" name="token" value="<?php echo Yii::app()->security->getToken(); ?>" />
<h1>成員</h1>
<div class="newmember">
<table>
    <tr>
<?php $row = 0; ?>
<?php $col = 1; ?>
<?php foreach ( $user->friends as $friend ) : ?>
<?php if ( $row <= 4 ) :?>
        <td class="friends-allsame-ones">
<?php if ( $friend->profile->picture !='' ) : ?>
        <img  height="70" src="<?php echo $target.'/'.$friend->profile->picture; ?>" alt="Score image"/>
<?php else : ?>
        <img  height="70" src="<?php echo $target.'/image1.jpg';?>" alt="Score image"/>
<?php endif; ?>
    <ul class="member-name-department">
        <li><input type="checkbox" name="friends[<?php echo $friend->profile->id; ?>]" value="<?php echo $friend->profile->id; ?>"  /></li>
        <li>
<?php echo $friend->profile->name; ?>
        </li>
        <li>
<?php echo $friend->profile->department->short_name; ?>
        </li>
    </ul>
        </td>
<?php if ( $col %5 == 0 ) : ?>
<?php $row+=1; ?>
    </tr>
    <tr>
<?php endif; ?>
<?php endif; ?>
<?php $col++; ?>
<?php endforeach; ?>
<?php if ( $col %5 != 0 ): ?>
    </tr>
<?php endif; ?>
</table>
</div>
<button type="submit">新增</button>
</form>
<button><a href="<?php echo Yii::app()->createUrl('friends/newmembers', array('id'=>$id)); ?>">取消</a></button>
<button><a href="<?php echo Yii::app()->createUrl('friends/mygroups', array('id'=>$id)); ?>">BACK</a></button>
