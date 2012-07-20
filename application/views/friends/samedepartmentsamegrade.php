<table class="other-page"">
   <tr>
        <th colspan="5" class="friend-other-page">同屆同系</th>
   </tr>
   <?php 
        for($row=1;$row<=4;$row++)
        {
            echo "<tr>";
            for($col=1;$col<=5;$col++)
            {
                if($col%5==0)
                    echo '<td>'.$col.'<br /><input type="checkbox" name="friend"  />齁</td>';
                else
                    echo '<td>'.$col.'<br /><input type="checkbox" name="friend"  />齁</td>';

            }
            echo "</tr>";
        }
    ?>
</table>
<button id="form-samedepartmentsamegrade-rechoose" type="submit" name="samedepartmentsamegrade-rechoose">重選</button>
<button id="form-samedepartmentsamegrade-ensure" type="submit" name="samedepartmentsamegrade-ensure">確定加為好友</button>
<button id="form-samedepartmentsamegrade-cancel" type="submit" name="samedepartmentsamegrade-cancel">取消</button>