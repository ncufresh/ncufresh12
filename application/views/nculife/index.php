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
    <div id="life-body">
        <div id="life-play">
            <ul id="life-index1" class="life-items" pattern="nculife-style1" bar="life-top1">
                <li page="play" tab="1">Movie</li>
                <li page="play" tab="2">KTV</li>
                <li page="play" tab="4">夜市</li>
            </ul>
        </div>
        <div id="life-traffic">
            <ul id="life-index2" class="life-items" pattern="nculife-style2"  bar="life-top2">
                <li page="traffic" tab="1">腳踏車</li>
                <li page="traffic" tab="2">汽機車</li>
                <li page="traffic" tab="3">台聯大專車</li>
                <li class="life-bar">
                <span>如何到中央</span>
                    <ul class="life-inner">
                        <li page="traffic" tab="4">自行開車</li>
                        <li page="traffic" tab="5">高鐵</li>
                        <li page="traffic" tab="6">火車</li>
                        <li page="traffic" tab="7">客運</li>
                        <li page="traffic" tab="8">公車</li>
                    </ul>
                </li>
            </ul>
        </div>
        <div id="life-school">
            <ul id="life-index3" class="life-items" pattern="nculife-style3"  bar="life-top3">
                <li page="school" tab="1">校園影城</li>
                <li page="school" tab="2">校園影印</li>
                <li page="school" tab="3">校園劇場</li>
                <li page="school" tab="4">圖美輸出中心</li>
                <li page="school" tab="5">印象美髮</li>
                <li page="school" tab="6">中大眼鏡行</li>
                <li page="school" tab="7">敦煌書局</li>
                <li class="life-bar">
                    <span>悠閒時刻</span>
                    <ul class="life-inner">
                        <li page="school" tab="8">海音咖啡</li>
                        <li page="school" tab="9">阿諾可麗餅</li>
                        <li page="school" tab="10">小木屋鬆餅</li>
                        <li page="school" tab="11">校園Cafe</li>
                    </ul>
                </li>
                <li class="life-bar">
                <span>松苑</span>
                     <ul class="life-inner">
                        <li page="school" tab="12">香草田園(2F)</li>
                        <li page="school" tab="13">全家</li>
                        <li page="school" tab="14">華碩</li>
                        <li page="school" tab="15">喫茶小舖</li>
                        <li page="school" tab="16">野味</li>
                        <li page="school" tab="17">MOS漢堡</li>
                    </ul>
                </li>
                <li class="life-bar">
                <span>女十四舍B1</span>
                    <ul class="life-inner">
                        <li page="school" tab="18">全家</li>
                        <li page="school" tab="19">龍誠影印</li>
                        <li page="school" tab="20">拉雅漢堡</li>
                    </ul>
                </li>
                <li class="life-bar">
                <span>餐廳</span>
                    <ul class="life-inner">
                        <li page="school" tab="21">七餐</li>
                        <li page="school" tab="22">九餐</li>
                    </ul>
                </li>
            </ul>
        </div>
        <div id="life-live">
            <ul id="life-index4" class="life-items" pattern="nculife-style4" bar="life-top4" >
                <li page="live" tab="1">所需用品</li>
                <li class="life-bar">
                <span>新生宿舍</span>
                    <ul class="life-inner">
                        <li page="live" tab="3">女一舍</li>
                        <li page="live" tab="4">女四舍</li>
                        <li page="live" tab="5">男三舍</li>
                        <li page="live" tab="6">男七舍</li>
                        <li page="live" tab="7">男九舍</li>
                        <li page="live" tab="8">男十一舍</li>
                    </ul>
                </li>
                <li page="live" tab="9">銀行</li>
                <li class="life-bar">
                <span>郵政服務</span>
                    <ul class="life-inner">
                        <li page="live" tab="10">郵件快遞</li>
                        <li page="live" tab="11">郵局</li>
                    </ul>
                </li>
                <li class="life-bar">
                <span>校外商店</span>
                    <ul class="life-inner">
                        <li page="live" tab="12">NOVA</li>
                        <li page="live" tab="13">墊腳石</li>
                        <li page="live" tab="14">光南</li>
                        <li page="live" tab="15">全聯</li>
                        <li page="live" tab="16">家樂福</li>
                    </ul>
                </li>
            </ul>
        </div>
        <div id="life-health">
            <ul id="life-index5" class="life-items" pattern="nculife-style5"  bar="life-top5">
                <li page="health" tab="1">衛保組</li>
                <li page="health" tab="2">特約醫院</li>
                <li page="health" tab="3">心理諮商</li>
            </ul>
        </div>

    </div>
    <div id="life-dialog">
            <div id="nculife-title">
                <h4>
                </h4>
            </div>
            <div id="nculife-dh">
            </div>
            <div id="nculife-db">
                <div id="nculife-cv">
                    View
                </div>
            </div>
        </div>
</div>