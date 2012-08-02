<h2>註冊</h2>
<form id="register" method="POST">
    <dl>
        <dt>
            <label for="form-register-name">姓名</label>
        </dt>
        <dd>
            <input id="form-register-name" name="profile[name]" type="text" />
            <span>
<?php if ( isset($profile_errors['name']) ) : ?>
<?php foreach ( $profile_errors['name'] as $error ) : ?>
<?php echo $error; ?>
<?php endforeach; ?>
<?php else: ?>
             請輸入姓名
<?php endif; ?>   
            </span>
        </dd>
    </dl>
    <dl>
        <dt>
            <label for="form-register-nickname">暱稱</label>
        </dt>
        <dd>
            <input id="form-register-nickname" name="profile[nickname]" type="text" />
            <span>
<?php if ( isset($profile_errors['nickname']) ) : ?>
<?php foreach ( $profile_errors['nickname'] as $error ) : ?>
<?php echo $error; ?>
<?php endforeach; ?>
<?php else: ?>
            人家都怎麼叫你哩^.<
<?php endif; ?>                
            </span>
        </dd>
    </dl>
    <dl class="radio">
        <dt>
            <label for="form-register-gender-male">性別</label>
        </dt>
        <dd>
            <input id="form-register-gender-male" name="profile[gender]" type="radio" value="0" /><label for="form-register-gender-male">Male</label>
            <input id="form-register-gender-female" name="profile[gender]" type="radio" value="1" /><label for="form-register-gender-female">Female</label>
            <span>
<?php if ( isset($profile_errors['gender']) ) :?>
<?php foreach ( $profile_errors['gender'] as $error ) : ?>
<?php echo $error; ?>
<?php endforeach; ?>
<?php else: ?>
            A U MAN OR WOMAN
<?php endif; ?>
            </span>
        </dd>
    </dl>
    <dl>
        <dt>
            <label for="form-register-username">帳號</label>
        </dt>
        <dd>
            <input id="form-register-username" name="register[username]" type="text" />
            <span>
<?php if ( isset($username_errors['username']) ) :?>
<?php foreach ( $username_errors['username'] as $error ) : ?>
<?php echo $error; ?>
<?php endforeach; ?>
<?php else: ?>
            須大於8碼唷
<?php endif; ?>                
            </span>
        </dd>
    </dl>
    <dl>
        <dt>
            <label for="form-register-password">密碼</label>
        </dt>
        <dd>
            <input id="form-register-password" name="register[password]" type="password" />
            <span>
<?php if ( isset($username_errors['password']) ) : ?>
<?php foreach ( $username_errors['password'] as $error ) : ?>
<?php echo $error; ?>
<?php endforeach; ?>
<?php else: ?>
            請輸入密碼
<?php endif; ?>                
            </span>
        </dd>
    </dl>
    <dl>
        <dt>
            <label for="form-register-confirm">再輸入一次</label>
        </dt>
        <dd>
            <input id="form-register-confirm" name="register[confirm]" type="password" />
            <span>再來輸入一次吧....要與密碼相同</span>
        </dd>
    </dl>
    <dl class="select">
        <dt>
        </dt>
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
            <span>系級</span>
        </dd>
    </dl>
    <dl>
        <dt>
            <label for="form-register-senior">畢業高中</label>
        </dt>
        <dd>
            <input id="form-register-senior" name="profile[senior]" type="text" />
            <span>
<?php if ( isset($profile_errors['senior']) ) :?>
<?php foreach ( $profile_errors['senior'] as $error ) : ?>
<?php echo $error; ?>
<?php endforeach; ?>
<?php else: ?>
            輸入畢業高中吧!!
<?php endif; ?>                
            </span>
        </dd>
    </dl>
    <dl class="select">
        <dt>
            <label for="form-register-birthday">生日</label>
        </dt>
        <dd>
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
        </dd>
    </dl>
    <div>
        <input name="token" value="<?php echo Yii::app()->security->getToken(); ?>" type="hidden" />
        <button type="submit">註冊</button>
        <button type="reset">重填</button>
    </div>
</form>