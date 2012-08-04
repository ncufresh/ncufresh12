<div id="club-<?php echo $data->id; ?>">
    <div class="underpicture">
        <h4 id="calendar-button">行事曆</h4>
        <div>
            <div id="calendar">
            <div>
            </div>
            </div>
        </div>
        <ul id="menu-items">
            <li class="picture">
<?php if( file_exists( Yii::app()->basePath . '/../files/clubs/' . $id  . '/1.jpg' ) ) : ?>
                <a href="<?php echo Yii::app()->baseUrl . '/files/clubs/' . $id . '/1.jpg'; ?>" title="<?php echo $data->name; ?> 照片1">
                <img src="<?php echo Yii::app()->baseUrl . '/files/clubs/' . $id . '/1.jpg'; ?>" />
                </a>
<?php endif; ?>
            </li>
            <li class="picture">
<?php if ( file_exists(Yii::app()->basePath . '/../files/clubs/' . $id  . '/2.jpg') ) : ?>
                <a href="<?php echo Yii::app()->baseUrl . '/files/clubs/' . $id . '/2.jpg'; ?>" title="<?php echo $data->name; ?> 照片2">
                <img src="<?php echo Yii::app()->baseUrl . '/files/clubs/' . $id . '/2.jpg'; ?>"/>
                </a> 
<?php endif; ?>
            </li>
            <li class="picture">
<?php if ( file_exists(Yii::app()->basePath . '/../files/clubs/' . $id  . '/3.jpg') ) : ?>
                <a href="<?php echo Yii::app()->baseUrl . '/files/clubs/' . $id . '/3.jpg'; ?>" title="<?php echo $data->name; ?> 照片3">
                <img src="<?php echo Yii::app()->baseUrl . '/files/clubs/' . $id . '/3.jpg'; ?>"/>
                </a> 
<?php endif; ?>
            </li>
        </ul>
    </div>
    <div class="display-head" id="head-<?php echo $data->category; ?>">
<?php if ( $is_subscript == false ): ?>
        <a href="<?php echo Yii::app()->createUrl('calendar/subscriptfromclub/', array('club_id'=>$id)) ?>" title="訂閱">訂閱</a>
<?php elseif ( $is_subscript == true ): ?>
        <a href="<?php echo Yii::app()->createUrl('calendar/cancelsubscriptfromclub/', array('club_id'=>$id)) ?>" title="訂閱">取消訂閱</a>
<?php endif; ?>     
<?php if ( Club::model()->getIsAdmin($id) ) : ?>     
        <a href="<?php echo Yii::app()->createUrl('club/modify/', array('id'=>$id)); ?>" title="修改">修改</a>
        <a href="<?php echo Yii::app()->createUrl('club/uploadpicture/', array('id'=>$id)); ?>" title="上傳圖片">上傳圖片</a>
<?php endif; ?>  
<?php if ( Club::model()->getIsMaster($id) ) : ?>
        <a href="<?php echo Yii::app()->createUrl('calendar/club/', array('id'=>$id)); ?>" title="修改行事曆">修改行事曆</a>
<?php endif; ?>
    <h4><?php echo $data->name; ?></h4>    
    </div>    
    <div class="display" id="club-<?php echo $data->category; ?>">
        <div class="title">簡介:</div>
        <div class="item">
<?php echo $data->introduction; ?>
        </div>
        <div class="title"><?php if ( $data->category !=2 ) : ?>社長:<?php else : ?>系代:<?php endif; ?></div>
        <div class="item">
<?php echo $data->leader; ?>
        </div>
        <div class="title">手機:</div>
        <div class="item">
<?php echo $data->leader_phone; ?>
        </div>
        <div class="title">E-mail:</div>
        <div class="item">
<?php echo $data->leader_email; ?>
        </div>
        <div class="title">二進位ID:</div>
        <div class="item">
<?php echo $data->leader_binary; ?>
        </div>
        <div class="title">MSN:</div>
        <div class="item">
<?php echo $data->leader_msn; ?>
        </div>
        <div class="title"><?php if ( $data->category !=2 ) : ?>副社長:<?php else : ?>副系代:<?php endif; ?></div>
        <div class="item">
<?php echo $data->viceleader; ?>
        </div>
        <div class="title">手機:</div>
        <div class="item">
<?php echo $data->viceleader_phone; ?>
        </div>
        <div class="title">E-mail:</div>
        <div class="item">
<?php echo $data->viceleader_email; ?>
        </div>
        <div class="title">二進位ID:</div>
        <div class="item">
<?php echo $data->viceleader_binary; ?>
        </div>
        <div class="title">MSN:</div>
        <div class="item">
<?php echo $data->viceleader_msn; ?>
        </div> 
<?php if ( $data->website != null ) : ?>
        <div class="title">網站:</div>
        <div class="item">
        <a href="<?php echo $data->website; ?>"><?php echo $data->website; ?></a>
        </div>
<?php endif; ?>
         <a class="back"><div class="back-button" id="back<?php echo $data->category; ?>"></div></a>
    </div>
    <div class="display-bottom" id="bottom-<?php echo $data->category; ?>">
    </div>
</div>