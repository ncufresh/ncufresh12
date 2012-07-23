<?php
        $level = array(
            array(
                'name'  => '錯誤級',  //原則上不會跑到這
                'exp'   => 0
            ),
            array(
                'name'  => '等級一',
                'exp'   => 50
            ),
            array(
                'name'  => '等級二',
                'exp'   => 150
            ),
            array(
                'name'  => '等級三',
                'exp'   => 300
            ),
            array(
                'name'  => '等級四',
                'exp'   => 500
            ),
            array(
                'name'  => '等級五',
                'exp'   => 750
            ),
            array(
                'name'  => '等級六',
                'exp'   => 1050
            ),
            array(
                'name'  => '等級七',
                'exp'   => 1400
            ),
            array(
                'name'  => '等級八',
                'exp'   => 1800
            ),
            array(
                'name'  => '等級九',
                'exp'   => 2250
            ),
            array(
                'name'  => '神手級',
                'exp'   => 5000
            ),
            array(
                'name'  => '雞雞',
                'exp'   => 1000000
            ),
            array(
                'name'  => '駭客級',
                'exp'   => 10000000000
            )
        );
        $id = 3;
        $user = Character::model()->findByPk($id);
        $achievements_bag = Character::model()->findByPk($id)->achievements_bag;
        $items_bag = Character::model()->findByPk($id)->items_bag;
        $test = Achievement::model()->findByPk($id);
        $user->addExp(47);     //加經驗
        $user->addMoney(10);   //加錢幣
        $count=0; //計算等級
        foreach ($level as $value)
        {

          if ( $user->getExpValue() < $value['exp'] )
          {
              echo '<h1 style="background-color:black;color:red;text-align:center;font-size:40px">'.$count.'次加持 '.$value['name'].'</h1>';
              if($count>=10)
              echo '<h1 style="background-color:black;color:red;text-align:center;font-size:40px">'.$user->getExpValue().' / ∞ (最高等級)</h1>';
              else
              echo '<h1 style="background-color:black;color:red;text-align:center;font-size:40px">'.$user->getExpValue().' / '.$value['exp'].' (下一等級)</h1>';
              
              break;
          }
          $count++;
        }
        echo '<div style="color:navy;font-size:18px">';
        echo 'Id：';
        print_r($user->id);
        echo '<br/>綽號：';
        // print_r($model->getUserNickName());
        // echo '<br/>頭髮：';
        print_r($user->profile->nickname);
        echo '<br/>頭髮：';
        print_r($user->hair->name);
        echo '<br/>眼睛：';
        print_r($user->eyes->name);
        echo '<br/>衣服：';
        print_r($user->cloths->name);
        echo '<br/>褲子：';
        print_r($user->pants->name);
        echo '<br/>手勢：';
        print_r($user->hands->name);
        echo '<br/>鞋子：';
        print_r($user->shoes->name);
        echo '<br/>特殊寶物：';
        print_r($user->others->name);
        echo '<br/>經驗值：';
        print_r($user->exp);
        echo '<br/>金錢：';
        print_r($user->money);
        echo '<br/>';
        echo '</div>';

        $counter_one=1;
        $counter_two=1;
        echo '<br/><br/>';
            // $temp=$model->AchievementsBag();
            // echo sizeof($temp);
            // echo $temp[0]->name.'<br/>';
            // echo $temp[1]->name.'<br/>';
            // echo $temp[2]->name.'<br/>';
            // echo $temp[3]->name.'<br/>';
        
        echo '<table width="100%" border="1">';
        echo '<th colspan="4">您目前的成就 <b> (' . sizeof($achievements_bag) . ')</b></th>';
        foreach ($achievements_bag as $row)
        {
            echo '<tr><td>';
            echo $counter_one;
            // echo '成就id：'.$row->achievement_id.'，名稱：'.$row->translation->name.'('.$row->translation->description.')   ('. $row->time.' 獲得)';
            echo '<td>成就id：'.$row->achievement_id.'</td><td>名稱：'.$row->translation->name;
            if($row->translation->description!='')
            echo ' ( '.$row->translation->description.' )</td><td>'. $row->time.' 獲得</td>';
            else
            echo ' ( 無此成就相關描述 )</td><td>'. $row->time.' 獲得</td>';
            $counter_one++;
            echo '</td></tr>';
        }
        echo '</table></br>';

        echo '<table width="100%" border="1">';
        echo '<th colspan="4">您目前的道具 <b> (' . sizeof($items_bag) . ')</b></th>';

        foreach ($items_bag as $row)
        {
            echo '<tr><td>';
            echo $counter_two;
            echo '<td>道具id：'.$row->items_id.'</td><td>名稱：'.$row->translation->name;
            if($row->translation->description!='')
            echo ' ( '.$row->translation->description.' )</td><td>'. $row->time.' 獲得</td>';
            else
            echo ' ( 無此道具相關描述 )</td><td>'. $row->time.' 獲得</td>';
            $counter_two++;
            echo '</td></tr>';
        }
        echo '</table>';
        echo '</br>';

        
        
        
        // foreach ($model->GetItemsTime() as $test)
        // {
            // echo $test['time'].'時間)'.$test['items_id'];
            // echo '<br/>';
        // }
        

        

?>
<img src="../statics/fire.png">
