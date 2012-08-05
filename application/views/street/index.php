<div id="street-div">
    <div id="back-div">    
    
        <div class="street-loading">
            <div class="loading"></div>
        </div>

        <div id="up-curtain-div">
        </div>

        <div id="curtain-close-div">
            <div class="curtainOpen"></div>
        </div>
        
        <div id="map-div">
            <img id="mapPicture" path="<?php echo Yii::app()->baseUrl?>/statics/building/map_no_text.png">
            <!--選擇鈕-->
            <div class="one-image dormitory" show="dormitory"></div>
            <div class="one-image diet" show="diet"></div>
            <div class="one-image department-building" show="department-building"></div>
            <div class="one-image landscape" show="landscape"></div>
            <div class="one-image government" show="government"></div>
            <div class="one-image exercise" show="exercise"></div>
            
            <div class="arrow up"></div>
            <div class="arrow left"></div>
            <div class="arrow right"></div>
            <div class="arrow back"></div>

            <div id="experience-personally" class=""></div>
            <p id="drag-me">拉我到建築喔!!</p>
            
            <!--系館-->
            <div id="engineering-5" class="department-building picture" streetPoints="0" faceto="E" show="department-building" href="#1"></div>
            <div id="engineering-3" class="department-building picture" streetPoints="2" faceto="W" show="department-building" href="#2"></div>
            <div id="engineering-2" class="department-building picture" streetPoints="51" faceto="W" show="department-building" href="#3"></div>
            <div id="engineering-1" class="department-building picture" streetPoints="10" faceto="W" show="department-building" href="#4"></div>
            <div id="photonics" class="department-building picture opacity-picture" streetPoints="-1" faceto="W" show="department-building" href="#5"></div>
            <div id="science-5" class="department-building picture opacity-picture" streetPoints="-1" faceto="-1" show="department-building" href="#6"></div>
            <div id="science-4" class="department-building picture opacity-picture" streetPoints="-1" faceto="-1" show="department-building" href="#7"></div>
            <div id="science-3" class="department-building picture" streetPoints="45" faceto="S" show="department-building" href="#8"></div>
            <div id="science-2" class="department-building picture opacity-picture" streetPoints="-1" faceto="-1" show="department-building" href="#9"></div>
            <div id="science-1" class="department-building picture" streetPoints="18" faceto="W" show="department-building" href="#10"></div>
            <div id="science-teach" class="department-building picture opacity-picture" streetPoints="-1" faceto="-1" show="department-building" href="#11"></div>
            <div id="mathematics" class="department-building picture opacity-picture" streetPoints="45" faceto="W" show="department-building" href="#12"></div>
            <div id="liberal-arts" class="department-building picture" streetPoints="24" faceto="W" show="department-building" href="#13"></div>
            <div id="management" class="department-building picture" streetPoints="-1" faceto="-1" show="department-building" href="#14"> </div>
            <div id="hakka" class="department-building picture opacity-picture" streetPoints="-1" faceto="-1" show="department-building" href="#16"></div>

            <!-- 街景照片測試 -->
             
            <!--景觀-->
            <div id="ncu-lake"class="landscape picture opacity-picture"  streetPoints="-1" faceto="-1" show="landscape" href="#17"></div>
            <div id="turtle-pond" class="landscape picture" streetPoints="29" faceto="W" show="landscape" href="#18"></div>
            <div id="pine-wind" class="landscape picture opacity-picture" streetPoints="-1" faceto="-1" show="landscape" href="#20"></div>
            <div id="stepping-cloud" class="landscape picture opacity-picture" streetPoints="-1" faceto="-1" show="landscape" href="#21"></div>
            <div id="elephant-element" class="landscape picture" streetPoints="27" faceto="S" show="landscape" href="#22"></div>
            <div id="yun-step" class="landscape picture" streetPoints="39" faceto="E" show="landscape" href="#23"></div>
            <div id="flower-brook" class="landscape picture" streetPoints="37" faceto="W" show="landscape" href="#24"></div>
            <div id="big-tree" class="landscape picture" streetPoints="20" faceto="S" show="landscape" href="#25"></div>
            <div id="calligraphy" class="landscape picture opacity-picture" streetPoints="-1" faceto="-1" show="landscape" href="#26"></div>
            <div id="kon-fu" class="landscape picture" streetPoints="36" faceto="N" show="landscape" href="#61"></div>
            <div id="green-plain" class="landscape picture opacity-picture" streetPoints="-1" faceto="-1" show="landscape" href="#62"></div>
            <div id="girl-14-front" class="landscape picture" streetPoints="14" faceto="E" show="landscape" href="#63"></div>
            <!--飲食-->
            <div id="restaurant-7" class="diet picture" streetPoints="16" faceto="E" show="diet" href="#28"></div>
            <div id="restaurant-9" class="diet picture" streetPoints="29" faceto="N" show="diet" href="#29"></div>
            <div id="midnight-food" class="diet picture" streetPoints="13" faceto="E" show="diet" href="#30"></div>
            <div id="backdoor" class="diet picture" streetPoints="8" faceto="E" show="diet" href="#31"></div>
            <div id="school-coffee" class="diet picture opacity-picture" streetPoints="-1" faceto="-1" show="diet" href="#32"></div>
            <div id="cottage-muffin" class="diet picture opacity-picture" streetPoints="-1" faceto="-1" show="diet" href="#33"></div>
            <div id="pine-restaurant" class="diet picture opacity-picture" streetPoints="-1" faceto="-1" show="diet" href="#68"></div>
            <!--建築-->
            <div id="administration" class="government picture" streetPoints="25" faceto="S" show="government" href="#34"></div>
            <div id="computer-center" class="government picture" streetPoints="35" faceto="W" show="government" href="#35"></div>
            <div id="history-gallery" class="government picture" streetPoints="26" faceto="N" show="government" href="#36"></div>
            <div id="all-teach" class="government picture" streetPoints="44" faceto="W" show="government" href="#37"></div>
            <div id="big-library" class="government picture" streetPoints="23" faceto="S" show="government" href="#64"></div>
            <div id="playing-dancing" class="government picture" streetPoints="17" faceto="E" show="government" href="#65"></div>
            <div id="ding-data-library" class="government picture opacity-picture" streetPoints="-1" faceto="-1" show="government" href="#66"></div>
            <div id="old-library" class="government picture" streetPoints="39" faceto="W" show="government" href="#67"></div>
            <!--宿舍-->
            <div id="girl-dormitory-1234" class="dormitory picture" streetPoints="54" faceto="S" show="dormitory" href="#39"></div>
            <div id="girl-dormitory-5" class="dormitory picture" streetPoints="55" faceto="W" show="dormitory" href="#40"></div>
            <div id="boy-dormitory-3" class="dormitory picture" streetPoints="55" faceto="E" show="dormitory" href="#41"></div>
            <div id="boy-dormitory-5" class="dormitory picture opacity-picture" streetPoints="-1" faceto="-1" show="dormitory" href="#42"></div>
            <div id="boy-dormitory-6" class="dormitory picture opacity-picture" streetPoints="-1" faceto="-1" show="dormitory" href="#43"></div>
            <div id="boy-dormitory-7" class="dormitory picture" streetPoints="16" faceto="E" show="dormitory" href="#44"></div>
            <div id="boy-dormitory-9" class="dormitory picture" streetPoints="29" faceto="N" show="dormitory" href="#45"></div>
            <div id="boy-dormitory-11" class="dormitory picture" streetPoints="15" faceto="E" show="dormitory" href="#46"></div>
            <div id="boy-dormitory-12" class="dormitory picture" streetPoints="50" faceto="W" show="dormitory" href="#47"></div>
            <div id="boy-dormitory-13" class="dormitory picture opacity-picture" streetPoints="-1" faceto="-1" show="dormitory" href="#48"></div>
            <div id="girl-dormitory-14" class="dormitory picture" streetPoints="14" faceto="E" show="dormitory" href="#49"></div>
            <div id="new-postgraduate" class="dormitory picture opacity-picture" streetPoints="-1" faceto="-1" show="dormitory" href="#50"></div>
            <div id="international-dormitory" class="dormitory picture opacity-picture" streetPoints="-1" faceto="-1" show="dormitory" href="#51"></div>
            <!--運動-->
            <div id="swimming-pool" class="exercise picture" streetPoints="48" faceto="W" show="exercise" href="#52"></div>
            <div id="playground" class="exercise picture" streetPoints="4" faceto="W" show="exercise" href="#53"></div>
            <div id="stadium" class="exercise picture" streetPoints="52" faceto="S" show="exercise" href="#54"></div>
        </div>

        <!--總寬:750px 總高:601px  窗簾:249px  地圖:寬601px高551px  相片原圖:2256*1496-->

        <div id="curtainDiv">
        <!--選擇鈕2-->
            
            <div id="inside-choose">
                <p class="two-image department-building" show="department-building" detailItem="department">系館</p>
                <p class="two-image landscape" show="landscape" detailItem="landscape">景點</p>
                <p class="two-image diet" show="diet" detailItem="meal">餐廳</p>
                <p class="two-image government" show="government" detailItem="govern">建築</p>
                <p class="two-image dormitory" show="dormitory" detailItem="dorm">宿舍</p>
                <p class="two-image exercise" show="exercise" detailItem="sport">運動</p>

            </div>
            <div id="inside-text">
                <ul class="text-ul">
                    <li class="department-button-text button-text" detailItem="department" href="#1">工程五館</li>
                    <li class="department-button-text button-text" detailItem="department" href="#2">工程三館</li>
                    <li class="department-button-text button-text" detailItem="department" href="#3">工程二館</li>
                    <li class="department-button-text button-text" detailItem="department" href="#4">工程一館</li>
                    <li class="department-button-text button-text" detailItem="department" href="#5">國鼎光電大樓</li>
                    <li class="department-button-text button-text" detailItem="department" href="#6">科學五館</li>
                    <li class="department-button-text button-text" detailItem="department" href="#7">科學四館</li>
                    <li class="department-button-text button-text" detailItem="department" href="#8">科學三館</li>
                    <li class="department-button-text button-text" detailItem="department" href="#9">科學二館</li>
                    <li class="department-button-text button-text" detailItem="department" href="#10">科學一館</li>
                    <li class="department-button-text button-text" detailItem="department" href="#11">理學院教學館</li>
                    <li class="department-button-text button-text" detailItem="department" href="#12">鴻經館</li>
                    <li class="department-button-text button-text" detailItem="department" href="#13">文學院</li>
                    <li class="department-button-text button-text" detailItem="department" href="#14">管學院</li>
                    <li class="department-button-text button-text" detailItem="department" href="#16">客家學院大樓</li>
                </ul>
                <ul class="text-ul">
                    <li class="landscape-text button-text" detailItem="landscape" href="#17">中大湖</li>
                    <li class="landscape-text button-text" detailItem="landscape" href="#18">烏龜池</li>
                    <li class="landscape-text button-text" detailItem="landscape" href="#20">坐聽‧松風</li>
                    <li class="landscape-text button-text" detailItem="landscape" href="#21">漫步雲端</li>
                    <li class="landscape-text button-text" detailItem="landscape" href="#22">大象五行</li>
                    <li class="landscape-text button-text" detailItem="landscape" href="#23">蘊‧行</li>
                    <li class="landscape-text button-text" detailItem="landscape" href="#24">百花川</li>
                    <li class="landscape-text button-text" detailItem="landscape" href="#25">國泰樹</li>
                    <li class="landscape-text button-text" detailItem="landscape" href="#26">筆墨紙硯</li>
                    <li class="landscape-text button-text" detailItem="landscape" href="#61">太極銅雕</li>
                    <li class="landscape-text button-text" detailItem="landscape" href="#62">綠草如茵</li>
                    <li class="landscape-text button-text" detailItem="landscape" href="#63">女14舍前廣場</li>
                </ul>
                <ul class="text-ul">
                    <li class="food-text button-text" detailItem="meal" href="#28">男七餐廳</li>
                    <li class="food-text button-text" detailItem="meal" href="#29">男九餐廳</li>
                    <li class="food-text button-text" detailItem="meal" href="#30">消夜街</li>
                    <li class="food-text button-text" detailItem="meal" href="#31">後門</li>
                    <li class="food-text button-text" detailItem="meal" href="#32">校園咖啡</li>
                    <li class="food-text button-text" detailItem="meal" href="#33">小木屋鬆餅</li>
                    <li class="food-text button-text" detailItem="meal" href="#68">松苑廣場</li>
                </ul>
                <ul class="text-ul">
                    <li class="government-text button-text" detailItem="govern" href="#34">行政大樓</li>
                    <li class="government-text button-text" detailItem="govern" href="#35">志希館 電算中心</li>
                    <li class="government-text button-text" detailItem="govern" href="#36">校史館</li>
                    <li class="government-text button-text" detailItem="govern" href="#37">綜教館</li>
                    <li class="government-text button-text" detailItem="govern" href="#64">總圖書館</li>
                    <li class="government-text button-text" detailItem="govern" href="#65">游藝館 據德樓</li>
                    <li class="government-text button-text" detailItem="govern" href="#66">國鼎圖書館</li>
                    <li class="government-text button-text" detailItem="govern" href="#67">中正圖書館</li>
                </ul>
                <ul class="text-ul">
                    <li class="dormitory-text button-text" detailItem="dorm" href="#39">女一 ~ 四舍</li>
                    <li class="dormitory-text button-text" detailItem="dorm" href="#40">女五舍</li>
                    <li class="dormitory-text button-text" detailItem="dorm" href="#41">男三舍</li>
                    <li class="dormitory-text button-text" detailItem="dorm" href="#42">男五舍</li>
                    <li class="dormitory-text button-text" detailItem="dorm" href="#43">男六舍</li>
                    <li class="dormitory-text button-text" detailItem="dorm" href="#44">男七舍</li>
                    <li class="dormitory-text button-text" detailItem="dorm" href="#45">男九舍</li>
                    <li class="dormitory-text button-text" detailItem="dorm" href="#46">男11舍</li>
                    <li class="dormitory-text button-text" detailItem="dorm" href="#47">男12舍</li>
                    <li class="dormitory-text button-text" detailItem="dorm" href="#48">男13舍</li>
                    <li class="dormitory-text button-text" detailItem="dorm" href="#49">女十四舍</li>
                    <li class="dormitory-text button-text" detailItem="dorm" href="#50">新研舍</li>
                    <li class="dormitory-text button-text" detailItem="dorm" href="#51">國際學生宿舍</li>
                </ul>
                <ul class="text-ul">
                    <li class="exercise-text button-text" detailItem="sport" href="#52">游泳池</li>
                    <li class="exercise-text button-text" detailItem="sport" href="#53">操場</li>
                    <li class="exercise-text button-text" detailItem="sport" href="#54">依仁堂</li>
                </ul>
                <div id="curtainclose"></div>
            </div>
        </div>
        <div id="text-container"><!--第一層-->
                <div id="building-text" class="scroll-class">
                </div>
        </div>
    </div>
</div>
</div>
