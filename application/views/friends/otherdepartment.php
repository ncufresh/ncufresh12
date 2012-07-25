<form enctype="multipart/form-data" method="POST" action="<?php echo $this->createUrl('friends/makefriends'); ?>">
<table class="other-page">
    <tr>
        <th colspan="5" class="friend-other-page">其他科系</th>
    </tr>
<tr>
<?php $row = 0; ?>
<?php $col = 1; ?>
<?php foreach ( $profiles as $profile ) : ?>
<?php if ( $row<=4 ) : ?>
    <td class="friends-allsame-ones">
        
<?php if ( $profile->picture !='' ) : ?>
    <img  height="70" src="<?php echo $target.'/'.$profile->picture; ?>" alt="Score image"/>
<?php else : ?>
    <img  height="70" src="<?php echo $target.'/image1.jpg'; ?>" alt="Score image"/>
<?php endif; ?>
    <input type="checkbox" name="friends[<?php echo $profile->id;?>]" value="<?php echo $profile->id;?>"  /><?php echo $profile->name;?>
<?php echo $profile->department->short_name; ?>
        </td>
<?php if ( $col%5==0 ) : ?>
<?php $row+=1; ?>
    </tr>
    <tr>
<?php endif; ?>
<?php endif; ?>
<?php $col++; ?>
<?php endforeach; ?>
<?php if ( $col%5!=0 ) :?>
    </tr>
<?php endif; ?>
</table>
<button type="submit">確定加為好友</button>
</form>
<button><a href="<?php echo Yii::app()->createUrl('friends/otherdepartment')  ?>">重選</a></button>
<button><a href="<?php echo Yii::app()->createUrl('friends/friends')  ?>">BACK</a></button>