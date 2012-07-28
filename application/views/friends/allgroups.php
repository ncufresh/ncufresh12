<h1>我的群組</h1>
<div class="allgroups">
<table>
    <tr>
<?php $account = 1;?>
<?php foreach ( $groups as $mygroup ) : ?>
<?php if ( $account % 4 == 0 ) : ?>
    </tr>
    <tr>
<?php endif; ?>
        <td>
            <a href="<?php echo Yii::app()->createUrl('friends/mygroups', array('id'=>$mygroup->id));?>" class="mygroup-name"><?php echo $mygroup->name ; ?></a>
        </td>
<?php $account++; ?>
<?php endforeach; ?>
    </tr>
</table>
</div>
<button><a href="<?php echo Yii::app()->createUrl('friends/friends');?>">BACK</a></button>