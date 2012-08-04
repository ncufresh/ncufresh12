<?php $this->beginWidget('system.web.widgets.CClipWidget', array('id' => 'script')); ?>
<script type="text/javascript">
jQuery(document).ready(function()
{
    jQuery('#marquee').marquee();
    jQuery('#index-calendar div').calendar($.configures.calendarEventsUrl);
});
</script>
<?php $this->endWidget();?>

<div id="index-calendar">
    <div>
    </div>
</div>

<div id="index-container">
    <ul id="marquee">
        <span></span>
<?php foreach ( $marquees as $marquee ) : ?>
        <li><?php echo $marquee->message; ?></li> 
<?php endforeach; ?>
<?php if ( Yii::app()->user->getIsAdmin() ) : ?>
        <a href="<?php echo $this->createUrl('site/marquee'); ?>" title="編輯">編輯</a>
<?php endif; ?>
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
                        <?php echo $article->created; ?>
                    </td>
                </tr>
<?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2">
                        [<a href="<?php echo Yii::app()->createUrl('forum/forum', array('id' => 1)); ?>" title="檢視所有文章">檢視所有文章</a>]
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>