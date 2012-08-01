<h1>登入</h1>
<div class="login">
    <ul>
        <li>登入失敗</li>
        <li>註冊後再登入吧</li>
        <li>無權進入管理者頁面</li>
    </ul> 
<form method="POST">
    <dl>
        <dt>
            <label for="form-login-username">帳號</label>
        </dt>
        <dd>
            <input id="form-login-username" name="login[username]" type="text" />
        </dd>
    </dl>
    <dl>
        <dt>
            <label for="form-login-password">密碼</label>
        </dt>
        <dd>
            <input id="form-login-password" name="login[password]" type="password" />
        </dd>
    </dl>
    <div>
        <input name="token" value="<?php echo Yii::app()->security->getToken(); ?>" type="hidden" />
        <button id="form-login-button" type="submit">登入</button>
    </div>
</form>
</div>