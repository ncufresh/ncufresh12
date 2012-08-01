<div id="login">
    <h2>需要登入</h2>
    <p>您沒有辦法進入這個區域，可能的原因如下：</p>
    <ul>
        <li>帳號或密碼輸入錯誤，請再次確認帳號密碼是否輸入正確。</li>
        <li>這個網址並不適合您觀看，請不要嘗試進入管制的網頁。</li>
        <li>猴子很可愛 :-)</li>
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