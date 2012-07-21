<script type="text/javascript">
jQuery(document).ready(function()
{   
    var options = $.extend({
        isMember:    <?php echo Yii::app()->user->isMember?1:0;?>,
    });
    jQuery('#marquee').marquee();
    jQuery('#index-calendar').indexCalendar(options);
});
</script>

<div id="index-calendar">
    <div class="calendar-top calendar-top-all-nologin">
        <a href="#" id="calendar-all"></a>
        <a href="#" id="calendar-personal"></a>
    </div>
    <div class="calendar-bottom">
        <table class="calendar-table">
            <caption><a href="#">Augest 八月 &gt;</a></caption>
        	<thead>
                <tr>
                    <td class="weekend">日</td>
                    <td>一</td>
                    <td>二</td>
                    <td>三</td>
                    <td>四</td>
                    <td>五</td>
                    <td class="weekend">六</td>
                </tr>
            </thead>
        	<tbody>
        		<tr>
        			<td></td>
        			<td></td>
        			<td></td>
        			<td>1</td>
        			<td>2</td>
        			<td>3</td>
        			<td>4</td>
        		</tr>
        		<tr>
        			<td>5</td>
        			<td>6</td>
        			<td>7</td>
        			<td>8</td>
        			<td>9</td>
        			<td>10</td>
        			<td>11</td>
        		</tr>
        		<tr>
        			<td>12</td>
        			<td>13</td>
        			<td>14</td>
        			<td>15</td>
        			<td>16</td>
        			<td>17</td>
        			<td>18</td>
        		</tr>
        		<tr>
        			<td>19</td>
        			<td>20</td>
        			<td>21</td>
        			<td>22</td>
        			<td>23</td>
        			<td>24</td>
        			<td>25</td>
        		</tr>
        		<tr>
        			<td>26</td>
        			<td>27</td>
        			<td>28</td>
        			<td>29</td>
        			<td>30</td>
        			<td>31</td>
        			<td></td>
        		</tr>
        	</tbody>
        </table>
        <table class="todolist-table">
            <thead>
                <tr>
                    <td>日期</td>
                    <td>事項</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>2012/08/06</td>
                    <td>資訊網上線</td>
                </tr>
                <tr>
                    <td>2012/08/06</td>
                    <td>資訊網上線</td>
                </tr>
                <tr>
                    <td>2012/08/06</td>
                    <td>資訊網上線</td>
                </tr>
                <tr>
                    <td>2012/08/06</td>
                    <td>資訊網上線</td>
                </tr>
                <tr>
                    <td>2012/08/06</td>
                    <td>資訊網上線</td>
                </tr>
                <tr>
                    <td>2012/08/06</td>
                    <td>資訊網上線</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="calendar-bottom">
        <table class="calendar-table">
            <caption><a href="#">September 九月 &gt;</a></caption>
        	<thead>
                <tr>
                    <td class="weekend">日</td>
                    <td>一</td>
                    <td>二</td>
                    <td>三</td>
                    <td>四</td>
                    <td>五</td>
                    <td class="weekend">六</td>
                </tr>
            </thead>
        	<tbody>
        		<tr>
        			<td></td>
        			<td></td>
        			<td></td>
        			<td>1</td>
        			<td>2</td>
        			<td>3</td>
        			<td>4</td>
        		</tr>
        		<tr>
        			<td>5</td>
        			<td>6</td>
        			<td>7</td>
        			<td>8</td>
        			<td>9</td>
        			<td>10</td>
        			<td>11</td>
        		</tr>
        		<tr>
        			<td>12</td>
        			<td>13</td>
        			<td>14</td>
        			<td>15</td>
        			<td>16</td>
        			<td>17</td>
        			<td>18</td>
        		</tr>
        		<tr>
        			<td>19</td>
        			<td>20</td>
        			<td>21</td>
        			<td>22</td>
        			<td>23</td>
        			<td>24</td>
        			<td>25</td>
        		</tr>
        		<tr>
        			<td>26</td>
        			<td>27</td>
        			<td>28</td>
        			<td>29</td>
        			<td>30</td>
        			<td>31</td>
        			<td></td>
        		</tr>
        	</tbody>
        </table>
        <table class="todolist-table">
            <thead>
                <tr>
                    <td>日期</td>
                    <td>事項</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>2012/08/06</td>
                    <td>資訊網上線</td>
                </tr>
                <tr>
                    <td>2012/08/06</td>
                    <td>資訊網上線</td>
                </tr>
                <tr>
                    <td>2012/08/06</td>
                    <td>資訊網上線</td>
                </tr>
                <tr>
                    <td>2012/08/06</td>
                    <td>資訊網上線</td>
                </tr>
                <tr>
                    <td>2012/08/06</td>
                    <td>資訊網上線</td>
                </tr>
                <tr>
                    <td>2012/08/06</td>
                    <td>資訊網上線</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

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