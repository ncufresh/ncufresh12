<div class="myprofile">
    <h4>基本資料</h4>
    <div class="profile-modify">
<?php $this->widget('Avatar', array(
    'id'        => Yii::app()->user->id,
    'link'      => true
)); ?>
        <ul class="user-editor">  
            <li>
                姓名：<?php echo $user->profile->name; ?>
            </li>
            <li>
                暱稱：<?php echo $user->profile->nickname; ?>
            </li>
            <li>
<?php if ( $user->profile->gender == 0 ): ?>
               性別：男孩兒
<?php else:?>
               性別：女孩兒
<?php endif; ?>
            </li>
            <li>
                帳號：<?php echo $user->username; ?>      
            </li>
            <li>
                系所：<?php echo $user->profile->mydepartment->abbreviation; ?>
            </li>
            <li>
<?php if ( $user->profile->grade == 0 ) : ?>
                系級：這是秘密唷^.&lt;
<?php else : ?>
                系級：<?php echo $user->profile->grade; ?>年級
<?php endif; ?>
            </li>
            <li>
                畢業高中：<?php echo $user->profile->senior; ?>    
            </li>
            <li>
                生日：<?php echo $user->profile->birthday; ?>
            </li> 
            <a href="<?php echo Yii::app()->createUrl('profile/editor'); ?>" id="button-editor">編輯</a>
            <a href="<?php echo Yii::app()->createUrl('site/index'); ?>" class="button-back"">BACK</a>
        </ul>
        
    </div>
</div>
