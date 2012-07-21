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
        $model = Character::model()->findByPk($id);
        $test = Achievement::model()->findByPk($id);
        $model->addExp(47);     //加經驗
        $model->addMoney(10);   //加錢幣
        $count=0; //計算等級
        foreach ($level as $value)
        {

          if ( $model->getExpValue() < $value['exp'] )
          {
              echo '<h1 style="background-color:black;color:red;text-align:center;font-size:40px">'.$count.'次加持 '.$value['name'].'</h1>';
              if($count>=10)
              echo '<h1 style="background-color:black;color:red;text-align:center;font-size:40px">'.$model->getExpValue().' / ∞ (最高等級)</h1>';
              else
              echo '<h1 style="background-color:black;color:red;text-align:center;font-size:40px">'.$model->getExpValue().' / '.$value['exp'].' (下一等級)</h1>';
              
              break;
          }
          $count++;
        }
        echo '<div style="color:navy;font-size:18px">';
        echo 'Id：';
        print_r($model->getId());
        echo '<br/>綽號：';
        // print_r($model->getUserNickName());
        // echo '<br/>頭髮：';
        print_r($model->getUserNickName());
        echo '<br/>眼睛：';
        print_r($model->getEyesName());
        echo '<br/>衣服：';
        print_r($model->getClothsName());
        echo '<br/>褲子：';
        print_r($model->getPantsName());
        echo '<br/>手勢：';
        print_r($model->getHandsName());
        echo '<br/>鞋子：';
        print_r($model->getShoesName());
        echo '<br/>特殊寶物：';
        print_r($model->getOthersName());
        echo '<br/>經驗值：';
        print_r($model->getExpValue());
        echo '<br/>金錢：';
        print_r($model->getMoneyValue());
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
            $temp_2=$model->achievement_bag;
        // print_r($temp_2[0]->translation);
        echo $temp_2[4]->achievement_id;
        
        // echo '========================<br/>您目前的成就(' . sizeof($model->AchievementsBag()) . ')：<br/>';
        // foreach ($model->AchievementsBag() as $array)
        // {
            // echo $counter_one.'->';
            // $time_array = $model->GetAchievementsTime();
            // echo '成就id：'.$array->id.'，名稱：'.$array->name.'('.$array->description.')   ('. $array->translation->time.' 獲得)';
            // echo '<br/>';
            // $counter_one++;
        // }
        
        
        // echo '<br/><br/>';
        // echo 'TEST => 時間資料筆數 / 道具資料筆數：'.sizeof($model->GetItemsTime()).' / '.sizeof($model->ItemsBag()).'<br/>';
        // if(sizeof($model->GetItemsTime())!=sizeof($model->ItemsBag()))
            // echo 'Error => 資料庫錯誤!!! <br/>';
        // else
            // echo 'Right => 資料庫無誤!!! <br/>';
        // echo '========================<br/>您目前的道具(' . sizeof($model->ItemsBag()) . ')：<br/>';
        
        
        
        
        // foreach ($model->GetItemsTime() as $test)
        // {
            // echo $test['time'].'時間)'.$test['items_id'];
            // echo '<br/>';
        // }
        
        
        
        
        // foreach ($model->ItemsBag() as $array)
        // {
            // echo $counter_two.'->';
            // $time_array = $model->GetItemsTime();
            // print_r($time_array[$counter_two-1]->time);
            // echo '道具id：'.$array->id.'，名稱：'.$array['name'].'   ('. $time_array[$counter_two-1]->time.' 獲得)';
            // echo '<br/>';
            // $counter_two++;
        // }
        

?>
<img src="../statics/fire.png">
