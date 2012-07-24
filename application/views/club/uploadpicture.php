<form method="post" enctype="multipart/form-data" action="<?php echo Yii::app()->createUrl('club/uploadpicture',array('id'=>$id))?>" >
    <h3>上傳圖片1</h3>
    <input type="file" style="width:600px;height:50px;" name="picture1"/>  <button name = "pic1" style="width:100px;height:30px;" type="submit">上傳</button>
    <br/>
    <?php echo $status1?>
    <br/>
</form>
<form method="post" enctype="multipart/form-data" action="<?php echo Yii::app()->createUrl('club/uploadpicture',array('id'=>$id))?>" >
    <h3>上傳圖片2</h3>
    <input type="file" style="width:600px;height:50px;" name="picture2"/>  <button name = "pic2" style="width:100px;height:30px;" type="submit">上傳</button>
    <br/>
    <?php echo $status2?>
    <br/>
</form>
<form method="post" enctype="multipart/form-data" action="<?php echo Yii::app()->createUrl('club/uploadpicture',array('id'=>$id))?>" >
    <h3>上傳圖片3</h3>
    <input type="file" style="width:600px;height:50px;" name="picture3"/>  <button name = "pic3" style="width:100px;height:30px;" type="submit">上傳</button>
    <br/>
    <?php echo $status3?>
    <br/>
</form>
<form method="post" enctype="multipart/form-data" action="<?php echo Yii::app()->createUrl('club/uploadpicture',array('id'=>$id))?>" >
    <h3>上傳圖片4</h3>
    <input type="file" style="width:600px;height:50px;" name="picture4"/>  <button name = "pic4" style="width:100px;height:30px;" type="submit">上傳</button>
    <br/>
    <?php echo $status4?>
    <br/>
</form>
<form method="post" enctype="multipart/form-data" action="<?php echo Yii::app()->createUrl('club/uploadpicture',array('id'=>$id))?>" >
    <button type="submit" style="width:600px;height:50px;" name="return">上一頁</button>
    <br/>
    <br/>
</form>