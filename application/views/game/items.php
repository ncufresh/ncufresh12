<?php 
        $counter_two=1;
        echo '<table width="100%" border="1">';
        echo '<th colspan="3">您目前的道具 <b> (' . sizeof($items_bag) . ')</b></th>';

        foreach ($items_bag as $row)
        {
            echo '<tr><td>';
            echo $counter_two;
            echo '<td>道具id：'.$row->items_id.'</td><td><h2>名稱：'.$row->translation->name.'</h2>';
            if($row->translation->description!='')
            echo ''.$row->translation->description.'</td>';
            else
            echo ' ( 無此道具相關描述 )</td><td>';
            $counter_two++;
            echo '</td></tr>';
        }
        echo '</table>';
        echo '</br>';


?>