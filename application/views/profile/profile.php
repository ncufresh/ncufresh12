<h1>基本資料</h1>
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
                系級:<?php echo $user->profile->grade; ?>年級
            </li>
            <li>
                畢業高中:<?php echo $user->profile->senior; ?>    
            </li>
            <li>
                生日:<?php echo $user->profile->birthday; ?>
            </li> 
            <a href="<?php echo Yii::app()->createUrl('profile/editor'); ?>" id="button-editor"></a>
            <button type="button" class="button-back"></button>
        </ul>
        
    </div>
</div>
