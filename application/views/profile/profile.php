<h2>基本資料</h2>
<form enctype="multipart/form-data" action="<?php echo Yii::app()->createUrl('profile/profile'); ?>" method="POST">
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
            <label class="form-profile-name"><?php echo $user->profile->name; ?></label>  
        </li>
        <li>
            <label class="form-profile-nickname">暱稱:  </label>
            <label class="form-register-nickname"><?php echo $user->profile->nickname; ?></label>
        </li>
        <li>
            <label class="form-profile-username">帳號(email):  </label>
            <label class="form-register-username"><?php echo $user->username; ?></label>         
        </li>
        <li>
            <label class="form-profile-department">系所:  </label>
            <label class="form-register-department"><?php echo $user->profile->department->short_name; ?></label>
            </label> 
        </li>
        <li>
            <label class="form-profile-grade">系級:  </label>
            <label class="form-register-grade"><?php echo $user->profile->grade; ?>年級</label>    
        </li>
        <li>
            <label class="form-profile-senior">畢業高中:  </label>
            <label class="form-register-senior"><?php echo $user->profile->senior; ?></label>      
        </li>
        <li>
            <label class="form-profile-birthday">生日:  </label>
            <label class="form-register-birthday"><?php echo $user->profile->birthday; ?></label> 
        </li>   
        <li>
            <label>群組: </label>
            <ul>
                <?php
                    $temp = Group::model()->findByPk(38);
                    foreach($temp->mygroups as $row1)
                    {
                         $one_id = $row1->id;
                         echo '抓到社團=>'.$one_id . '<br/>';
                         $temp2 = UserGroup::model()->getMemberId($one_id);
                         foreach($temp2 as $row2)
                         {
                            echo '抓到人類=>';
                            echo Profile::model()->findByPK($row2->user_id)->name.'<br/>';
                         }
                         echo '====一個社團搜尋完畢====</br></br>';
                    }
                    exit();
                    foreach( $temp->mygroup->groups as $group ):
                        
                        echo '<li>'.$group->name.'</li>';
                    endforeach;
                ?>
            </ul>
        </li>
    </ul>
    <input name="token" value="<?php echo Yii::app()->security->getToken(); ?>" type="hidden" />
    <button name="form-profile-editor" type="submit">編輯</button>
    <button name="form-profile-back" type="submit">BACK</button>
</form>