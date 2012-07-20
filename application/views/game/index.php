<script>
jQuery(document).ready(function()
{
    jQuery('#togetExp').click(function()
    {
        jQuery.get('/ncufresh12/game/togetExp.html');
        return false;
    });
});
</script>
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
        print_r($model->getUserNickName());
        echo '<br/>頭髮：';
        print_r($model->getHairName());
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

?>
<img src="../statics/fire.png">
<a id="togetExp" href="/ncufresh12/game/index.html"> 點我取得經驗值~!!! </a>