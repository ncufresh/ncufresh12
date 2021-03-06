<div id="contact">
<h2>聯絡我們</h2>

<?php if ( Yii::app()->user->hasFlash('mailer') ) : ?>
<p class="success">
<?php echo Yii::app()->user->getFlash('mailer'); ?>
</p>
<?php endif; ?>

<form id="contact-form" method="POST">
    <h4>聯絡我們</h4>
    <dl>
        <dt>
            <label for="form-contact-name">名稱</label>
        </dt>
        <dd>
            <input id="form-contact-name" name="contact[name]" type="text" />
            <span>請填寫您的名字。</span>
        </dd>
    </dl>
    <dl>
        <dt>
            <label for="form-contact-email">電子信箱</label>
        </dt>
        <dd>
            <input id="form-contact-email" name="contact[email]" type="text" />
            <span>請填寫您的信箱，方便我們聯絡您。</span>
        </dd>
    </dl>
    <dl>
        <dt>
            <label for="form-contact-subject">主旨</label>
        </dt>
        <dd>
            <input id="form-contact-subject" name="contact[subject]" type="text" />
            <span>請填寫連絡我們的主旨！</span>
        </dd>
    </dl>
    <dl>
        <dt>
            <label for="form-contact-content">內容</label>
        </dt>
        <dd>
            <textarea id="form-contact-content" name="contact[content]"></textarea>
            <span>請填寫寄送內容！</span>
        </dd>
    </dl>
    <div class="buttons">
        <input name="token" value="<?php echo Yii::app()->security->getToken(); ?>" type="hidden" />
        <button type="submit">送出</button>
        <button type="reset">重填</button>
    </div>
</form>
</div>