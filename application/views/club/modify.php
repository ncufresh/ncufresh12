<h1>社團資料修改</h1>
<form action="<?php echo Yii::app()->createUrl('club/modify',array('id'=>$id))?>" method="post">
      <div class = "club-modify-table">   
       <dl>
            <dt>
                <label for="introduction" >簡介:</label>
            </dt>
            <dd>
                <textarea id="introduction" name="club[introduction]" type="text" cols="50" rows="10"><?php if ( empty($club['introduction']) ) echo $data->introduction; ?></textarea>
            </dd>
        </dl>
        <div class="modify-table">
            <h3>社長:</h3>
            <dl>    
                <dt>
                    <label for="leader" >姓名:</label>
                </dt>
                <dd>
                    <input id="leader" name="club[leader]" type="text" size="10" value="<?php if ( empty($club['leader']) ) echo $data->leader; ?>"/>
                </dd>
            </dl>
            <dl>
                <dt>
                    <label for="leader_phone" >手機:</label>
                </dt>
                <dd>
                    <input id="leader_phone" name="club[leader_phone]" type="text" size="15" value="<?php if ( empty($club['leader_phone']) ) echo $data->leader_phone; ?>"/>
                </dd>
            </dl>
            <dl>
                <dt>
                    <label for="leader_email" >E-mail:</label>
                </dt>
                <dd>
                    <input id="leader_email" name="club[leader_email]" type="text" size="30" value="<?php if ( empty($club['leader_email']) ) echo $data->leader_e_mail; ?>"/>
                </dd>
                <dd>(e-mail)</dd>
            </dl>
            <dl>
                <dt>
                    <label for="leader_ID" >二進位ID:</label>
                </dt>
                <dd>
                    <input id="leader_ID" name="club[leader_ID]" type="text" size="15" value="<?php if ( empty($club['leader_ID']) ) echo $data->leader_binary_id; ?>"/>
                </dd>
            </dl>
            <dl>
                <dt>
                    <label for="leader_msn" >MSN:</label>
                </dt>
                <dd>
                    <input id="leader_msn" name="club[leader_msn]" type="text" size="30" value="<?php if ( empty($club['leader_msn']) ) echo $data->leader_msn; ?>"/>
                </dd>
                <dd>(MSN)</dd>
            </dl>
        </div>
        <div class="modify-table">
            <h3>副社長:</h3>
            <dl>
                <dt>
                    <label for="viceleader" >姓名:</label>
                </dt>
                <dd>
                    <input id="viceleader" name="club[viceleader]" type="text" size="10" value="<?php if ( empty($club['viceleader']) ) echo $data->viceleader; ?>"/>
                </dd>
            </dl>
            <dl>
                <dt>
                    <label for="viceleader_phone" >手機:</label>
                </dt>
                <dd>
                    <input id="viceleader_phone" name="club[viceleader_phone]" type="text" size="15" value="<?php if ( empty($club['viceleader_phone']) ) echo $data->viceleader_phone; ?>"/>
                </dd>
            </dl>
            <dl>
                <dt>
                    <label for="viceleader_email" >E-mail:</label>
                </dt>
                <dd>
                    <input id="viceleader_email" name="club[viceleader_email]" type="text" size="30" value="<?php if ( empty($club['viceleader_email']) ) echo $data->viceleader_e_mail; ?>"/>
                </dd>
                <dd>(e-mail)</dd>
            </dl>
            <dl>
                <dt>
                    <label for="viceleader_ID" >二進位ID:</label>
                </dt>
                <dd>
                    <input id="viceleader_ID" name="club[viceleader_ID]" type="text" size="15" value="<?php if ( empty($club['viceleader_ID']) ) echo $data->viceleader_binaryid; ?>"/>
                </dd>
            </dl>
            <dl>
                <dt>
                    <label for="viceleader_msn" >MSN:</label>
                </dt>
                <dd>
                    <input id="viceleader_msn" name="club[viceleader_msn]" type="text" size="30" value="<?php if ( empty($club['viceleader_msn']) ) echo $data->viceleader_msn; ?>"/>
                </dd>
                <dd>(MSN)</dd>
            </dl>
        </div>
        <dl class="club-web">
            <dt>
                <label for="web" >網站:</label>
            </dt>
            <dd>
                <input id="web" name="club[web]" type="text" size="100" value="<?php if ( empty($club['web']) ) echo $data->club_web; ?>"/>
            </dd>
        </dl>
        <input type="hidden" name="token" value="<?php echo Yii::app()->security->getToken(); ?>" />
    </div>
        <button type="submit" >儲存</button>
        <button class="back" >回上一頁</button>
</form>