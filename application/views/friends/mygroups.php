<form method="POST" action="<?php echo $this->createUrl('friends/deletegroupfriends'); ?>">
<input type="hidden" name="token" value="<?php echo Yii::app()->security->getToken();?>" />
<input type="hidden" name="groupID" value="<?php echo $mygroup->id; ?>" />
<table>
   <tr >
    <th colspan="5" class="mygroup-name" ><?php echo $mygroup->name; ?></ th>
    </tr>
    <tr>
        <?php 
        $row = 0;
        $col = 1;
        ?>
       <?php  foreach ($members as $member ): ?>
        <?php $profile = Profile::model()->findByPK($member->user_id);?>
        <?php if ( $row<=4 ) :?> 
               <td class="friends-close-ones"><img  height="70" src="
        <?php
                if ( $profile->picture !='' ):
                    echo $target.'/'.$profile->picture; 
                else:
                    echo $target.'/image1.jpg'; 
                 endif;
        ?>
                " alt="Score image"/>
                <br />
                <input type="checkbox" name="members[<?php echo $profile->id;?>]" value="<?php echo $profile->id;?>" />
                <?php echo $profile->name;?>
                <br />
                <?php echo $profile->department->short_name;?>
                </td>
                <?php
                    if ( $col%5==0 ): 
                        $row+=1;
                    ?>
                     </tr>
                     <tr>
                   <?php endif;?>
            <?php endif?>
           <?php $col++;?>
        <?php endforeach;?>
        <?php if ( $col%5!=0 ):?>
            </tr>
        <?php endif;?>
</table>
<button  type="submit" name="myfriends-cancel">退出社團</button>
<button  type="submit" name="myfriends-backl">BACK</button>
</form>