<table class="other-page"">
   <tr>
        <th colspan="5" class="friend-other-page">同屆同系</th>
   </tr>
   <tr>
        <?php 
        $row = 0;
        $col = 1;
        foreach ( $profiles as $profile ) :
            if ( $row<=4 )   //限顯現4行
            { 
            
                if ( $target.'/'.$profile->picture !='' )
                {
        ?>
                    <td class="friends-close-ones"><img  height="70" width="70" src=" <?php echo $target.'/'.$profile->picture; ?>" alt="Score image"/><br /><input type="checkbox" name="samedepartment[]" value="<?php $profile->id;?>"  /><?php echo $profile->name;?></td>
                <?php
                }
                else
                {
                ?>
                    <td class="friends-close-ones"><img  height="70" width="70" src=" <?php echo $target.'/image1.jpg'; ?>" alt="Score image"/><br /><input type="checkbox" name="samedepartment[]" value="<?php echo $profile->id;?>"  /><?php echo $profile->name;?></td>
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
<button id="form-samedepartmentsamegrade-rechoose" type="submit" name="samedepartmentsamegrade-rechoose">重選</button>
<button id="form-samedepartmentsamegrade-ensure" type="submit" name="samedepartmentsamegrade-ensure">確定加為好友</button>
<button id="form-samedepartmentsamegrade-cancel" type="submit" name="samedepartmentsamegrade-cancel">取消</button>