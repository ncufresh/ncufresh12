<?php $this->pageTitle = '最新消息'; ?>
這裡是最新消息~<br />

<?php foreach($news as $each):?>
    <?php echo CHtml::link($each->title, $each->url);?>
    | 時間<?php echo date('Y/m/d', $each->updated )?><br />
<?php endforeach ?>


<?php
    if($pageStatus['prevPage']!==null)
        echo CHtml::link('上一頁', Yii::app()->createUrl('news/index', array('page'=>$pageStatus['prevPage'])));
    for($i = $pageStatus['firstPage']; $i <= $pageStatus['lastPage']; $i++)
    {
        if($i == $pageStatus['currentPage'])
            echo $i;
        else
            echo CHtml::link($i, Yii::app()->createUrl('news/index', array('page'=>$i)));
    }
    if($pageStatus['nextPage']!==null)
        echo CHtml::link('下一頁', Yii::app()->createUrl('news/index', array('page'=>$pageStatus['nextPage'])));
?>