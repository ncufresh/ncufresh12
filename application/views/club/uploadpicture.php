<form method="POST" enctype="multipart/form-data" action="<?php echo Yii::app()->createUrl('club/uploadpicture', array('id' => $id)); ?>" >
    <h3>上傳圖片</h3>
    <dl class="file">
        <dt>
            <label for="form-club-file">照片</label>
        </dt>
        <dd>
            <input type="file" name="pictures[0]" />
            <span>請選擇一張照片放在第一個位置，注意：如果第一張照片已經上傳過了，這次上傳將會覆蓋原本的照片。</span>
        </dd>
    </dl>
    <dl class="file">
        <dt>
            <label for="form-club-file">照片</label>
        </dt>
        <dd>
            <input type="file" name="pictures[1]" />
            <span>請選擇一張照片放在第二個位置，注意：如果第二張照片已經上傳過了，這次上傳將會覆蓋原本的照片。</span>
        </dd>
    </dl>
    <dl class="file">
        <dt>
            <label for="form-club-file">照片</label>
        </dt>
        <dd>
            <input type="file" name="pictures[2]" />
            <span>請選擇一張照片放在第三個位置，注意：如果第三張照片已經上傳過了，這次上傳將會覆蓋原本的照片。</span>
        </dd>
    </dl>
    <div class="buttons">
        <input name="token" value="<?php echo Yii::app()->security->getToken(); ?>" type="hidden" />
        <button type="submit">上傳</button>
    </div>
</form>