<div id="index_calendar">行事曆</div>
<div id="index_container">
    <ul id="marquee">
        <span></span>
<?php foreach ( $marquees as $marquee ) : ?>
        <li><?php echo $marquee->message; ?></li>
<?php endforeach; ?>
        <a href="<?php echo $this->createUrl('site/marquee'); ?>" title="編輯">編輯</a>
    </ul>
    <div id="index_news_box" class="index_box">
        <h4>最新消息</h4>
    </div>
    <div id="index_forums_box" class="index_box">
        <h4>最新論壇</h4>
    </div>
</div>
