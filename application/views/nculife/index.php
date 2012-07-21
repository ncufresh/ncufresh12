<script type="text/javascript">
jQuery(document).ready(function()
{
    setInterval(function()
    {
        jQuery('.life-picture').fadeOut(500).eq(jQuery.random(0, $('.life-picture').length - 1)).fadeIn(500);
    }, 1000);
});
</script>

<div id="life-container">
<div id="life-head">
-------------這裡是中大生活唷-----------
</div>
<div id="life-body">
    <div id="linkk">  
        <ul class="life-index">
            <li>
                <span>食在中央</span>
                <ul class="life-indexs">
                    <li>後門</li>
                    <li>校園美食</li>
                    <li>露天咖啡廳</li>
                    <li>學生餐廳</li>
                    <li>宵夜街</li>
                </ul>
            </li>
            <li>
                <span>健康中央</span>
                <ul class="life-indexs">
                    <li>衛保組</li>
                    <li>特約醫院</li>
                    <li>心理諮詢</li>
                </ul>
            </li>
            <li>
                <span>行在中央</span>
                <ul class="life-indexs">
                    <li>腳踏車</li>
                    <li>汽機車</li>
                    <li>如何到中央</li>
                    <li>台聯大專車</li>
                </ul>
            </li>
            <li>
                <span>中大運動</span>
                <ul class="life-indexs">
                    <li>游泳池</li>
                    <li>依仁堂</li>
                    <li>球類場地</li>
                    <li>溜冰場</li>
                    <li>操場</li>
                </ul>
            </li>
            <li>
                <span>中大校外</span>
                <ul class="life-indexs">
                    <li>夜市</li>
                    <li>電影院</li>
                    <li>NOVA</li>
                    <li>KTV</li>
                </ul>
            </li>
            <li>
                <span>活在中央</span>
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
                <span>住在中央</span>
                <ul class="life-indexs">
                    <li>新生宿舍</li>
                    <li>宿網申請</li>
                    <li>宿舍冷氣</li>
                    <li>宿舍所需</li>
                    <li>宿舍規則</li>
                    <li>外宿專區</li>
                </ul>
            </li>
        </ul>
        <a id="life-test1" class="life-picture"></a>
        <a id="life-test2" class="life-picture"></a>
        <a id="life-test3" class="life-picture"></a>
    </div>
</div>

<div id="life-bottom">
</div>
</div>