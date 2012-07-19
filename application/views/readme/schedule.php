行事曆
<a href="index.html">上一頁</a>
<?php
    echo $model->title;
    echo $model->content;
    if ($model->status==0)
    {
     ?><button class="schedule-change">Dimo</button><?php
    }
    
    else
    {
    ?>
    <button class="schedule-change"> Simomo</button>
         <?php
        
    }
?>

