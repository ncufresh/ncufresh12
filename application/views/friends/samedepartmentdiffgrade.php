<form enctype="multipart/form-data" method="POST" action="<?php echo $this->createUrl('friends/makefriends'); ?>">
<table class="other-page">
    <tr>
        
        <th colspan="5" class="friend-samediff-page">同系不同屆</th>
    </tr>
    <tr>
        <?php 
        $row = 0;
        $col = 1;
        foreach ( $profiles as $profile ) :
            if ( $row<=4 )   //限顯現4行
            { 
        ?>
                <td class="friends-allsame-ones"><img  height="70" src="
        <?php
                if ( $profile->picture !='' )
                {
                    echo $target.'/'.$profile->picture; 
                }
                else
                { 
                    echo $target.'/image1.jpg';
                }
        ?>
                " alt="Score image"/><br /><input type="checkbox" name="friends[]" value="<?php echo $profile->id;?>"  /><?php echo $profile->name;?></td>
                <?php
                if ( $col%5==0 ) 
                {
                    $row+=1;
                ?>
                    </tr>
                    <tr>
        <?php
                }
            }
            $col++;
        endforeach; 
        if ( $col%5!=0 )
        {
        ?>
            </tr>
        <?php
        }
        ?>
</table> 
<button id="form-samedepartmentdiffgrade-rechoose" type="submit" name="samedepartmentdiffgrade-rechoose">重選</button>
<button id="form-samedepartmentdiffgrade-ensure" type="submit" name="samedepartmentdiffgrade-ensure">確定加為好友</button>
<button id="form-samedepartmentdiffgrade-cancel" type="submit" name="samedepartmentdiffgrade-cancel">取消/BACK</button>
</form>