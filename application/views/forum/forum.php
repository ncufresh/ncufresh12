文章列表<br />
<?php 
    echo $fid . '<br />';
    echo CHtml::link('發表文章', 'create?fid=' . $fid) . '<br />';
    if ( ! empty($model) ) echo 'hi';
?>