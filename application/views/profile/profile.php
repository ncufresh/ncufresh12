<h2>基本資料</h2>
<?php if ( $user->profile->picture !='' ):?>
    <img src="<?php echo $target . '/' . $user->profile->picture; ?>" alt="Score image" />
<?php else:?>
    <img src="<?php echo $target . '/image1.jpg'; ?>" alt="Score image" />
<?php endif;?>
    <ul>
        </li>  
        <li>
            <span>姓名:</span><?php echo $user->profile->name; ?>
        </li>
        <li>
            <span>暱稱:</span><?php echo $user->profile->nickname; ?>
        </li>
        <li>
            <span>性別:</span>
<?php if ( $user->profile->sex == 0 ): ?>
            男孩兒
<?php else:?>
            女孩兒
<?php endif; ?>    
        </li>
        <li>
           <span>帳號(email):</span>><?php echo $user->username; ?>      
        </li>
        <li>
            <span>系所:</span><?php echo $user->profile->department->short_name; ?>
        </li>
        <li>
            <span>系級:</span><?php echo $user->profile->grade; ?><span>年級</span>
        </li>
        <li>
            <label class="form-profile-senior">畢業高中:  </label>
            <label class="form-register-senior"><?php echo $user->profile->senior; ?></label>      
        </li>
        <li>
            <span>生日:</span><?php echo $user->profile->birthday; ?>
        </li>   
    </ul>
    <button><a href="<?php echo Yii::app()->createUrl('profile/editor'); ?>">編輯</a></button>
    <button><a href="<?php echo Yii::app()->createUrl('site/index'); ?>">BACK</a></button>
</form>