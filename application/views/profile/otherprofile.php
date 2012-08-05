<div class="myprofile">
    <h4>基本資料</h4>
    <div id="profile-friend">
     <a href="<?php echo Yii::app()->createUrl('game/index', array('id' => $user->id)); ?>">
<?php $this->widget('Avatar', array(
    'id'        => $user->id //得到profile的id---觀看他人基本資料
)); ?>
    </a>
        <ul id="user-data-view">  
            <li>
                姓名：<?php echo $user->profile->name; ?>
            </li>
            <li>
                暱稱：<?php echo $user->profile->nickname; ?>
            </li>
            <li>
<?php if ( $user->profile->gender === 0 ): ?>
                性別：男孩兒
<?php else:?>
                性別：女孩兒
<?php endif; ?>    
            </li>
            <li>
                帳號：<?php echo $user->username; ?>      
            </li>
            <li>
                系所：<?php echo $user->profile->mydepartment->abbreviation; ?>
            </li>
            <li>
<?php if ( $user->profile->grade == 0 ) : ?>
                系級：嘿嘿!!這是秘密唷
<?php else : ?>
                系級：<?php echo $user->profile->grade; ?>年級
<?php endif; ?>
            </li>
            <li>
                畢業高中：<?php echo $user->profile->senior; ?>    
            </li>
            <li>
                生日：<?php echo $user->profile->birthday; ?>
            </li>
        </ul>
    </div>
    <div id="friend-chatting">
        <ul>
            <li>時間：</li>
            <li>對話內容：</li>
<?php foreach ( $messages as $message ) : ?>
            <li>
<?php echo $message['time']; ?>
            </li>
            <li class="friend-chatting-content">
           
<?php echo $message['message']; ?>
           
            </li>
<?php endforeach; ?>
        </ul>
    </div>
</div>
<?php if ( $friend_relation === Friend::IS_NOT_FRIEND ) : ?>
<form action="<?php echo Yii::app()->createUrl('friends/makefriends'); ?>" method="POST" >
    <input type="hidden" name="token" value="<?php echo Yii::app()->security->getToken(); ?>" />
    <button type="submit" id="add-new-friends">新增好友</button>
</form>
<?php elseif ( $friend_relation === Friend::IS_SEND_REQUEST ) : ?>
<button id="friend_request">已送出邀請！</button>
<?php elseif( $friend_relation === Friend::IS_FRIEND ): ?>
<button id="is_friend">**朋友</button>
<?php endif; ?>
<button class="button-viewProfile-back">BACK</button>