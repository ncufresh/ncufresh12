<?php $this->pageTitle = '最新消息'; ?>

這裡是最新消息~<br />
<?php
    foreach($news as $each){
        echo $each->title . '<br />';
    }
?>