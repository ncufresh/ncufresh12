<form enctype="multipart/form-data" method="POST" action="<?php echo $this->createUrl('friends/makefriends'); ?>">
<table class="other-page">
    <tr>
        
        <th colspan="5" class="friend-samediff-page">同系不同屆</th>
    </tr>
    <tr>
        <?php $row = 0;?>
        <?php $col = 1;?>
        <?php foreach ( $profiles as $profile ) :?>
            <?php if ( $row<=4 ):?> 
                        <td class="friends-allsame-ones"><img  height="70" src="
                <?php if ( $profile->picture !='' ):?>
                            <?php echo $target.'/'.$profile->picture;?> 
                <?php else:?>
                            <?php echo $target.'/image1.jpg';?>
                 <?php endif;?>
                        " alt="Score image"/><br /><input type="checkbox" name="friends[<?php echo $profile->id;?>]" value="<?php echo $profile->id;?>"  />
                        <?php echo $profile->name;?>
                        <br />
                        <?php echo $user->profile->department->short_name; ?>
                        </td>
                        <?php if ( $col%5==0 ) :?>
                            <?php $row+=1;?>
                        <?php endif;?>
                            </tr>
                            <tr>
            <?php endif;?>
            <?php $col++;?>
        <?php endforeach; ?>
        <?php if ( $col%5!=0 ):?>
            </tr>
        <?php endif;?>
</table> 
<button id="form-samedepartmentdiffgrade-rechoose" type="submit" name="samedepartmentdiffgrade-rechoose">重選</button>
<button id="form-samedepartmentdiffgrade-ensure" type="submit" name="samedepartmentdiffgrade-ensure">確定加為好友</button>
<button id="form-samedepartmentdiffgrade-cancel" type="submit" name="samedepartmentdiffgrade-cancel">取消/BACK</button>
</form>