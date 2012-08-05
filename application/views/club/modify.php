<h4>社團資料修改</h4>
<form method="POST">
    <div class="modify">
        <dl>
            <dt>
                <label for="form-club-introduction">簡介</label>
            </dt>
            <dd>
<?php if ( isset($data->introduction) ) : ?>
                <textarea id="form-club-introduction" name="club[introduction]"><?php echo $data->introduction; ?></textarea>
<?php else : ?>
                <textarea id="form-club-introduction" name="club[introduction]"></textarea>
<?php endif; ?>
                <span>可以填寫最多五百字的社團簡介！</span>
            </dd>
        </dl>
        <div class="modify-table">
            <h5>社長</h5>
            <dl>
                <dt>
                    <label for="form-club-leader">姓名</label>
                </dt>
                <dd>
<?php if ( isset($data->leader) ) : ?>
                    <input id="form-club-leader" name="club[leader]" type="text" value="<?php echo $data->leader; ?>" />
<?php else : ?>
                    <input id="form-club-leader" name="club[leader]" type="text" />
<?php endif; ?>
                    <span>社長名字</span>
                </dd>
            </dl>
            <dl>
                <dt>
                    <label for="form-club-leader-phone">手機</label>
                </dt>
                <dd>
<?php if ( isset($data->leader_phone) ) : ?>
                    <input id="form-club-leader-phone" name="club[leader_phone]" type="text" value="<?php echo $data->leader_phone; ?>" />
<?php else : ?>
                    <input id="form-club-leader-phone" name="club[leader_phone]" type="text" />
<?php endif; ?>
                    <span>社長手機</span>
                </dd>
            </dl>
            <dl>
                <dt>
                    <label for="form-club-leader-email">Email</label>
                </dt>
                <dd>
<?php if ( isset($data->leader_email) ) : ?>
                    <input id="form-club-leader-email" name="club[leader_email]" type="text" value="<?php echo $data->leader_email; ?>" />
<?php else : ?>
                    <input id="form-club-leader-email" name="club[leader_email]" type="text" />
<?php endif; ?>
                    <span>社長聯絡信箱</span>
                </dd>
            </dl>
            <dl>
                <dt>
                    <label for="form-club-leader-binary">二進位ID</label>
                </dt>
                <dd>
<?php if ( isset($data->leader_binary) ) : ?>
                    <input id="form-club-leader-binary" name="club[leader_binary]" type="text" value="<?php echo $data->leader_binary; ?>" />
<?php else : ?>
                    <input id="form-club-leader-binary" name="club[leader_binary]" type="text" />
<?php endif; ?>
                    <span>社長二進位</span>
                </dd>
            </dl>
            <dl>
                <dt>
                    <label for="form-club-leader-msn">MSN</label>
                </dt>
                <dd>
<?php if ( isset($data->leader_msn) ) : ?>
                    <input id="form-club-leader-msn" name="club[leader_msn]" type="text" value="<?php echo $data->leader_msn; ?>" />
<?php else : ?>
                    <input id="form-club-leader-msn" name="club[leader_msn]" type="text" />
<?php endif; ?>
                    <span>社長MSN</span>
                </dd>
            </dl>
        </div>
        <div class="modify-table">
            <h5>副社長</h5>
            <dl>
                <dt>
                    <label for="form-club-viceleader">姓名</label>
                </dt>
                <dd>
<?php if ( isset($data->viceleader) ) : ?>
                    <input id="form-club-viceleader" name="club[viceleader]" type="text" value="<?php echo $data->viceleader; ?>" />
<?php else : ?>
                    <input id="form-club-viceleader" name="club[viceleader]" type="text" />
<?php endif; ?>
                    <span>副社長名字</span>
                </dd>
            </dl>
            <dl>
                <dt>
                    <label for="form-club-viceleader-phone">手機</label>
                </dt>
                <dd>
<?php if ( isset($data->viceleader_phone) ) : ?>
                    <input id="form-club-viceleader-phone" name="club[viceleader_phone]" type="text" value="<?php echo $data->viceleader_phone; ?>" />
<?php else : ?>
                    <input id="form-club-viceleader-phone" name="club[viceleader_phone]" type="text" />
<?php endif; ?>
                    <span>副社長手機</span>
                </dd>
            </dl>
            <dl>
                <dt>
                    <label for="form-club-viceleader-email">Email</label>
                </dt>
                <dd>
<?php if ( isset($data->viceleader_email) ) : ?>
                    <input id="form-club-viceleader-email" name="club[viceleader_email]" type="text" value="<?php echo $data->viceleader_email; ?>" />
<?php else : ?>
                    <input id="form-club-viceleader-email" name="club[viceleader_email]" type="text" />
<?php endif; ?>
                    <span>副社長聯絡信箱</span>
                </dd>
            </dl>
            <dl>
                <dt>
                    <label for="form-club-viceleader-binary">二進位ID</label>
                </dt>
                <dd>
<?php if ( isset($data->viceleader_binary) ) : ?>
                    <input id="form-club-viceleader-binary" name="club[viceleader_binary]" type="text" value="<?php echo $data->viceleader_binary; ?>" />
<?php else : ?>
                    <input id="form-club-viceleader-binary" name="club[viceleader_binary]" type="text" />
<?php endif; ?>
                    <span>副社長二進位</span>
                </dd>
            </dl>
            <dl>
                <dt>
                    <label for="form-club-viceleader-msn">MSN</label>
                </dt>
                <dd>
<?php if ( isset($data->viceleader_msn) ) : ?>
                    <input id="form-club-viceleader-msn" name="club[viceleader_msn]" type="text" value="<?php echo $data->viceleader_msn; ?>" />
<?php else : ?>
                    <input id="form-club-viceleader-msn" name="club[viceleader_msn]" type="text" />
<?php endif; ?>
                    <span>副社長MSN</span>
                </dd>
            </dl>
        </div>
        <dl class="web">
            <dt>
                <label for="form-club-website">網站</label>
            </dt>
            <dd>
<?php if ( isset($data->website) ) : ?>
                <input id="form-club-website" name="club[website]" type="text" value="<?php echo $data->website; ?>" />
<?php else : ?>
                <input id="form-club-website" name="club[website]" type="text" />
<?php endif; ?>
                <span>可以填寫社團網頁！</span>
            </dd>
        </dl>
        <div class="buttons">
            <input type="hidden" name="token" value="<?php echo Yii::app()->security->getToken(); ?>" />
            <button type="submit">儲存</button>
            <button type="button" class="back">回上一頁</button>
        </div>
    </div>
</form>