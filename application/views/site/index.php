<div id="index-calendar">行事曆</div>
<div id="index-container">
    <ul id="marquee">
        <span></span>
<?php foreach ( $marquees as $marquee ) : ?>
        <li><?php echo $marquee->message; ?></li>
<?php endforeach; ?>
        <a href="<?php echo $this->createUrl('site/marquee'); ?>" title="編輯">編輯</a>
    </ul>
    <div class="index-latest-box index-box">
        <h4>最新消息</h4>
        <table>
            <tbody>
<?php foreach ( $latests as $latest ) : ?>
                <tr>
                    <td>
                        <a href="<?php echo $latest->url; ?>" title="<?php echo $latest->title; ?>"><?php echo $latest->title; ?></a>
                    </td>
                    <td class="time">
                        <?php echo $latest->updated; ?>
                    </td>
                </tr>
<?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2">
                        [<a href="<?php echo Yii::app()->createUrl('news/index'); ?>" title="檢視所有公告">檢視所有公告</a>]
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
    <div class="index-forums-box index-box">
        <h4>最新論壇</h4>
        <table>
            <tbody>
<?php foreach ( $articles as $article ) : ?>
                <tr>
                    <td>
                        <a href="<?php echo $article->url; ?>" title="<?php echo $article->title; ?>"><?php echo $article->title; ?></a>
                    </td>
                    <td class="time">
                        <?php echo $article->updated; ?>
                    </td>
                </tr>
<?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2">
                        [<a href="<?php echo Yii::app()->createUrl('forums/index'); ?>" title="檢視所有文章">檢視所有文章</a>]
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
