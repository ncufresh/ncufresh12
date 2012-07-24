<h2>編輯基本資料</h2>
<form enctype="multipart/form-data" action="<?php echo Yii::app()->createUrl('site/editor'); ?>" method="POST">
   <!-- <input type="hidden" name="MAX_FILE_SIZE" value="327680" />-->    
    <img  height="200" src="
    <?php
        if ( $user->profile->picture !='' )
        {
            echo $target.'/'.$user->profile->picture; 
        }
        else
        { 
            echo $target.'/image1.jpg';
        }
    ?>
        " alt="Score image"/>  
    <ul>
        </li>  
        <li>
            <label class="form-profile-name">姓名:  </label>
            <input type="text" name="profile[name]"  value="<?php if ( empty($register['name']) ) echo $user->profile->name; ?>" />
            <br />
            <br />
        </li>
        <li>
            <label class="form-profile-nickname">暱稱:  </label>
            <input type="text" name="profile[nickname]" value="<?php if ( empty($profile['nickname']) ) echo $user->profile->nickname; ?>" />
            <br />
            <br />
        </li>
        <li>
            <label class="form-profile-username">帳號(email):  </label>
            <input type="text" name="register[username]" value="<?php if ( empty($register['username']) ) echo $user->username; ?>" />
            <input type="hidden" name="register[password]" value="<?php echo $user->password; ?>"  />             
            <br />       
            <br />
        </li>
        <li>
            <label class="form-profile-department">系所:  </label>
            <label ><?php echo $user->profile->department->short_name; ?> </label>
            <select name="profile[department]" value="<?php if ( empty($profile['department']) )  echo $user->profile->department->short_name; ?>">
                <?php foreach ( $departments as $department ) : ?>
                    <option value="<?php echo $department->id; ?>"><?php echo $department->department; ?></option> <!--$department->content;   content是欄位名稱(成員)-->
                <?php endforeach; ?>       
            </select>
            <br />
            <br />
        </li>
        <li>
            <label class="form-profile-grade">系級:  </label>
            <label ><?php echo $user->profile->grade; ?>年級"</label>
                <select name="profile[grade]" value="<?php if ( empty($profile['grade']) ) echo $user->profile->grade; ?>">
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
            <label class="form-profile-senior">畢業高中:  </label>
            <input type="text" name="profile[senior]" value="<?php if ( empty($profile['senior']) ) echo $user->profile->senior; ?>" />      
            <br />
            <br />
        </li>
        <li>
            <label class="form-profile-birthday">生日:  </label>
            <input type="text" name="profile[birthday]" value="<?php if ( empty($profile['birthday']) ) echo $user->profile->birthday; ?>" /> 
            <br />
            <br />
        </li> 
        <li>
            <input name="token" value="<?php echo Yii::app()->security->getToken(); ?>" type="hidden" />
            <label class="form-profile-bpicture">大頭照:  </label>
            <input type="file" name="picture" value="<?php if ( empty($picture) ) echo $user->profile->picture; ?>" /><br /><br />
        </li> 
    </ul>
    <button name="form-profile-sure" type="submit">確認</button>
    <button name="form-profile-cancel" type="submit">取消/BACK</button>
</form>