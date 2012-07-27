<h1>MyMessage_Reply</h1>
<div class="profile-message-reply" >
<table class="profile-message-reply">
    <tr>
        <td class="form-friends-sort-title">標題</td>
        <td><!--echo 該篇文章標題--></td>
    </tr>
    <tr>
        <td class="form-friends-sort-title">內容</td>
        <td><!--echo 該篇文章內容--></td>
    </tr>
</table>
<div>
    <span class="form-friends-sort-title" >回覆</span>
</div>
   <!-- <table class="profile-message-reply">

    </table>
<div>
    <span class="form-friends-sort-title" >推文</span>
</div>
    <table class="profile-message-reply">

    </table>
    <form enctype="multipart/form-data" action=" echo Yii::app()->createUrl('forum/comment'); ?>" method="POST"> 
    <input type="text" name="comment[content]" />
    <input type="hidden" name="comment[aid]" value=" echo 該篇文章ID; ?>" />
    <input type="submit" value="推文" />
    <input type="hidden" name="token" value="echo Yii::app()->security->getToken(); ?>" />
    </form>-->

</div>