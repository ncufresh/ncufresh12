<table class="other-page">
    <tr>
        
        <th colspan="5" class="friend-other-page">同屆不同系</th>
    </tr>
    <?php 
        for($row=1;$row<=4;$row++)
        {
            echo '<tr>';
            for($col=1;$col<=5;$col++)
            {
                if($col%5==0)
                {
                    echo '<td >'.$col.'<br /><input type="checkbox" name="friend"  />齁齁齁</td>'; /*強制換行...圖片+名字*/
                    echo '';
                }
                else
                {
                    echo '<td >'.$col.'<br /><input type="checkbox" name="friend"  />齁齁齁</td>';
                }

            }
            echo '</tr>';
        }
    ?>
</table> 
<button id="form-samedepartmentdiffgrade-rechoose" type="submit" name="samedepartmentdiffgrade-rechoose">重選</button>
<button id="form-samedepartmentdiffgrade-ensure" type="submit" name="samedepartmentdiffgrade-ensure">確定加為好友</button>
<button id="form-samedepartmentdiffgrade-cancel" type="submit" name="samedepartmentdiffgrade-cancel">取消</button>
