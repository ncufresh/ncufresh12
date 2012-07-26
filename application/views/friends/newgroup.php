<form method="POST" action="<?php echo Yii::app()->createUrl('friends/newgroup');  ?>">
<input type="hidden" name="token" value="<?php echo Yii::app()->security->getToken();?>" />
    <div>
        <label>名稱: </label>
    <input type="text" name="group-name" required="true" />
        <label>描述: </label>
    <input type="text" name="group-description" />
        <br />
        <label>成員: </label>
    </div>
    <table>
        <tr>
<?php $account = 1 ; ?>
<?php foreach ( $user->friends as $friend ) : ?>
<?php if ( $account %5!= 0 ) : ?>
<?php else : ?> 
        </tr>
    <tr>
<?php $account ++ ; ?>
<?php endif ; ?>
        <td>
<?php if ( $friend->profile->picture !='' ) : ?>
        <img  height="50" src="<?php echo $target.'/'.$friend->profile->picture ; ?>" alt="Score image" />
<?php else : ?>
        <img  height="50" src="<?php echo $target.'/image1.jpg';?>" alt="Score image" />
<?php endif ; ?>    
        <input type="checkbox" name="friends[<?php echo $friend->profile->id;?>]" value="<?php echo $friend->profile->id ; ?>" />
<?php echo $friend->profile->name ; ?>
        <br />
<?php echo $friend->profile->department->short_name ; ?>
        </td>
<?php $account++ ; ?>
<?php endforeach ; ?>
<?php if ( $account %5!= 0 ) : ?>
    </tr>
<?php endif ; ?>
    </table>
    <button type="submit">新增</a>
</form>
<button><a href="<?php echo Yii::app()->createUrl('friends/friends')?>">取消</a></button>