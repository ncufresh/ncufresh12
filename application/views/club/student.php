<div class ="alltag"> 
    <a href="<?php echo Yii::app()->createUrl('club/department');?>" title="系所"><div class = "department-head"></div></a>
    <a href="<?php echo Yii::app()->createUrl('club/student');?>" title="學生組織"><div class = "student-head"></div></a>
    <a href="<?php echo Yii::app()->createUrl('club/club');?>" title="社團"><div class = "club-head"></div></a>
</div>
<div class="student">
    <div class="student-list">
        <ul>
            <li>
                <a href="<?php echo Yii::app()->createUrl('club/content', array('id' => 100));?>" title="親善大使團">親善大使團</a>
            </li>
            <li>
                <a href="<?php echo Yii::app()->createUrl('club/content', array('id' => 101));?>" title="學生會">學生會</a>
            </li>            
			<li>
                <a href="<?php echo Yii::app()->createUrl('club/content', array('id' => 103));?>" title="伙委會">伙委會</a>
            </li>                      
            <li>
                <a href="<?php echo Yii::app()->createUrl('club/content', array('id' => 107));?>" title="小松鼠志工隊">小松鼠志工隊</a>
            </li>
            <li>
                <a href="<?php echo Yii::app()->createUrl('club/content', array('id' => 108));?>" title="松濤電台">松濤電台 </a>
            </li>
        </ul>        
        <ul>
            <li>
                <a href="<?php echo Yii::app()->createUrl('club/content', array('id' => 105));?>" title="網球隊">網球隊 </a>
            </li>
			<li>
                <a href="<?php echo Yii::app()->createUrl('club/content', array('id' => 106));?>" title="女子籃球隊">女子籃球隊</a>
            </li>
            <li>
                <a href="<?php echo Yii::app()->createUrl('club/content', array('id' => 102));?>" title="中央游泳隊">中央游泳隊 </a>
            </li>
            <li>
                <a href="<?php echo Yii::app()->createUrl('club/content', array('id' => 104));?>" title="棒球隊">棒球隊</a>
            </li>  
        </ul>
    </div>
</div>