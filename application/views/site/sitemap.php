<div id="sitemap">
    <div class="freshman">
        <h4>新生須知</h4>
        <ul>
            <li>
                <h5>大一必讀</h5>
                <ul>
                    <li>
                        <a href="<?php echo Yii::app()->createUrl('readme/index'); ?>#freshman" title="新生區">新生區</a>
                    </li>
                    <li>
                        <a href="<?php echo Yii::app()->createUrl('readme/index'); ?>#reschool" title="復學區">復學區</a>
                    </li>
                    <li>
                        <a href="<?php echo Yii::app()->createUrl('readme/notice', array('id' =>  1)); ?>" title="相關須知">相關須知</a>
                    </li>
                    <li>
                        <a href="<?php echo Yii::app()->createUrl('readme/download'); ?>" title="文件下載">文件下載</a>
                    </li>
                </ul>
            </li>
            <li>
                <h5>系所社團</h5>
                <ul>
                    <li>
                        <a href="<?php echo Yii::app()->createUrl('club/student'); ?>" title="學生組織">學生組織</a>
                    </li>
                    <li>
                        <a href="<?php echo Yii::app()->createUrl('club/department'); ?>" title="系所">系所</a>
                    </li>
                    <li>
                        <a href="<?php echo Yii::app()->createUrl('club/club'); ?>" title="社團">社團</a>
                    </li>
                </ul>
            </li>
            <li>
                <h5>中大生活</h5>
                <ul>
                    <li>
                        <a href="<?php echo Yii::app()->createUrl('nculife/index'); ?>#live" title="住在中大">住在中大</a>
                    </li>
                    <li>
                        <a href="<?php echo Yii::app()->createUrl('nculife/index'); ?>#traffic" title="行在中大">行在中大</a>
                    </li>
                    <li>
                        <a href="<?php echo Yii::app()->createUrl('nculife/index'); ?>#school" title="活在中大">活在中大</a>
                    </li>
                    <li>
                        <a href="<?php echo Yii::app()->createUrl('nculife/index'); ?>#health" title="健康中大">健康中大</a>
                    </li>
                    <li>
                        <a href="<?php echo Yii::app()->createUrl('nculife/index'); ?>#play" title="玩在中大">玩在中大</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
    <div class="discuss">
        <h4>討論交流</h4>
        <ul>
            <li>
                <h5>論壇專區</h5>
                <ul>
                    <li>
                        <a href="<?php echo Yii::app()->createUrl('forum/forum', array('fid' => 1));?>" title="綜合論壇">綜合論壇</a>
                    </li>
                    <li>
                        <a href="<?php echo Yii::app()->createUrl('forum/forumlist');?>" title="系所論壇">系所論壇</a>
                    </li>
                    <li>
                        <a href="<?php echo Yii::app()->createUrl('forum/forum', array('fid' => 2));?>" title="社團論壇">社團論壇</a>
                    </li>
                </ul>
            </li>
            <li>
                <h5>認識校園</h5>
                <ul>
                    <li>
                        <a href="<?php echo Yii::app()->createUrl('multimedia/index');?>" title="影音專區">影音專區</a>
                    </li>
                    <li>
                        <a href="<?php echo Yii::app()->createUrl('street/index');?>" title="校園導覽">校園導覽</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
    <div class="personal">
        <h4>個人專區</h4>
        <ul>
            <li>
                <h5>好友專區</h5>
                <ul>
                    <li>
                        <a href="<?php echo Yii::app()->createUrl('friends/samedepartmentsamegrade');?>" title="同屆同系">同屆同系</a>
                    </li>
                    <li>
                        <a href="<?php echo Yii::app()->createUrl('friends/samedepartmentdiffgrade');?>" title="不同屆同系">不同屆同系</a>
                    </li>
                    <li>
                        <a href="<?php echo Yii::app()->createUrl('friends/otherdepartment');?>" title="同系不同屆">同系不同屆</a>
                    </li>
                </ul>
            </li>
            <li>
                <h5>個人行事曆</h5>
                <ul>
                    <li>
                        <a href="<?php echo Yii::app()->createUrl('calendar/view');?>" title="瀏覽行事曆">瀏覽行事曆</a>
                    </li>
                    <li>
                        <a href="<?php echo Yii::app()->createUrl('calendar/subscript');?>" title="訂閱社團">訂閱社團</a>
                    </li>
                </ul>
            </li>
            <li>
                <h5>遊戲介面</h5>
                <ul>
                    <li>
                        <a href="<?php echo Yii::app()->createUrl('game/index');?>" title="人物資訊">人物資訊</a>
                    </li>
                    <li>
                        <a href="<?php echo Yii::app()->createUrl('game/items');?>" title="道具欄">道具欄</a>
                    </li>
                    <li>
                        <a href="<?php echo Yii::app()->createUrl('game/missions');?>" title="任務列表">任務列表</a>
                    </li>
                    <li>
                        <a href="<?php echo Yii::app()->createUrl('game/shop');?>" title="商城購物">商城購物</a>
                    </li>
                    <li>
                        <a href="<?php echo Yii::app()->createUrl('game/achievements');?>" title="成就達成">成就達成</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
    <div class="information">
        <h4>網站資訊</h4>
        <ul>
            <li>
                <a href="<?php echo Yii::app()->createUrl('about/index'); ?>" title="關於我們">關於我們</a>
            </li>
            <li>
                <a href="<?php echo Yii::app()->createUrl('site/contact'); ?>" title="聯絡我們">聯絡我們</a>
            </li>
        </ul>
    </div>
</div>