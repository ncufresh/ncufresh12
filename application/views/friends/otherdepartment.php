<table class="other-page">
   <tr>
    <th colspan="5" class="friend-other-page">其他科系</th>
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
<button id="form-otherdepartment-rechoose" type="submit" name="otherdepartment-rechoose">重選</button>
<button id="form-otherdepartment-ensure" type="submit" name="otherdepartment-ensure">確定加為好友</button>
<button id="form-otherdepartment-cancel" type="submit" name="otherdepartmente-cancel">取消</button>