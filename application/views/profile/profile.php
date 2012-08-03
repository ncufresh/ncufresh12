<h4>基本資料</h4>
<div class="myprofile">
    <div class="friends-part3">
<?php $this->widget('Avatar', array(
    'id'        => Yii::app()->user->id
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
                系級:
<?php if ( $user->profile->grade == 0 ) : ?>
                這是秘密唷^.&lt;
<?php else : ?>
<?php echo $user->profile->grade; ?>年級
<?php endif; ?>
            </li>
            <li>
                畢業高中:<?php echo $user->profile->senior; ?>    
            </li>
            <li>
                生日:<?php echo $user->profile->birthday; ?>
            </li> 
            <a href="<?php echo Yii::app()->createUrl('profile/editor'); ?>" id="button-editor"></a>
            <a href="<?php echo Yii::app()->createUrl('site/index'); ?>" class="button-back""></a>
        </ul>
        
    </div>
</div>
