<h2>註冊</h2>
<form id="register" method="POST">
    <h4>帳號資訊</h4>
<?php if ( Yii::app()->user->getFlash('register-error-username') ) : ?>
    <dl class="error">
<?php else: ?>
    <dl>
<?php endif; ?>
        <dt>
            <label for="form-register-username">帳號</label>
        </dt>
        <dd>
            <input id="form-register-username" name="register[username]" type="text" />
            <span>
<?php if ( Yii::app()->user->getFlash('register-error-username-message') ) : ?>
                <span class="error">您的帳號少於八個字元或著帳號已經存在了！</span>
<?php endif; ?>
                帳號必須大於八個字元，且不能有特殊符號。
            </span>
        </dd>
    </dl>
    <dl>
        <dt>
            <label for="form-register-password">密碼</label>
        </dt>
        <dd>
            <input id="form-register-password" name="register[password]" type="password" />
            <span>密碼建議設定八個字元以上，並且英文、數字與特殊符號的組合。</span>
            <div id="form-password-meter">
                <table>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </table>
            </div>
        </dd>
    </dl>
<?php if ( Yii::app()->user->getFlash('register-error-confirm') ) : ?>
    <dl class="error">
<?php else: ?>
    <dl>
<?php endif; ?>
        <dt>
            <label for="form-register-confirm">再輸入一次</label>
        </dt>
        <dd>
            <input id="form-register-confirm" name="register[confirm]" type="password" />
            <span>
<?php if ( Yii::app()->user->getFlash('register-error-confirm-message') ) : ?>
                <span class="error">您的密碼兩次輸入不一樣喔！</span>
<?php endif; ?>
                請再次輸入一次密碼以確認密碼輸入正確！
            </span>
        </dd>
    </dl>
    <h4>基本資料</h4>
<?php if ( Yii::app()->user->getFlash('register-error-name') ) : ?>
    <dl class="error">
<?php else: ?>
    <dl>
<?php endif; ?>
        <dt>
            <label for="form-register-name">姓名</label>
        </dt>
        <dd>
            <input id="form-register-name" name="profile[name]" type="text" maxlength=10 />
            <span>
<?php if ( Yii::app()->user->getFlash('register-error-name-message') ) : ?>
                <span class="error">您輸入的名字太長了喔！</span>
<?php endif; ?>
                請輸入您的真實姓名，最多十個字元。
            </span>
        </dd>
    </dl>
<?php if ( Yii::app()->user->getFlash('register-error-nickname') ) : ?>
    <dl class="error">
<?php else: ?>
    <dl>
<?php endif; ?>
        <dt>
            <label for="form-register-nickname">暱稱</label>
        </dt>
        <dd>
            <input id="form-register-nickname" name="profile[nickname]" type="text" maxlength=5 />
            <span>
<?php if ( Yii::app()->user->getFlash('register-error-nickname-message') ) : ?>
                <span class="error">您的暱稱太長了或者已經有人使用過了！</span>
<?php endif; ?>
                請輸入您的暱稱，不超過五個字元。
            </span>
        </dd>
    </dl>
<?php if ( Yii::app()->user->getFlash('register-error-gender') ) : ?>
    <dl class="radio error">
<?php else: ?>
    <dl class="radio">
<?php endif; ?>
        <dt>
            <label for="form-register-gender-male">性別</label>
        </dt>
        <dd>
            <input id="form-register-gender-male" name="profile[gender]" type="radio" value="0" /><label for="form-register-gender-male">Male</label>
            <input id="form-register-gender-female" name="profile[gender]" type="radio" value="1" /><label for="form-register-gender-female">Female</label>
            <span>
<?php if ( Yii::app()->user->getFlash('register-error-gender-message') ) : ?>
                <span class="error">性別只有男女喔</span>
<?php endif; ?>
                請選擇您的性別。
            </span>
        </dd>
    </dl>
<?php if ( Yii::app()->user->getFlash('register-error-department') ) : ?>
    <dl class="select error">
<?php else: ?>
    <dl class="select">
<?php endif; ?>
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
            <span>
<?php if ( Yii::app()->user->getFlash('register-error-department-message') ) : ?>
                <span class="error">請選擇正確的系級！</span>
<?php endif; ?>
                請選擇您的系級，<strong>一旦決定後便無法再次修改</strong>。
            </span>
        </dd>
    </dl>
<?php if ( Yii::app()->user->getFlash('register-error-birthday') ) : ?>
    <dl class="error">
<?php else: ?>
    <dl>
<?php endif; ?>
        <dt>
            <label for="form-register-birthday">生日</label>
        </dt>
        <dd>
            <input class="datepicker" id="form-register-birthday" name="profile[birthday]" type="text" />
        </dd>
    </dl>
<?php if ( Yii::app()->user->getFlash('register-error-senior') ) : ?>
    <dl class="error">
<?php else: ?>
    <dl>
<?php endif; ?>
        <dt>
            <label for="form-register-senior">畢業高中</label>
        </dt>
        <dd>
            <input id="form-register-senior" name="profile[senior]" type="text" maxlength=8 />
            <span>
                請輸入您的畢業高中！
            </span>
        </dd>
    </dl>
    <div class="buttons">
        <input name="token" value="<?php echo Yii::app()->security->getToken(); ?>" type="hidden" />
        <button type="submit">註冊</button>
        <button type="reset">重填</button>
    </div>
</form>