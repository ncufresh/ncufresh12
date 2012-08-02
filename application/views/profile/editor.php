<h4>編輯基本資料</h4>
<div class="myprofile">
<form class="friends-part3" action="<?php echo Yii::app()->createUrl('profile/editor'); ?>" method="POST">
    <input name="token" value="<?php echo Yii::app()->security->getToken(); ?>" type="hidden" />
<?php $this->widget('Avatar', array(
    'id'        => Yii::app()->user->id
)); ?>
         <ul class="user-editor">
            <li>
                <span>姓名:</span>
                <input type="text" name="profile[name]"  value="<?php echo $user->profile->name ; ?>" />
            </li>
            <li>
                <span> 暱稱:</span>
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
                性別:
<?php if ( $user->profile->gender == 0 ): ?>
                男孩兒
<?php else:?>
                女孩兒
<?php endif; ?>    
                <input type="hidden" name="profile[gender]" value="<?php echo $user->profile->gender; ?>"  />
            </li>
            <li>
                <span>帳號:<?php echo $user->username; ?></span>
                <input type="hidden" name="register[username]" value="<?php echo $user->username; ?>" />
                <input type="hidden" name="register[password]" value="<?php echo $user->password; ?>"  />
                <input type="hidden" name="register[confirm]" value="<?php echo $user->password; ?>"  />
            </li>
            <li>
                <span>系所:</span><?php echo $user->profile->mydepartment->abbreviation; ?>
                <input type="hidden" name="profile[department]" value="<?php echo $user->profile->department_id; ?>"  />
            </li>
            <li>
                <span>系級:</span><?php echo $user->profile->grade; ?>年級
                <input type="hidden" name="profile[grade]" value="<?php echo $user->profile->grade; ?>"  />
            </li>
            <li>
                <span>畢業高中:</span>
                <input type="text" name="profile[senior]" value="<?php echo $user->profile->senior; ?>" />
            </li>
            <li>
                <span>生日:</span>
                    <select name="profile[year]" class="year">
<?php for ( $year = 2000 ; $year >= 1990 ; $year-- ) : ?>
                        <option value="<?php echo $year; ?>">
<?php echo $year; ?>                        
                        </option>
<?php endfor; ?>
                    </select>
                    <select name="profile[month]" class="month">
<?php for ( $month = 1 ; $month <= 12 ; $month++ ) : ?>
                        <option value="<?php echo $month; ?>">
<?php echo $month; ?>                        
                        </option>
<?php endfor; ?>
                    </select>
                    <select name="profile[day]" class="day">
<?php for ( $day = 1 ; $day <= 31 ; $day++ ) : ?>
                        <option value="<?php echo $day; ?>">
<?php echo $day; ?>                        
                        </option>
<?php endfor; ?>
                    </select>
            </li>
        </ul>
        <button type="submit" class="button-sure"></button>
        </form>
<a href="<?php echo Yii::app()->createUrl('profile/editor'); ?>" class="button-cancel"></a>
<button type="button" class="button-back" ></button>    
</div>