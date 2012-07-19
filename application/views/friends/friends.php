<h2>好友專區</h2>
<p>
    來分類一下吧
</p>
    <table>
            <tr class="friends-title" >
            <th align="left" colspan="6" ><a href="<?php echo Yii::app()->createUrl('friends/samedepartmentsamegrade'); ?>" title="同系同屆">同系同屆</a></th>
            </tr>
            <tr>
            <td class="friends-close-ones">1111</td>
            <td class="friends-close-ones">2222</td>
            <td class="friends-close-ones">3333</td>
            <td class="friends-close-ones">4444</td>
            <td class="friends-close-ones">5555</td>
            <td class="friends-close-ones">6666</td>
            </tr>
    </table>
    <table>
        <tr class="friends-title">
        <th align="left" colspan="6" ><a href="<?php echo Yii::app()->createUrl('friends/samedepartmentdiffgrade'); ?>" title="同系不同屆">同系不同屆</a></th>
        </tr>
        <tr >
        <td class="friends-close-ones">1111111</td>
        <td class="friends-close-ones">2222222</td>
        <td class="friends-close-ones">3333333</td>
        <td class="friends-close-ones">4444444</td>
        <td class="friends-close-ones">55555555</td>
        <td class="friends-close-ones">66666666</td>
        </tr>
    </table>
    <table>
        <tr class="friends-title">
        <th align="left" colspan="6" ><a href="<?php echo Yii::app()->createUrl('friends/otherdepartment'); ?>" title="其他科系">其他科系</a></th>
        </tr>
        <tr>
        <td class="friends-close-ones">1</td>
        <td class="friends-close-ones">2</td>
        <td class="friends-close-ones">3</td>
        <td class="friends-close-ones">4</td>
        <td class="friends-close-ones">5</td>
        <td class="friends-close-ones">6</td>
        </tr>
    </table>
    <button id="form-friends-button" type="submit" name="friends-self-design">自訂</button>
