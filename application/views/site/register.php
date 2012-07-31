<h1>基本資料</h1>
<div class="register">
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
                <label for="form-register-nickname" class="is_exist">
<?php foreach ( $profile_errors['nickname'] as $error ) : ?>
<?php echo $error; ?>
<?php endforeach; ?>
                </label>
            </dt>
            <dd>
                <input id="form-register-nickname" name="profile[nickname]" type="text" />
            </dd>
        </dl>
<?php endif; ?>
        <dl class="radio">
            <dt>
                <label for="form-register-gender-male">性別</label>
            </dt>
            <dd>
                <input id="form-register-gender-male" name="profile[gender]" type="radio" value="0" /><label for="form-register-gender-male">Male</label>
                <input id="form-register-gender-female" name="profile[gender]" type="radio" value="1" /><label for="form-register-gender-female">Female</label>
            </dd>
        </dl>
<?php if ( !isset($username_errors['username']) ) :?>
        <dl>
            <dt>
                <label for="form-register-username">帳號</label>
            </dt>
            <dd>
                <input id="form-register-username" name="register[username]" type="text" />
            </dd>
        </dl>
<?php else : ?>
        <dl>
            <dt>
                <label for="form-register-username" class="is_exist">
<?php foreach ( $username_errors['username'] as $error ) : ?>
<?php echo $error; ?>
<?php endforeach; ?>
                </label>
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
                <label for="form-register-password" class="is_exist">
<?php foreach ( $username_errors['password'] as $error ) : ?>
<?php echo $error; ?>
<?php endforeach; ?>
                </label>
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
<?php echo $department->name; ?>
                        </option>
<?php endforeach; ?>
                    </select>
                    <select name="profile[grade]">
                        <option value="0">其它</option>
                        <option value="1">一年級</option>
                        <option value="2">二年級</option>
                        <option value="3">三年級</option>
                        <option value="4">四年級</option>
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
                <dd>
                    <select name="profile[year]" class="year">
<?php for ( $year = 2000 ; $year >= 1990 ; $year-- ) : ?>
                        <option value="<?php echo $year; ?>" id="Year">
<?php echo $year; ?>                        
                        </option>
<?php endfor; ?>
                    </select>
                    <select name="profile[month]" class="month">
<?php for ( $month = 1 ; $month <= 12 ; $month++ ) : ?>
                        <option value="<?php echo $month; ?>" id="Month">
<?php echo $month; ?>                        
                        </option>
<?php endfor; ?>
                    </select>
                    <select name="profile[day]" class="day">
<?php for ( $day = 1 ; $day <= 31 ; $day++ ) : ?>
                        <option value="<?php echo $day; ?>" id="Day">
<?php echo $day; ?>                        
                        </option>
<?php endfor; ?>
                    </select>
                </dd>
            </dt>
        </dl>
        <button id="rewrite"><a href="<?php echo Yii::app()->createUrl('site/register'); ?>">重填</a></button>
        <button type="submit">註冊</button>
</form>
</div>