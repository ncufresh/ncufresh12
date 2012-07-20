</table>
<table class="other-page">
   <tr >
    <th colspan="5" class="friend-close-page">我的好友</th>
    </tr>
        <tr>
        <?php 
        $row = 0;
        $col = 1;
        foreach ( $user->friends as $friend ) :
            if ( $row<=4 )   //限顯現4行
            { 
            
                if ( $friend->profile->picture !='' )
                {
        ?>
                    <td class="friends-close-ones"><img  height="70" width="70" src=" <?php echo $target.'/'.$friend->profile->picture; ?>" alt="Score image"/><br /><input type="checkbox" name="friend[]" value="<?php $friend->id;?>"  /><?php echo $friend->profile->name;?></td>
                <?php
                }
                else
                {
                ?>
                    <td class="friends-close-ones"><img  height="70" width="70" src=" <?php echo $target.'/image1.jpg'; ?>" alt="Score image"/><br /><input type="checkbox" name="friend[]" value="<?php echo $friend->id;?>"  /><?php echo $friend->profile->name;?></td>
                <?php
                }
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
<button id="form-otherdepartment-rechoose" type="submit" name="myfriends-rechoose">重選</button>
<button id="form-otherdepartment-ensure" type="submit" name="myfriends-ensure">確定加為好友</button>
<button id="form-otherdepartment-cancel" type="submit" name="myfriends-cancel">取消</button>
