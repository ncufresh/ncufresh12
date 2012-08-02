<h4>社團資料修改</h4>
<form action="<?php echo Yii::app()->createUrl('club/modify', array('id'=>$id)); ?>" method="post">
      <div class = "club-modify-table">   
       <dl>
            <dt>
                <label for="introduction" >簡介:</label>
            </dt>
            <dd>
                <textarea id="introduction" name="club[introduction]" type="text" cols="50" rows="15"><?php if ( empty($club['introduction']) ) echo $data->introduction; ?></textarea>
            </dd>
        </dl>
        <div class="modify-table">
            <h5>社長:</h5>
            <dl>    
                <dt>
                    <label for="leader" >姓名:</label>
                </dt>
                <dd>
                    <input id="leader" name="club[leader]" type="text" value="<?php if ( empty($club['leader']) ) echo $data->leader; ?>"/>
                </dd>
            </dl>
            <dl>
                <dt>
                    <label for="leader_phone" >手機:</label>
                </dt>
                <dd>
                    <input id="leader_phone" name="club[leader_phone]" type="text" value="<?php if ( empty($club['leader_phone']) ) echo $data->leader_phone; ?>"/>
                </dd>
            </dl>
            <dl>
                <dt>
                    <label for="leader_email" >E-mail:</label>
                </dt>
                <dd>
                    <input id="leader_email" name="club[leader_email]" type="text" value="<?php if ( empty($club['leader_email']) ) echo $data->leader_email; ?>"/>
                </dd>
                <dd>(e-mail)</dd>
            </dl>
            <dl>
                <dt>
                    <label for="leader_binary" >二進位ID:</label>
                </dt>
                <dd>
                    <input id="leader_binary" name="club[leader_binary]" type="text" value="<?php if ( empty($club['leader_binary']) ) echo $data->leader_binary; ?>"/>
                </dd>
            </dl>
            <dl>
                <dt>
                    <label for="leader_msn" >MSN:</label>
                </dt>
                <dd>
                    <input id="leader_msn" name="club[leader_msn]" type="text" value="<?php if ( empty($club['leader_msn']) ) echo $data->leader_msn; ?>"/>
                </dd>
                <dd>(MSN)</dd>
            </dl>
        </div>
        <div class="modify-table">
            <h5>副社長:</h5>
            <dl>
                <dt>
                    <label for="viceleader" >姓名:</label>
                </dt>
                <dd>
                    <input id="viceleader" name="club[viceleader]" type="text" value="<?php if ( empty($club['viceleader']) ) echo $data->viceleader; ?>"/>
                </dd>
            </dl>
            <dl>
                <dt>
                    <label for="viceleader_phone" >手機:</label>
                </dt>
                <dd>
                    <input id="viceleader_phone" name="club[viceleader_phone]" type="text" value="<?php if ( empty($club['viceleader_phone']) ) echo $data->viceleader_phone; ?>"/>
                </dd>
            </dl>
            <dl>
                <dt>
                    <label for="viceleader_email" >E-mail:</label>
                </dt>
                <dd>
                    <input id="viceleader_email" name="club[viceleader_email]" type="text" value="<?php if ( empty($club['viceleader_email']) ) echo $data->viceleader_email; ?>"/>
                </dd>
                <dd>(e-mail)</dd>
            </dl>
            <dl>
                <dt>
                    <label for="viceleader_binary" >二進位ID:</label>
                </dt>
                <dd>
                    <input id="viceleader_binary" name="club[viceleader_binary]" type="text" value="<?php if ( empty($club['viceleader_binary']) ) echo $data->viceleader_binary; ?>"/>
                </dd>
            </dl>
            <dl>
                <dt>
                    <label for="viceleader_msn" >MSN:</label>
                </dt>
                <dd>
                    <input id="viceleader_msn" name="club[viceleader_msn]" type="text" value="<?php if ( empty($club['viceleader_msn']) ) echo $data->viceleader_msn; ?>"/>
                </dd>
                <dd>(MSN)</dd>
            </dl>
        </div>
        <dl class="club-web">
            <dt>
                <label for="website" >網站:</label>
            </dt>
            <dd>
                <input id="website" name="club[website]" type="text" value="<?php if ( empty($club['website']) ) echo $data->website; ?>"/>
            </dd>
        </dl>
        <input type="hidden" name="token" value="<?php echo Yii::app()->security->getToken(); ?>" />
    </div>
        <button type="submit" >儲存</button>
        <button type="button" class="back" >回上一頁</button>
</form>