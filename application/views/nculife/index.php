<?php $this->beginWidget('system.web.widgets.CClipWidget', array('id' => 'script')); ?>
<script type="text/javascript">
jQuery(document).ready(function()
{
    setInterval(function()
    {
        jQuery('.life-picture').fadeOut(500).eq(jQuery.random(0, $('.life-picture').length - 1)).fadeIn(500);
    }, 1000);
});
</script>
<?php $this->endWidget();?>

<div id="life-container">
    <div id="life-head">
    -------------這裡是中大生活唷-----------
        <a id="life-test1" class="life-picture"></a>
        <a id="life-test2" class="life-picture"></a>
        <a id="life-test3" class="life-picture"></a>
    </div>
    <div id="life-body">
        <div id="linkk">  
            <ul class="life-index">
                <li>
                    <span>Live</span>
                    <ul class="life-indexs">
                        <li class="life-indexs-food" page="food">後門</li>
                        <li class="life-indexs-food" page="food2">校園美食</li>
                        <li class="life-indexs-food" page="food3">露天咖啡廳</li>
                        <li class="life-indexs-food" page="food4">學生餐廳</li>
                        <li class="life-indexs-food" page="food8">宵夜街</li>
                    </ul>
                </li>
                <li>
                    <span>Health</span>
                    <ul class="life-indexs">
                        <li class="life-indexs-health" page="health">衛保組</li>
                        <li class="life-indexs-health" page="health">特約醫院</li>
                        <li class="life-indexs-health" page="health">心理諮詢</li>
                    </ul>
                </li>
                <li>
                    <span>Car</span>
                    <ul class="life-indexs">
                        <li>腳踏車</li>
                        <li>汽機車</li>
                        <li>如何到中央</li>
                        <li>台聯大專車</li>
                    </ul>
                </li>
                <li>
                    <span>Sport</span>
                    <ul class="life-indexs">
                        <li>游泳池</li>
                        <li>依仁堂</li>
                        <li>球類場地</li>
                        <li>溜冰場</li>
                        <li>操場</li>
                    </ul>
                </li>
                <li>
                    <span>Outside</span>
                    <ul class="life-indexs">
                        <li>夜市</li>
                        <li>電影院</li>
                        <li>NOVA</li>
                        <li>KTV</li>
                    </ul>
                </li>
                <li>
                    <span>Live</span>
                    <ul class="life-indexs">
                        <li>銀行</li>
                        <li>體育用品</li>
                        <li>郵政服務</li>
                        <li>校園店家</li>
                        <li>校內影城</li>
                        <li>小超市</li>
                    </ul>
                </li>
                <li>
                    <span>House</span>
                    <ul class="life-indexs">
                        <li class="life-indexs-content">
                            <span>新生宿舍</span>
                                <ul class="life-indexs-inner">
                                    <li>男11舍</li>
                                    <li>男九舍</li>
                                    <li>男7舍</li>
                                    <li>男6舍</li>
                                    <li>男3舍</li>
                                    <li>女1~4舍</li>
                                </ul>
                        </li>
                        <li>宿網申請</li>
                        <li>宿舍冷氣</li>
                        <li>宿舍所需</li>
                        <li>宿舍規則</li>
                        <li>外宿專區</li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <div id="life-bottom">
        <div id="life-dialog">
            <div id="nculife-dh">
            </div><!-- end nculife-dh -->
            <div id="nculife-db">
                <div id="nculife-cv">
                    View
                </div><!-- end nculife-cv -->
                <div id="nculife-ct">
                    Text
                </div><!-- end nculife-ct -->
            </div><!-- end nculife-db -->
        </div><!-- end nculife-dialog -->
    </div>
</div>