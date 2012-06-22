<div id="index_calendar">行事曆</div>
<div id="index_container">
    <div id="index_marquee">
        <ul>
<?php foreach ( $marquees as $marquee ) : ?>
            <li><?php echo $marquee->message; ?></li>
<?php endforeach; ?>
        </ul>
        <a href="<?php echo $this->createUrl('site/marquee'); ?>" title="編輯">編輯</a>
    </div>
    <div id="index_news_box" class="index_box">最新消息</div>
    <div id="index_forums_box" class="index_box">最新論壇</div>
</div>
