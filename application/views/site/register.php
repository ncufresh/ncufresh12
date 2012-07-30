<h1>基本資料</h1>
<div class="register">
<div class="friends-part4">
<form  enctype="multipart/form-data" action="<?php echo Yii::app()->createUrl('site/register'); ?>" method="POST">
    <input name="token" value="<?php echo Yii::app()->security->getToken(); ?>" type="hidden" />
        <dl>
            <dt>
                <label for="form-register-name">姓名</label>
            </dt>
            <dd>
                <input id="form-register-name" name="profile[name]" type="text" />
            </dd>
        </dl>
<?php if ( !isset($profile_errors['nickname']) ) :?>
        <dl>
            <dt>
                <label for="form-register-nickname">暱稱</label>
            </dt>
            <dd>
                <input id="form-register-nickname" name="profile[nickname]" type="text" />
            </dd>
        </dl>
<?php else : ?>
         <dl>
            <dt>
                <label for="form-register-nickname" class="is_exist">***暱稱被人捷足先登喇***</label>
            </dt>
            <dd>
                <input id="form-register-nickname" name="profile[nickname]" type="text" />
            </dd>
        </dl>
<?php endif; ?>
        <dl class="radio">
            <dt>
                <label for="form-register-sex-male">性別</label>
            </dt>
            <dd>
                <input id="form-register-sex-male" name="profile[sex]" type="radio" value="0" /><label for="form-register-sex-male">Male</label>
                <input id="form-register-sex-female" name="profile[sex]" type="radio" value="1" /><label for="form-register-sex-female">Female</label>
            </dd>
        </dl>
<?php if ( !isset($username_errors['username']) ) :?>
        <dl>
            <dt>
                <label for="form-register-username">帳號</label>
            </dt>
            <dd>
                <input id="form-register-username" name="register[username]" type="text" />
                <?php echo isset($username_errors['username'][0])?$username_errors['username'][0]:''; ?>
            </dd>
        </dl>
<?php else : ?>
        <dl>
            <dt>
                <label for="form-register-username" class="is_exist">帳號有人用搶了喔/須大於8碼</label>
            </dt>
            <dd>
                <input id="form-register-username" name="register[username]" type="text" />
            </dd>
        </dl>
<?php endif; ?>
<?php if ( !isset($username_errors['password']) ) : ?>
        <dl>
            <dt>
                <label for="form-register-password">密碼</label>
            </dt>
            <dd>
                <input id="form-register-password" name="register[password]" type="password" />
            </dd>
        </dl>
        <dl>
            <dt>
                <label for="form-register-confirm">再輸入一次</label>
            </dt>
            <dd>
                <input id="form-register-confirm" name="register[confirm]" type="password" />
            </dd>
        </dl>
<?php else : ?>
        <dl>
            <dt>
                <label for="form-register-password" class="is_exist">密碼輸入不正確/須大於8碼</label>
            </dt>
            <dd>
                <input id="form-register-password" name="register[password]" type="password" />
            </dd>
        </dl>
        <dl>
            <dt>
                <label for="form-register-confirm" class="is_exist">再輸入一次</label>
            </dt>
            <dd>
                <input id="form-register-confirm" name="register[confirm]" type="password" />
            </dd>
        </dl>
<?php endif; ?>
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
                <label for="form-register-year" <?php if (isset($profile_errors['birthday'])) : ?>class="is_exist"<?php endif; ?>>西元</label>
            </dt>
            <dd>
                <input id="form-register-year" name="profile[year]" type="text"  />
            </dd>
        </dl>
        <dl>
            <dt>
                <label for="form-register-month" <?php if (isset($profile_errors['birthday'])) : ?>class="is_exist"<?php endif; ?>>月</label>
            </dt>
            <dd>
                <input id="form-register-month" name="profile[month]" type="text" />
            </dd>
        </dl>
        <dl>
            <dt>
                <label for="form-register-day" <?php if (isset($profile_errors['birthday'])) : ?>class="is_exist"<?php endif; ?>>日</label>
            </dt>
            <dd>
                <input id="form-register-day" name="profile[day]" type="text" />
            </dd>
        </dl>
            <button id="rewrite"><a href="<?php echo Yii::app()->createUrl('site/register'); ?>">重填</a></button>
            <button type="submit">註冊</button>
</form>
</div>
</div>