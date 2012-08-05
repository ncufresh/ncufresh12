<h4>論壇回覆</h4>
<div class="profile-message-allmessages">
    <div id="my-all-messages">
        <table>
            <tr>
                <th>標題</th>
                <th>時間</th>
            </tr>
<?php foreach ( $articles as $article ) : ?>
            <tr>
                <td>
                   <a href="<?php echo $article->getUrl(); ?>"><?php echo $article->title ; ?></a>
                </td>
                <td><?php echo $article->created; ?></td>
            </tr>
<?php endforeach; ?>
        </table>
    </div>
</div>
<a href="<?php echo Yii::app()->createUrl('site/index'); ?>" class="button-back">BACK</a>