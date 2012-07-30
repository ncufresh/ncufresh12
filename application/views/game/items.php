<h1>道具列表</h1>
<?php 
        $counter_two=1;
        $items_bag = $character_data->getItemsByCategory(1);
        echo '<table width="100%" border="1">';
        echo '<th colspan="4">您目前的頭髮 <b> (' . sizeof($items_bag) . ')</b></th>';

        foreach ($items_bag as $row)
        {
            echo '<tr><td>';
            echo $counter_two;
            echo '<td>道具id：'.$row->item_id.'</td><td><h2><a href="'.Yii::app()->createUrl('game/equip', array('id'=>$row->item_id)).'">名稱：'.$row->translation->name.'</a></h2>';
            if($row->translation->description!='')
            echo ''.$row->translation->description.'</td>';
            else
            echo ' ( 無此道具相關描述 )</td><td>';
            $counter_two++;
            echo '<td>時間：'.Yii::app()->format->datetime($row->created).'</td>';
            echo '</td></tr>';
        }
        echo '</table>';
        echo '</br>';
        
        $counter_two=1;
        $items_bag = $character_data->getItemsByCategory(2);
        echo '<table width="100%" border="1">';
        echo '<th colspan="4">您目前的臉飾 <b> (' . sizeof($items_bag) . ')</b></th>';

        foreach ($items_bag as $row)
        {
            echo '<tr><td>';
            echo $counter_two;
            echo '<td>道具id：'.$row->item_id.'</td><td><h2>名稱：'.$row->translation->name.'</h2>';
            if($row->translation->description!='')
            echo ''.$row->translation->description.'</td>';
            else
            echo ' ( 無此道具相關描述 )</td><td>';
            $counter_two++;
            echo '<td>時間：'.Yii::app()->format->datetime($row->created).'</td>';
            echo '</td></tr>';
        }
        echo '</table>';
        echo '</br>';

        $counter_two=1;
        $items_bag = $character_data->getItemsByCategory(3);
        echo '<table width="100%" border="1">';
        echo '<th colspan="4">您目前的衣服 <b> (' . sizeof($items_bag) . ')</b></th>';

        foreach ($items_bag as $row)
        {
            echo '<tr><td>';
            echo $counter_two;
            echo '<td>道具id：'.$row->item_id.'</td><td><h2>名稱：'.$row->translation->name.'</h2>';
            if($row->translation->description!='')
            echo ''.$row->translation->description.'</td>';
            else
            echo ' ( 無此道具相關描述 )</td><td>';
            $counter_two++;
            echo '<td>時間：'.Yii::app()->format->datetime($row->created).'</td>';
            echo '</td></tr>';
        }
        echo '</table>';
        echo '</br>';
        
        $counter_two=1;
        $items_bag = $character_data->getItemsByCategory(4);
        echo '<table width="100%" border="1">';
        echo '<th colspan="4">您目前的褲子 <b> (' . sizeof($items_bag) . ')</b></th>';

        foreach ($items_bag as $row)
        {
            echo '<tr><td>';
            echo $counter_two;
            echo '<td>道具id：'.$row->item_id.'</td><td><h2>名稱：'.$row->translation->name.'</h2>';
            if($row->translation->description!='')
            echo ''.$row->translation->description.'</td>';
            else
            echo ' ( 無此道具相關描述 )</td><td>';
            $counter_two++;
            echo '<td>時間：'.Yii::app()->format->datetime($row->created).'</td>';
            echo '</td></tr>';
        }
        echo '</table>';
        echo '</br>';
        
        $counter_two=1;
        $items_bag = $character_data->getItemsByCategory(5);
        echo '<table width="100%" border="1">';
        echo '<th colspan="4">您目前的鞋子 <b> (' . sizeof($items_bag) . ')</b></th>';

        foreach ($items_bag as $row)
        {
            echo '<tr><td>';
            echo $counter_two;
            echo '<td>道具id：'.$row->item_id.'</td><td><h2>名稱：'.$row->translation->name.'</h2>';
            if($row->translation->description!='')
            echo ''.$row->translation->description.'</td>';
            else
            echo ' ( 無此道具相關描述 )</td><td>';
            $counter_two++;
            echo '<td>時間：'.Yii::app()->format->datetime($row->created).'</td>';
            echo '</td></tr>';
        }
        echo '</table>';
        echo '</br>';

        $counter_two=1;
        $items_bag = $character_data->getItemsByCategory(6);
        echo '<table width="100%" border="1">';
        echo '<th colspan="4">您目前的皮膚 <b> (' . sizeof($items_bag) . ')</b></th>';

        foreach ($items_bag as $row)
        {
            echo '<tr><td>';
            echo $counter_two;
            echo '<td>道具id：'.$row->item_id.'</td><td><h2>名稱：'.$row->translation->name.'</h2>';
            if($row->translation->description!='')
            echo ''.$row->translation->description.'</td>';
            else
            echo ' ( 無此道具相關描述 )</td><td>';
            $counter_two++;
            echo '<td>時間：'.Yii::app()->format->datetime($row->created).'</td>';
            echo '</td></tr>';
        }
        echo '</table>';
        echo '</br>';
        
        $counter_two=1;
        $items_bag = $character_data->getItemsByCategory(7);
        echo '<table width="100%" border="1">';
        echo '<th colspan="4">您目前的其他道具 <b> (' . count($items_bag) . ')</b></th>';

        foreach ($items_bag as $row)
        {
            echo '<tr><td>';
            echo $counter_two;
            echo '<td>道具id：'.$row->item_id.'</td><td><h2>名稱：'.$row->translation->name.'</h2>';
            if($row->translation->description!='')
            echo ''.$row->translation->description.'</td>';
            else
            echo ' ( 無此道具相關描述 )</td><td>';
            $counter_two++;
            echo '<td>時間：'.Yii::app()->format->datetime($row->created).'</td>';
            echo '</td></tr>';
        }
        echo '</table>';
        echo '</br>';

?>