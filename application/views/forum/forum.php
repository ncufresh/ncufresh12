文章列表<br />
<?php 
    echo $fid . '<br />';
    echo CHtml::link('發表文章', Yii::app()->createUrl('forum/create', array('fid' => $fid))) . '<br />';
    if ( ! empty($model) ) echo 'hi'.'<br/>';
    foreach($model as $each){
        //echo $each->title.'<br/>';
        echo CHtml::link($each->title, $each->url) . '<br />';
    }
?>