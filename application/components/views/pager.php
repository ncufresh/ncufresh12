<?php if ( $this->classname ) : ?>
<ul class="<?php echo $this->classname; ?>">
<?php else : ?>
<ul>
<?php endif; ?>
<?php if ( $this->pager['current'] > $this->pager['first'] ) : ?>
    <li>
        <a class="first" href="<?php echo Yii::app()->createUrl($this->url, array($this->pager['first'])); ?>" title="上一頁">第一頁</a>
    </li>
<?php else : ?>
    <li>
        <a class="first-disabled first">第一頁</a>
    </li>
<?php endif; ?>
<?php if ( $this->pager['current'] > $this->pager['first'] ) : ?>
    <li>
        <a class="prev" href="<?php echo Yii::app()->createUrl($this->url, array($this->parameter => $this->pager['current'] - 1)); ?>" title="上一頁">上一頁</a>
    </li>
<?php else : ?>
    <li>
        <a class="prev-disabled prev">上一頁</a>
    </li>
<?php endif; ?>
<?php for ( $page = $this->pager['first'] ; $page <= $this->pager['last'] ; ++$page ) : ?>
<?php if ( $page == $this->pager['current'] ) : ?>
    <li>
        <a class="current"><?php echo $page; ?></a>
    </li>
<?php else : ?>
    <li>
        <a href="<?php echo Yii::app()->createUrl($this->url, array($this->parameter => $page)); ?>" title="第 <?php echo $page; ?> 頁"><?php echo $page; ?></a>
    </li>
<?php endif; ?>
<?php endfor; ?>
<?php if ( $this->pager['current'] < $this->pager['last'] ) : ?>
    <li>
        <a class="next" href="<?php echo Yii::app()->createUrl($this->url, array($this->parameter => $this->pager['current'] + 1)); ?>" title="下一頁">下一頁</a>
    </li>
<?php else : ?>
    <li>
        <a class="next-disabled next">下一頁</a>
    </li>
<?php endif; ?>
<?php if ( $this->pager['current'] < $this->pager['last'] ) : ?>
    <li>
        <a class="last" href="<?php echo Yii::app()->createUrl($this->url, array($this->parameter => $this->pager['last'])); ?>" title="最終頁">最終頁</a>
    </li>
<?php else : ?>
    <li>
        <a class="last-disabled last">最終頁</a>
    </li>
<?php endif; ?>
</ul>