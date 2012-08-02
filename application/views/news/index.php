<div id="lastest-news-wrap">
    <div class="header">
        <h4>最新消息</h4>
        <?php $this->widget('Pager', array(
            'url'       => 'news/index',
            'pager'     => $page_status
        )); ?>
    </div>
    <div class="indexes">
        <?php foreach ( $news as $entry ) : ?>
        <div class="row">
            <div class="line"></div>
            <div class="left"><?php echo CHtml::link($entry->title, $entry->url);?></div>
            <div class="right"><?php echo $entry->updated; ?></div>
            
        </div>
        <?php endforeach ?>
    </div>
    <div class="footer">
        <?php $this->widget('Pager', array(
            'url'       => 'news/index',
            'pager'     => $page_status
        )); ?>
        <a class="news-back-link" href="<?php echo Yii::app()->baseUrl;?>" title="回首頁">[回首頁]</a>
        <?php if ( Yii::app()->user->getIsAdmin() ) : ?>
        <a class="news-admin-link" href="<?php echo Yii::app()->createUrl('news/admin'); ?>" title="管理文章">[管理文章]</a>
        <?php endif; ?>
    </div>
</div>
