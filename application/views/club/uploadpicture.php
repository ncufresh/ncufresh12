<form method="POST" enctype="multipart/form-data" action="<?php echo Yii::app()->createUrl('club/uploadpicture', array('id' => $id))?>" >
    <h3>上傳圖片</h3>
    <input type="file" name="pictures[0]" />
    <input type="file" name="pictures[1]" />
    <input type="file" name="pictures[2]" />
    <input type="file" name="pictures[3]" />
    <input name="token" value="<?php echo Yii::app()->security->getToken(); ?>" type="hidden" />
    <button type="submit">上傳</button>
</form>