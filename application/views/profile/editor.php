<h2>編輯基本資料</h2>
<form enctype="multipart/form-data" action="<?php echo Yii::app()->createUrl('profile/editor'); ?>" method="POST">
 <input name="token" value="<?php echo Yii::app()->security->getToken(); ?>" type="hidden" />
<?php if ( $user->profile->picture !=' ' ) : ?>
    <img  height="200" src="<?php echo $target.'/'.$user->profile->picture; ?>" alt="Score image" />  
<?php else : ?>
     <img  height="200" src="<?php echo $target.'/image1.jpg'; ?>" alt="Score image" />
<?php endif; ?>        
    <ul>
        </li>  
        <li>
            <span>姓名:</span>
            <input type="text" name="profile[name]"  value="<?php echo $user->profile->name ; ?>" />
            <br />
            <br />
        </li>
        <li>
            <span>暱稱:</span>
            <input type="text" name="profile[nickname]" value="<?php echo $user->profile->nickname; ?>" />
            <br />
            <br />
        </li>
        <li>
            <span>帳號(email):</span>
            <input type="text" name="register[username]" value="<?php echo $user->username; ?>" />
            <input type="hidden" name="register[password]" value="<?php echo $user->password; ?>"  />             
            <br />       
            <br />
        </li>
        <li>
            <span>系所:</span><?php echo $user->profile->department->short_name; ?>
            <select name="profile[department]" value="<?php echo $user->profile->department->short_name; ?>">
<?php foreach ( $departments as $department ) : ?>
                    <option value="<?php echo $department->id; ?>"><?php echo $department->department; ?></option>
<?php endforeach; ?>       
            </select>
            <br />
            <br />
        </li>
        <li>
            <span>系級:</span><?php echo $user->profile->grade; ?>年級
                <select name="profile[grade]" value="<?php echo $user->profile->grade; ?>">
                    <option value="1">一年級</option>
                    <option value="2">二年級</option>
                    <option value="3">三年級</option>
                    <option value="4">四年級</option>
                    <option value="5">其它</option>
                </select>
            <br />
            <br />
        </li>
        <li>
            <span>畢業高中:</span>
            <input type="text" name="profile[senior]" value="<?php echo $user->profile->senior; ?>" />      
            <br />
            <br />
        </li>
        <li>
            <span>生日:</span>
            <input type="text" name="profile[birthday]" value="<?php echo $user->profile->birthday; ?>" /> 
            <br />
            <br />
        </li> 
        <li>
            <span>大頭照:</span>
            <input type="file" name="picture" value="<?php echo empty($picture) ? $user->profile->picture : ''; ?>" />
            <br />
            <br />
        </li> 
    </ul>
    <button type="submit">確認</button>
    <button><a href="<?php echo Yii::app()->createUrl('profile/editor')?>">取消</a></button>
    <button><a href="<?php echo Yii::app()->createUrl('profile/profile')  ?>">BACK</a></button>
</form>