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
<button id="form-otherdepartment-button" type="submit" name="otherdepartment-self-design">更多</button>