<h4>基本資料</h4>
<div class="myprofile">
    <div class="friends-part3">
<?php $this->widget('Avatar', array(
    'id'        => $user->id //得到profile的id---觀看他人基本資料
)); ?>
        <ul class="user-editor">  
            <li>
                姓名:<?php echo $user->profile->name; ?>
            </li>
            <li>
                暱稱:<?php echo $user->profile->nickname; ?>
            </li>
            <li>
                性別:
<?php if ( $user->profile->gender == 0 ): ?>
                男孩兒
<?php else:?>
                女孩兒
<?php endif; ?>    
            </li>
            <li>
                帳號:<?php echo $user->username; ?>      
            </li>
            <li>
                系所:<?php echo $user->profile->mydepartment->abbreviation; ?>
            </li>
            <li>
                系級:<?php echo $user->profile->grade; ?>年級
            </li>
            <li>
                畢業高中:<?php echo $user->profile->senior; ?>    
            </li>
            <li>
                生日:<?php echo $user->profile->birthday; ?>
            </li>   
        </ul>
    </div>
</div>
<?php if ( ! $is_friend ) : ?>
<form action="<?php echo Yii::app()->createUrl('friends/makefriends'); ?>" method="POST" >
    <input type="hidden" name="token" value="<?php echo Yii::app()->security->getToken(); ?>" />
    <input type="hidden" name="friends[<?php echo $user->id; ?>]" value="<?php echo $user->id; ?>" />
    <button type="submit" class="button-addfriend" ></button>
    <button type="button" class="button-back" ></button>
</form>
<?php else : ?>
<button type="button" class="button-back" ></button>
<?php endif; ?>