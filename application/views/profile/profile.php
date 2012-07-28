<h1>基本資料</h1>
<div class="myprofile">
    <div class="friends-part3">
<?php if ( $user->profile->picture !='' ):?>
        <img width="170" height="160" src="<?php echo $target . '/' . $user->profile->picture; ?>" alt="Score image" />
<?php else:?>
        <img width="170" height="160" src="<?php echo $target . '/image1.jpg'; ?>" alt="Score image" />
<?php endif;?>
        <ul class="user-editor">  
            <li>
                姓名:<?php echo $user->profile->name; ?>
            </li>
            <li>
                暱稱:<?php echo $user->profile->nickname; ?>
            </li>
            <li>
                性別:
<?php if ( $user->profile->sex == 0 ): ?>
                男孩兒
<?php else:?>
                女孩兒
<?php endif; ?>    
            </li>
            <li>
                帳號:<?php echo $user->username; ?>      
            </li>
            <li>
                系所:<?php echo $user->profile->department->short_name; ?>
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
<button><a href="<?php echo Yii::app()->createUrl('profile/editor'); ?>">編輯</a></button>
<button><a href="<?php echo Yii::app()->createUrl('site/index'); ?>">BACK</a></button>
