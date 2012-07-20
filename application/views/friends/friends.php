<h2>好友專區</h2>
    <table class="sep-group">
        <tr class="friends-title" >
        <th colspan="4" class="form-friends-sort-title" >新增好友</a></th>
        </tr>
        <tr class="friends-title" >
        <th colspan="4" class="form-friends-title"><a href="<?php echo Yii::app()->createUrl('friends/samedepartmentsamegrade'); ?>" title="同系同屆" class="form-friends-title">同系同屆</a></th> <!--重新導向一個自訂的網頁-->
        </tr>
        <tr>
        <td class="friends-close-ones">1111</td>
        <td class="friends-close-ones">2222</td>
        <td class="friends-close-ones">3333</td>
        <td class="friends-close-ones">4444</td>
        </tr>
        <tr class="friends-title">
        <th colspan="4" class="form-friends-title" ><a href="<?php echo Yii::app()->createUrl('friends/samedepartmentdiffgrade'); ?>" title="同系不同屆" class="form-friends-title">同系不同屆</a></th> <!--重新導向一個自訂的網頁-->
        </tr>
        <tr >
        <td class="friends-close-ones">1111111</td>
        <td class="friends-close-ones">2222222</td>
        <td class="friends-close-ones">3333333</td>
        <td class="friends-close-ones">4444444</td>
        </tr>
        <tr class="friends-title">
        <th colspan="4" class="form-friends-title" ><a href="<?php echo Yii::app()->createUrl('friends/otherdepartment'); ?>" title="其他科系" class="form-friends-title">其他科系</a></th> <!--重新導向一個自訂的網頁-->
        </tr>
        <tr>
        <td class="friends-close-ones">1</td>
        <td class="friends-close-ones">2</td>
        <td class="friends-close-ones">3</td>
        <td class="friends-close-ones">4</td>
        </tr>
    </table>
    <table colspan="3" class="close-group">
        <tr class="friends-title" >
        <th colspan="3" class="form-friends-sort-title" >好友分類</a></th>
        </tr>
        <th colspan="3" class="form-friends-title" ><a href="<?php echo Yii::app()->createUrl('friends/myfriends'); ?>" title="朋友" class="form-friends-title">朋友</a></th> <!--重新導向一個自訂的網頁-->
        <tr>
        <td class="friends-close-ones">111111</td>
        <td class="friends-close-ones">222222</td>
        <td class="friends-close-ones">333333</td>
        </tr>
        <tr>
        <td class="friends-close-ones">444444</td>
        <td class="friends-close-ones">555555</td>
        <td class="friends-close-ones">666666</td>
        </tr>
        <tr>
        <th colspan="3" class="form-friends-title"><a href="<?php echo Yii::app()->createUrl('site/index'); ?>" title="自訂" class="form-friends-title">自訂</a></th> <!--跳出視窗-->
        </tr>
    </table>
