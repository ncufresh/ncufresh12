<h2>基本資料</h2>
<form action="<?php echo Yii::app()->createUrl('site/register'); ?>" method="POST">
    <dl>
        <dt>
            <label for="form-register-name">姓名</label>
        <dd>
            <input id="form-register-name" name="profile[name]" type="text" />
        </dd>
    </dl>
    <dl>
        <dt>
            <label for="form-register-nickname">暱稱</label>
        <dd>
            <input id="form-register-nickname" name="profile[nickname]" type="text" />
        </dd>
    </dl>
    <dl>
        <dt>
            <label for="form-register-username">帳號(e-mail)</label>
        <dd>
            <input id="form-register-username" name="register[username]" type="text" />
        </dd>
    </dl>
    <dl>
        <dt>
            <label for="form-register-password">密碼</label>
        </dt>
        <dd>
            <input id="form-register-password" name="register[password]" type="password" />
        </dd>
    </dl>
    <div> 
        <label for="form-register-department">系級</label>
            <select name="profile[department]">
                <?php foreach ( $departments as $department ) : ?>
                    <option value="<?php echo $department->department_id; ?>"><?php echo $department->content; ?></option> <!--$department->content;   content是欄位名稱(成員)-->
                <?php endforeach; ?>
                
            </select>
            <select name="profile[grade]">
                <option value="1">一年級</option>
                <option value="2">二年級</option>
                <option value="3">三年級</option>
                <option value="4">四年級</option>
                <option value="5">其它</option>
            </select>
        </div>
    <dl>
        <dt>
            <label for="form-register-senior">畢業高中</label>
        <dd>
            <input id="form-register-senior" name="profile[senior]" type="text" />
        </dd>
    </dl>
    <dl>
        <dt>
            <label for="form-register-birthday">生日</label>
        <dd>
            <input id="form-register-birthday" name="profile[birthday]" type="text" />
        </dd>
           
    </dl>
        
    <!--<div>
        上傳圖片
    </div>-->
    <div>
        <input name="token" value="<?php echo Yii::app()->security->getToken(); ?>" type="hidden" />
        <button id="form-register-button" type="submit">註冊</button>
    </div>
</form>