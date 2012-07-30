<form enctype="multipart/form-data" action="<?php echo Yii::app()->createUrl('profile/editor'); ?>" method="POST">
<h1>編輯基本資料</h1>
<div class="myprofile">
    <div class="friends-part3">
<?php $this->widget('Avatar', array(
    'id'        => Yii::app()->user->id
)); ?>
         <ul class="user-editor">
            <li>
                <span>姓名:</span>
                <input type="text" name="profile[name]"  value="<?php echo $user->profile->name ; ?>" />
            </li>
            <li>
                <span>暱稱:</span>
                <input type="text" name="profile[nickname]" value="<?php echo $user->profile->nickname; ?>" />
            </li>
            <li>
                <span>帳號(email):</span>
                <input type="text" name="register[username]" value="<?php echo $user->username; ?>" />
                <input type="hidden" name="register[password]" value="<?php echo $user->password; ?>"  />
            </li>
            <li>
                <span>系所:</span><?php echo $user->profile->department->short_name; ?>
            </li>
            <li>
                <span>系級:</span><?php echo $user->profile->grade; ?>年級
            </li>
            <li>
                <span>畢業高中:</span>
                <input type="text" name="profile[senior]" value="<?php echo $user->profile->senior; ?>" />
            </li>
            <li>
                <span>生日:</span>
                <input type="text" name="profile[birthday]" value="<?php echo $user->profile->birthday; ?>" />
            </li> 
        </ul>
    </div>
</div>
<input name="token" value="<?php echo Yii::app()->security->getToken(); ?>" type="hidden" />
<button type="submit">確認</button>
</form>
<button><a href="<?php echo Yii::app()->createUrl('profile/editor'); ?>">取消</a></button>
<button onClick= "history.back()" >BACK</button>