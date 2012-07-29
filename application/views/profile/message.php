<h1>MyMessage</h1>
<div class="profile-message-allmessages">
    <div class="my-all-messages">
        <table>
            <tr>
                <th>標題</th>
                <th>時間</th>
            </tr>
<?php foreach ( $articles as $article ) : ?>
            <tr>
                <td>
                    <a href="<?php echo Yii::app()->createUrl('profile/messagereply', array('aid'=> $article->id)); ?>" class="mymessage-title">
<?php echo $article->title ; ?>
                    </a>
                </td>
                <td>
<?php echo Yii::app()->format->datetime($article->create_time); ?>
                </td>
            </tr>
<?php endforeach; ?>
        </table>
    </div>
</div>
<button onClick= "history.back()" >BACK</button>