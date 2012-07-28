<h2>基本資料</h2>
<form enctype="multipart/form-data" action="<?php echo Yii::app()->createUrl('site/register'); ?>" method="POST">
    <dl>
        <dt>
            <label for="form-register-name">姓名</label>
        </dt>
        <dd>
            <input id="form-register-name" name="profile[name]" type="text" />
        </dd>
    </dl>
    <dl>
        <dt>
            <label for="form-register-nickname">暱稱</label>
        </dt>
        <dd>
            <input id="form-register-nickname" name="profile[nickname]" type="text" />
        </dd>
    </dl>
    <dl class="radio">
        <dt>
            <label for="form-register-sex-male">性別</label>
        </dt>
        <dd>
            <input id="form-register-sex-male" name="sex" type="radio" /><label for="form-register-sex-male">Male</label>
            <input id="form-register-sex-female" name="sex" type="radio" /><label for="form-register-sex-female">Female</label>
        </dd>
    </dl>
    <dl>
        <dt>
            <label for="form-register-username">帳號(e-mail)</label>
        </dt>
        <dd>
            <input id="form-register-username" name="register[username]" type="text" />
        </dd>
    </dl>
    <dl>
        <dt>
            <label for="form-register-password">密碼</label>
        </dt>
        <dd>
            <input  name="register[password]" type="password" />
        </dd>
    </dl>
    <dl class="select">
        <dt>
            <dd>
                <select name="profile[department]">
<?php foreach ( $departments as $department ) : ?>
                    <option value="<?php echo $department->id; ?>">
                    <?php echo $department->department; ?>
                    </option>
<?php endforeach; ?>
                </select>
                <select name="profile[grade]">
                    <option value="1">一年級</option>
                    <option value="2">二年級</option>
                    <option value="3">三年級</option>
                    <option value="4">四年級</option>
                    <option value="5">其它</option>
                </select>
            </dd>
        </dt>
    </dl>
    <dl>
        <dt>
            <label for="form-register-senior">畢業高中</label>
        </dt>
        <dd>
            <input id="form-register-senior" name="profile[senior]" type="text" />
        </dd>
    </dl>
    <dl>
        <dt>
            <label for="form-register-birthday">生日</label>
        </dt>
        <dd>
            <input id="form-register-birthday" name="profile[birthday]" type="text" />
        </dd>
    </dl>
        <input name="token" value="<?php echo Yii::app()->security->getToken(); ?>" type="hidden" />
        <input type="file" name="picture" />
        <button type="submit">註冊</button>
</form>