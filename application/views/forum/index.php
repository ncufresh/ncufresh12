論壇專區<br />
<?php 
    echo CHtml::link('綜合討論', Yii::app()->createUrl('forum/forum', array('fid' => 1, 'sort' => 'create'))) . '<br/>';
    echo CHtml::link('系所社團', Yii::app()->createUrl('forum/forumlist')).'<br/>';
    echo CHtml::link('社團討論', Yii::app()->createUrl('forum/forum', array('fid' => 2, 'sort' => 'create')));
?>