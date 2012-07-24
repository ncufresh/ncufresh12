<form method="POST" action="<?php echo $this->createUrl('friends/deletemembers', array('id'=>$mygroup->id)); ?>">
<input type="hidden" name="token" value="<?php echo Yii::app()->security->getToken();?>" />
<table>
    <tr>
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
            <?php if ( $profile->picture !='' ):?>
                      <?php echo $target.'/'.$profile->picture; ?>
            <?php else:?>
                     <?php echo $target.'/image1.jpg'; ?>
             <?php endif;?>
                    " alt="Score image"/>
                    <br />
                    <input type="checkbox" name="members[<?php echo $profile->id;?>]" value="<?php echo $profile->id;?>" />
                    <?php echo $profile->name;?>
                    <br />
                    <?php echo $profile->department->short_name;?>
                    </td>
                    <?php if ( $col%5==0 ): ?>
                        <?php $row+=1;?>
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
<button type="submit">退出社團</button>
</form>
<button><a href="<?php echo Yii::app()->createUrl('friends/friends')  ?>">BACK</a></button>
<button><a href="<?php echo Yii::app()->createUrl('friends/deletegroup', array('id'=>$mygroup->id))  ?>">刪除群組</a></button>
<button   id="mygroups-add-member">+新成員</button>
<div class="add-members" title="+新朋友">
<form method="POST" action="<?php echo Yii::app()->createUrl('friends/addnewmembers', array('id'=>$mygroup->id))  ?>">
<input type="hidden" name="token" value="<?php echo Yii::app()->security->getToken();?>" />
        <div>
            <label>成員: </label>
        </div>
        <div class="group-all-friends">
            <table>
                <tr>
                <?php $account = 1;?>
                <?php foreach ( $user->friends as $friend ) :?>
                    <?php if ( $account%5!=0 ):?>
                    <?php else:?> 
                        </tr>
                        <tr>
                     <?php $account ++; ?>
                    <?php endif;?>
                            <td><img  height="50" src="
                            <?php if ( $friend->profile->picture !='' ):?>
                                <?php echo $target.'/'.$friend->profile->picture; ?>
                            <?php else:?>
                                <?php echo $target.'/image1.jpg';?>
                            <?php endif;?>    
                                " alt="Score image"/><br /><input type="checkbox" name="friends[<?php echo $friend->profile->id;?>]" value="<?php echo $friend->profile->id;?>"/>
                                <?php echo $friend->profile->name;?>
                                <br />
                                <?php echo $friend->profile->department->short_name; ?>
                            </td>
                    <?php $account++;?>
                <?php endforeach; ?>
                <?php if ( $account%5!=0 ):?>
                    </tr>
                <?php endif;?>
            </table>
        </div>
    <div>
    <button name="addmember">新增</a>
    <button onclick="javascript:$('.add-members').dialog('close')">取消</a>
    </div>
</form>
</div>