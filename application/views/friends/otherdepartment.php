<form action="<?php echo Yii::app()->createUrl('friends/otherdepartment'); ?>" method="POST">
    <table border="1" width="90%" height="70%">
         <tr>
            <th colspan="5">其他科系</th>
         </tr>
    <?php 
        for($row=1;$row<=4;$row++)
        {
            echo "<tr>";
            for($col=1;$col<=5;$col++)
            {
                if($col%5==0)
                    echo '<td class="">'.$col.'</td>';
                else
                    echo '<td class="">'.$col.'</td>';

            }
            echo "</tr>";
        }
    ?>
    </table>
    <div>
        <input name="token" value="<?php echo Yii::app()->security->getToken(); ?>" type="hidden" />
        <button id="form-otherdepartment-button" type="submit" name="otherdepartment-self-design">更多</button>
    </div>
</form>