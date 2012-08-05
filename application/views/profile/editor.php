<form class="myprofile"  action="<?php echo Yii::app()->createUrl('profile/editor'); ?>" method="POST">
    <input name="token" value="<?php echo Yii::app()->security->getToken(); ?>" type="hidden" />
    <h4>編輯基本資料</h4>
    <div class="profile-modify">
<?php $this->widget('Avatar', array(
    'id'        => Yii::app()->user->id
)); ?>
         <ul class="user-editor">
            <li>
                <span>姓名：</span>
                <input type="text" name="profile[name]"  value="<?php echo $user->profile->name ; ?>" />
            </li>
            <li>
                <span> 暱稱：</span>
                <input type="text" name="profile[nickname]" value="<?php echo $user->profile->nickname; ?>" />
            </li>
            <li class="is_exist">
<?php if ( isset($profile_errors['nickname']) ) : ?>
<?php foreach ( $profile_errors['nickname'] as $error ) : ?>
<?php echo $error; ?>
<?php endforeach; ?>
<?php endif; ?>
            </li>
            <li>
<?php if ( $user->profile->gender == 0 ): ?>
                性別：男孩兒<input type="hidden" name="profile[gender]" value="<?php echo $user->profile->gender; ?>"  />
<?php else:?>
                性別：女孩兒<input type="hidden" name="profile[gender]" value="<?php echo $user->profile->gender; ?>"  />
<?php endif; ?>
            </li>
            <li>
                <span>帳號：<?php echo $user->username; ?></span>
                <input type="hidden" name="register[username]" value="<?php echo $user->username; ?>" />
                <input type="hidden" name="register[password]" value="<?php echo $user->password; ?>"  />
                <input type="hidden" name="register[confirm]" value="<?php echo $user->password; ?>"  />
            </li>
            <li>
                <span>系所：</span><?php echo $user->profile->mydepartment->abbreviation; ?>
                <input type="hidden" name="profile[department]" value="<?php echo $user->profile->department_id; ?>"  />
            </li>
            <li>
<?php if ( $user->profile->grade == 0 ) : ?>
                 <span>系級：這是秘密唷^.&lt;</span>
<?php else : ?>
                 <span>系級：<?php echo $user->profile->grade; ?>年級</span>
<?php endif; ?>
                <input type="hidden" name="profile[grade]" value="<?php echo $user->profile->grade; ?>"  />
            </li>
            <li>
                <span>畢業高中：</span>
                <input type="text" name="profile[senior]" value="<?php echo $user->profile->senior; ?>" />
            </li>
            <li>
                <span>生日：</span>
                <input id="form-editor-birthday" class="datepicker" name="profile[birthday]" type="text" value="<?php echo $user->profile->birthday; ?>" />
            </li>
        </ul>
    </div>
    <button type="submit" id="button-editor-sure">確認</button>
    <a href="<?php echo Yii::app()->createUrl('profile/editor'); ?>" id="button-editor-cancel">取消</a>
    <a href="<?php echo Yii::app()->createUrl('profile/profile'); ?>" class="button-back">BACK</a>
</form>