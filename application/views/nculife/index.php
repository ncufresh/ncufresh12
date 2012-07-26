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
    </div>
    <div id="life-body">
        <div id="life-health">
            
        </div>
        <div id="life-live">
        </div>
        <div id="life-traffic">
        </div>
        <div id="life-play">
        </div>
        <div id="life-school">
        </div>
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
                                    <li page="live" tab="1">所需用品</li>
                                </ul>
                        </li>
                        <li class="life-indexs-content">
                            <span>郵件招領</span>
                                <ul class="life-indexs-inner">
                                    <li page="live" tab="2">郵件招領</li>
                                </ul>
                        </li>
                        <li class="life-indexs-content">
                            <span>新生宿舍</span>
                                <ul class="life-indexs-inner">
                                    <li page="live" tab="3">女一舍</li>
                                    <li page="live" tab="4">女四舍</li>
                                    <li page="live" tab="5">男三舍</li>
                                    <li page="live" tab="6">男七舍</li>
                                    <li page="live" tab="7">男九舍</li>
                                    <li page="live" tab="8">男十一舍</li>
                                </ul>
                        </li>
                        <li class="life-indexs-content">
                            <span>銀行</span>
                                <ul class="life-indexs-inner">
                                    <li page="live" tab="9">銀行</li>
                                </ul>
                        </li>
                        <li class="life-indexs-content">
                            <span>郵政服務</span>
                                <ul class="life-indexs-inner">
                                    <li page="live" tab="10">郵件快遞</li>
                                    <li page="live" tab="11">郵局</li>
                                </ul>
                        </li>
                    </ul>
                </li>
                <li>
                    <span>Traffic</span>
                    <ul class="life-indexs">
                        <li class="life-indexs-content">
                            <span>腳踏車</span>
                                <ul class="life-indexs-inner">
                                    <li page="traffic" tab="1">腳踏車</li>
                                </ul>
                        </li>
                        <li class="life-indexs-content">
                            <span>汽機車</span>
                                <ul class="life-indexs-inner">
                                    <li page="traffic" tab="2">汽機車</li>
                                </ul>
                        </li>
                        <li class="life-indexs-content">
                            <span>台聯大專車</span>
                                <ul class="life-indexs-inner">
                                    <li page="traffic" tab="3">台聯大專車</li>
                                </ul>
                        </li>
                        <li class="life-indexs-content">
                            <span>如何到中央</span>
                                <ul class="life-indexs-inner">
                                    <li page="traffic" tab="4">自行開車</li>
                                    <li page="traffic" tab="5">高鐵</li>
                                    <li page="traffic" tab="6">火車</li>
                                    <li page="traffic" tab="7">客運</li>
                                    <li page="traffic" tab="8">公車</li>
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
                                    <li page="play" tab="1">Movie</li>
                                </ul>
                        </li>
                        <li class="life-indexs-content">
                            <span>KTV</span>
                                <ul class="life-indexs-inner">
                                    <li page="play" tab="2">KTV</li>
                                </ul>
                        </li>
                        <li class="life-indexs-content">
                            <span>NOVA</span>
                                <ul class="life-indexs-inner">
                                    <li page="play" tab="3">NOVA</li>
                                </ul>
                        </li>
                        <li class="life-indexs-content">
                            <span>夜市</span>
                                <ul class="life-indexs-inner">
                                    <li page="play" tab="4">夜市</li>
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
                                    <li page="school" tab="1">圖美輸出中心</li>
                                </ul>
                        </li>
                        <li class="life-indexs-content">
                            <span>校園影印</span>
                                <ul class="life-indexs-inner">
                                    <li page="school" tab="2">校園影印</li>
                                </ul>
                        </li>
                        <li class="life-indexs-content">
                            <span>校園劇場</span>
                                <ul class="life-indexs-inner">
                                    <li page="school" tab="3">校園劇場</li>
                                </ul>
                        </li>
                        <li class="life-indexs-content">
                            <span>校園影城</span>
                                <ul class="life-indexs-inner">
                                    <li page="school" tab="4">校園影城</li>
                                </ul>
                        </li>
                        <li class="life-indexs-content">
                            <span>印象美髮</span>
                                <ul class="life-indexs-inner">
                                    <li page="school" tab="5">印象美髮</li>
                                </ul>
                        </li>
                        <li class="life-indexs-content">
                            <span>好視康眼鏡</span>
                                <ul class="life-indexs-inner">
                                    <li page="school" tab="6">好視康眼鏡</li>
                                </ul>
                        </li>
                        <li class="life-indexs-content">
                            <span>敦煌書局</span>
                                <ul class="life-indexs-inner">
                                    <li page="school" tab="7">敦煌書局</li>
                                </ul>
                        </li>
                        <li class="life-indexs-content">
                            <span>悠閒時刻</span>
                                <ul class="life-indexs-inner">
                                    <li page="school" tab="8">海音咖啡</li>
                                    <li page="school" tab="9">阿諾可麗餅</li>
                                    <li page="school" tab="10">小木屋鬆餅</li>
                                    <li page="school" tab="11">校園Cafe</li>
                                </ul>
                        </li>
                        <li class="life-indexs-content">
                            <span>松苑</span>
                                 <ul class="life-indexs-inner">
                                    <li page="school" tab="12">香草田園(2F)</li>
                                    <li page="school" tab="13">全家-中大三店</li>
                                    <li page="school" tab="14">華碩-三井3C</li>
                                    <li page="school" tab="15">喫茶小舖</li>
                                    <li page="school" tab="16">野味炭烤燒肉飯</li>
                                    <li page="school" tab="17">MOS摩斯漢堡</li>
                                </ul>
                        </li>
                        <li class="life-indexs-content">
                            <span>女十四舍B1</span>
                                <ul class="life-indexs-inner">
                                    <li page="school" tab="18">全家-中大二店</li>
                                    <li page="school" tab="19">龍誠快速影印</li>
                                    <li page="school" tab="20">拉雅漢堡</li>
                                </ul>
                        </li>
                        <li class="life-indexs-content">
                            <span>餐廳</span>
                                <ul class="life-indexs-inner">
                                    <li page="school" tab="21">七餐</li>
                                    <li page="school" tab="22">九餐</li>
                                </ul>
                        </li>
                    </ul>
                </li>
                
            </ul>
        </div>
    </div>
    <div id="life-bottom">
    </div>
    <div id="life-dialog">
            <div id="nculife-title">
                <h4>
                </h4>
            </div>
            <div id="nculife-dh">
            </div><!-- end nculife-dh -->
            <div id="nculife-db">
                <div id="nculife-cv">
                    View
                </div><!-- end nculife-cv -->
            </div><!-- end nculife-db -->
        </div><!-- end nculife-dialog -->
</div>