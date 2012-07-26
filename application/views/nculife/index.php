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
    </div>
    <div id="life-body">
        <div id="linkk">  
            <ul class="life-index">
                <li>
                    <span>Health</span>
                    <ul class="life-indexs">
                        <li class="life-indexs-content">
                            <span>衛保組</span>
                                <ul class="life-indexs-inner">
                                    <li page="health" tab="1">衛保組</li>
                                </ul>
                        </li>
                        <li class="life-indexs-content">
                            <span>特約醫院</span>
                                <ul class="life-indexs-inner">
                                    <li page="health" tab="2">特約醫院</li>
                                </ul>
                        </li>
                        <li class="life-indexs-content">
                            <span>心理諮商</span>
                                <ul class="life-indexs-inner">
                                    <li page="health" tab="3">心理諮商</li>
                                </ul>
                        </li>
                    </ul>
                </li>
                <li>
                    <span>Live</span>
                    <ul class="life-indexs">
                        <li class="life-indexs-content">
                            <span>所需用品</span>
                                <ul class="life-indexs-inner">
                                    <li>所需用品</li>
                                </ul>
                        </li>
                        <li class="life-indexs-content">
                            <span>郵件招領</span>
                                <ul class="life-indexs-inner">
                                    <li>郵件招領</li>
                                </ul>
                        </li>
                        <li class="life-indexs-content">
                            <span>新生宿舍</span>
                                <ul class="life-indexs-inner">
                                    <li>女一舍</li>
                                    <li>女四舍</li>
                                    <li>男三舍</li>
                                    <li>男七舍</li>
                                    <li>男九舍</li>
                                    <li>男十一舍</li>
                                </ul>
                        </li>
                        <li class="life-indexs-content">
                            <span>銀行</span>
                                <ul class="life-indexs-inner">
                                    <li>銀行</li>
                                </ul>
                        </li>
                        <li class="life-indexs-content">
                            <span>郵政服務</span>
                                <ul class="life-indexs-inner">
                                    <li>郵件快遞</li>
                                    <li>郵局</li>
                                </ul>
                        </li>
                    </ul>
                </li>
                <li>
                    <span>traffic</span>
                    <ul class="life-indexs">
                        <li class="life-indexs-content">
                            <span>腳踏車</span>
                                <ul class="life-indexs-inner">
                                    <li>腳踏車</li>
                                </ul>
                        </li>
                        <li class="life-indexs-content">
                            <span>汽機車</span>
                                <ul class="life-indexs-inner">
                                    <li>汽機車</li>
                                </ul>
                        </li>
                        <li class="life-indexs-content">
                            <span>台聯大專車</span>
                                <ul class="life-indexs-inner">
                                    <li>台聯大專車</li>
                                </ul>
                        </li>
                        <li class="life-indexs-content">
                            <span>如何到中央</span>
                                <ul class="life-indexs-inner">
                                    <li>自行開車</li>
                                    <li>高鐵</li>
                                    <li>火車</li>
                                    <li>客運</li>
                                    <li>公車</li>
                                </ul>
                        </li>
                    </ul>
                </li>
                <li>
                    <span>Play</span>
                    <ul class="life-indexs">
                        <li class="life-indexs-content">
                            <span>Movie</span>
                                <ul class="life-indexs-inner">
                                    <li>Movie</li>
                                </ul>
                        </li>
                        <li class="life-indexs-content">
                            <span>KTV</span>
                                <ul class="life-indexs-inner">
                                    <li>KTV</li>
                                </ul>
                        </li>
                        <li class="life-indexs-content">
                            <span>NOVA</span>
                                <ul class="life-indexs-inner">
                                    <li>NOVA</li>
                                </ul>
                        </li>
                        <li class="life-indexs-content">
                            <span>夜市</span>
                                <ul class="life-indexs-inner">
                                    <li>夜市</li>
                                </ul>
                        </li>
                    </ul>
                </li>
                <li>
                    <span>School</span>
                    <ul class="life-indexs">
                        <li class="life-indexs-content">
                            <span>圖美輸出中心</span>
                                <ul class="life-indexs-inner">
                                    <li>圖美輸出中心</li>
                                </ul>
                        </li>
                        <li class="life-indexs-content">
                            <span>校園影印</span>
                                <ul class="life-indexs-inner">
                                    <li>校園影印</li>
                                </ul>
                        </li>
                        <li class="life-indexs-content">
                            <span>校園劇場</span>
                                <ul class="life-indexs-inner">
                                    <li>校園劇場</li>
                                </ul>
                        </li>
                        <li class="life-indexs-content">
                            <span>校園影城</span>
                                <ul class="life-indexs-inner">
                                    <li>校園影城</li>
                                </ul>
                        </li>
                        <li class="life-indexs-content">
                            <span>印象美髮</span>
                                <ul class="life-indexs-inner">
                                    <li>印象美髮</li>
                                </ul>
                        </li>
                        <li class="life-indexs-content">
                            <span>好視康眼鏡</span>
                                <ul class="life-indexs-inner">
                                    <li>好視康眼鏡</li>
                                </ul>
                        </li>
                        <li class="life-indexs-content">
                            <span>敦煌書局</span>
                                <ul class="life-indexs-inner">
                                    <li>敦煌書局</li>
                                </ul>
                        </li>
                        <li class="life-indexs-content">
                            <span>悠閒時刻</span>
                                <ul class="life-indexs-inner">
                                    <li>海音咖啡</li>
                                    <li>阿諾可麗餅</li>
                                    <li>小木屋鬆餅</li>
                                    <li>校園Cafe</li>
                                </ul>
                        </li>
                        <li class="life-indexs-content">
                            <span>松苑</span>
                                 <ul class="life-indexs-inner">
                                    <li>香草田園(2F)</li>
                                    <li>全家-中大三店</li>
                                    <li>華碩-三井3C</li>
                                    <li>喫茶小舖</li>
                                    <li>野味炭烤燒肉飯</li>
                                    <li>MOS摩斯漢堡</li>
                                </ul>
                        </li>
                        <li class="life-indexs-content">
                            <span>女十四舍B1</span>
                                <ul class="life-indexs-inner">
                                    <li>全家-中大二店</li>
                                    <li>龍誠快速影印</li>
                                    <li>拉雅漢堡</li>
                                </ul>
                        </li>
                        <li class="life-indexs-content">
                            <span>餐廳</span>
                                <ul class="life-indexs-inner">
                                    <li>七餐</li>
                                    <li>九餐</li>
                                </ul>
                        </li>
                    </ul>
                </li>
                
            </ul>
        </div>
    </div>
    <div id="life-bottom">
        <div id="life-dialog">
            <div id="nculife-t">
                </div>
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