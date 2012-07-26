<table>
    <tr>
        <th colspan="5">我的群組</th>
    </tr>
    <tr>
<?php $row = 0; ?>
<?php $col = 1; ?>
<?php foreach ( $groups as $mygroup ) : ?>
<?php if ( $row<=4 ) : ?>
        <td>
            <a href="<?php echo Yii::app()->createUrl('friends/mygroups', array('id'=>$mygroup->id));?>" class="mygroup"><?php echo $mygroup->name ; ?></a>
        </td>
<?php if ( $col%5==0 ) : ?>
<?php $row+=1;?>
    </tr>
    <tr>
<?php endif; ?>
<?php endif; ?>
<?php $col++; ?>
<?php endforeach; ?>
<?php if ( $col%5!=0 ): ?>
    </tr>
<?php endif;?>
</table>
<button>
<a href="<?php echo Yii::app()->createUrl('friends/friends');?>">BACK</a>
</button>