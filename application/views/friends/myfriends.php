<form method="POST" action="<?php echo $this->createUrl('friends/deletefriends'); ?>">
<input type="hidden" name="token" value="<?php echo Yii::app()->security->getToken();?>" />
<table class="other-page">
    <tr >
    <th colspan="5" class="friend-close-page">我的好友</th>
    </tr>
    <tr>
<?php $row = 0;?>
<?php $col = 1;?>
<?php foreach ( $user->friends as $friend ) :?>
<?php if ( $row<=4 ) :?>
        <td class="friends-close-ones">
<?php if ( $friend->profile->picture !='' ) :?>
        <img  height="70" src="<?php echo $target.'/'.$friend->profile->picture; ?> " alt="Score image" />
<?php else :?>
        <img  height="70" src="<?php echo $target.'/image1.jpg'; ?>" alt="Score image" />
<?php endif;?>
        <br />
        <input type="checkbox" name="friends[<?php echo $friend->profile->id;?>]" value="<?php echo $friend->profile->id;?>" />
<?php echo $friend->profile->name;?>
        <br />
<?php echo $friend->profile->department->short_name ?>
        </td>

<?php if ( $col%5==0 ) :?>
<?php $row+=1;?>
    </tr>
    <tr>
<?php endif;?>
<?php endif;?>
<?php $col++;?>
<?php endforeach;?>
<?php if ( $col%5!=0 ):?>
    </tr>
<?php endif;?>
</table>
<button id="form-otherdepartment-cancel" type="submit" name="myfriends-cancel">取消好友/BACK</button>
</form>