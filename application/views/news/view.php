<div class="news-view">
    <div class="header">
        <h2><?php echo $news->title; ?></h2>
        <span class="time">時間：<?php echo $news->updated; ?></span>
        <span class="author">作者：<?php echo $news->author->username; ?></span>
        <?php if ( Yii::app()->user->getIsAdmin() ) : ?>
            <a class="edit" href="<?php echo Yii::app()->createUrl('news/update', array('id' => $news->id)); ?>" title="編輯文章">編輯文章</a>
        <?php endif;?>
    </div>
    <div class="content">
        <p class="text"><?php echo $news->content; ?></p>
        <div class="appendix">
            <?php if( ! empty($files) || ! empty($news->urls) ) : ?>
                <label>附加檔案與連結</label>
            <?php endif; ?>
            <?php foreach ( $files as $filename => $file_url ) : ?>
                <a href="<?php echo $file_url; ?>" title="<?php echo $filename; ?>"><?php echo $filename; ?></a>
            <?php endforeach; ?>
            <?php foreach ( $news->urls as $url ) : ?>
                <a href="<?php echo $url->link; ?>" title="<?php echo $url->name; ?>"><?php echo $url->name; ?></a>
            <?php endforeach; ?>
            <a class="news-back-link" href="#" title="返回">返回</a>
        </div>
    </div>
   
</div>
