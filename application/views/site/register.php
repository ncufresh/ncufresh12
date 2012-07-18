<h2>註冊</h2>
<p>
	Please enter your username and desired password to sign up 
	
</p>
<form method="post" action="<?php echo Yii::app()->createUrl('site/register'); ?>" >
	<dl>
        <dt>
            <label for="form-register-username">帳號</label>
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
	</div>
    <div>
        <input name="token" value="<?php echo Yii::app()->security->getToken(); ?>" type="hidden" />
        <button id="form-register-button" type="submit" name="register_submit">註冊</button>
    </div>
</form>