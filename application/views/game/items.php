
<?php 
        $counter_two=1;
        $items_bag = $character_data->getItemsByCategory(1);
        echo '<table width="100%" border="1">';
        echo '<th colspan="1">您目前的頭髮 <b> (' . sizeof($items_bag) . ')</b></th>';

        foreach ($items_bag as $row)
        {
            echo '<tr><td>';
            echo $counter_two.'>';
            echo '<img src="'.Yii::app()->request->baseUrl.'/statics/game/icon/hair/'.$row->translation->filename.'.png" alt="'.$row->translation->name.'" />';
            echo $row->item_id.'><a href="'.Yii::app()->createUrl('game/equip', array('id'=>$row->item_id)).'">'.$row->translation->name.'</a>>'.Yii::app()->format->datetime($row->created);
            $counter_two++;
            // echo '<td>'.Yii::app()->format->datetime($row->created).'</td>';
            echo '</td></tr>';
        }
        echo '</table>';
        echo '</br>';

        $counter_two=1;
        $items_bag = $character_data->getItemsByCategory(2);
        echo '<table width="100%" border="1">';
        echo '<th colspan="1">您目前的臉飾 <b> (' . sizeof($items_bag) . ')</b></th>';

        foreach ($items_bag as $row)
        {
            echo '<tr><td>';
            echo $counter_two.'>';
            echo $row->item_id.'><a href="'.Yii::app()->createUrl('game/equip', array('id'=>$row->item_id)).'">'.$row->translation->name.'</a>>'.Yii::app()->format->datetime($row->created);
            $counter_two++;
            // echo '<td>'.Yii::app()->format->datetime($row->created).'</td>';
            echo '</td></tr>';
        }
        echo '</table>';
        echo '</br>';
        
        $counter_two=1;
        $items_bag = $character_data->getItemsByCategory(3);
        echo '<table width="100%" border="1">';
        echo '<th colspan="1">您目前的服裝 <b> (' . sizeof($items_bag) . ')</b></th>';

        foreach ($items_bag as $row)
        {
            echo '<tr><td>';
            echo $counter_two.'>';
            echo $row->item_id.'><a href="'.Yii::app()->createUrl('game/equip', array('id'=>$row->item_id)).'">'.$row->translation->name.'</a>>'.Yii::app()->format->datetime($row->created);
            $counter_two++;
            // echo '<td>'.Yii::app()->format->datetime($row->created).'</td>';
            echo '</td></tr>';
        }
        echo '</table>';
        echo '</br>';
        
        $counter_two=1;
        $items_bag = $character_data->getItemsByCategory(4);
        echo '<table width="100%" border="1">';
        echo '<th colspan="1">您目前的褲子 <b> (' . sizeof($items_bag) . ')</b></th>';

        foreach ($items_bag as $row)
        {
            echo '<tr><td>';
            echo $counter_two.'>';
            echo $row->item_id.'><a href="'.Yii::app()->createUrl('game/equip', array('id'=>$row->item_id)).'">'.$row->translation->name.'</a>>'.Yii::app()->format->datetime($row->created);
            $counter_two++;
            // echo '<td>'.Yii::app()->format->datetime($row->created).'</td>';
            echo '</td></tr>';
        }
        echo '</table>';
        echo '</br>';
        
        $counter_two=1;
        $items_bag = $character_data->getItemsByCategory(5);
        echo '<table width="100%" border="1">';
        echo '<th colspan="1">您目前的鞋子 <b> (' . sizeof($items_bag) . ')</b></th>';

        foreach ($items_bag as $row)
        {
            echo '<tr><td>';
            echo $counter_two.'>';
            echo $row->item_id.'><a href="'.Yii::app()->createUrl('game/equip', array('id'=>$row->item_id)).'">'.$row->translation->name.'</a>>'.Yii::app()->format->datetime($row->created);
            $counter_two++;
            // echo '<td>'.Yii::app()->format->datetime($row->created).'</td>';
            echo '</td></tr>';
        }
        echo '</table>';
        echo '</br>';
        
        $counter_two=1;
        $items_bag = $character_data->getItemsByCategory(6);
        echo '<table width="100%" border="1">';
        echo '<th colspan="1">您目前的皮膚 <b> (' . sizeof($items_bag) . ')</b></th>';

        foreach ($items_bag as $row)
        {
            echo '<tr><td>';
            echo $counter_two.'>';
            echo $row->item_id.'><a href="'.Yii::app()->createUrl('game/equip', array('id'=>$row->item_id)).'">'.$row->translation->name.'</a>>'.Yii::app()->format->datetime($row->created);
            $counter_two++;
            // echo '<td>'.Yii::app()->format->datetime($row->created).'</td>';
            echo '</td></tr>';
        }
        echo '</table>';
        echo '</br>';
        
        $counter_two=1;
        $items_bag = $character_data->getItemsByCategory(7);
        echo '<table width="100%" border="1">';
        echo '<th colspan="1">您目前的其他道具 <b> (' . sizeof($items_bag) . ')</b></th>';

        foreach ($items_bag as $row)
        {
            echo '<tr><td>';
            echo $counter_two.'>';
            echo $row->item_id.'><a href="'.Yii::app()->createUrl('game/equip', array('id'=>$row->item_id)).'">'.$row->translation->name.'</a>>'.Yii::app()->format->datetime($row->created);
            $counter_two++;
            // echo '<td>'.Yii::app()->format->datetime($row->created).'</td>';
            echo '</td></tr>';
        }
        echo '</table>';
        echo '</br>';

?>