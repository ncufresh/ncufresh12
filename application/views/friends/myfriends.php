<form method="POST" action="<?php echo $this->createUrl('friends/deletefriends'); ?>">
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
        ?>
                <td class="friends-close-ones"><img  height="70" src="
        <?php
                if ( $friend->profile->picture !='' )
                {
                    echo $target.'/'.$friend->profile->picture;             
                }
                else
                {
                    echo $target.'/image1.jpg'; 
                }
        ?>
                " alt="Score image"/><br /><input type="checkbox" name="friends[]" value="<?php echo $friend->profile->id;?>" />
                <?php echo $friend->profile->name;?>
                <br />
                <?php echo $friend->profile->department->short_name ?>
                </td>
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
<button id="form-otherdepartment-cancel" type="submit" name="myfriends-cancel">取消好友/BACK</button>
</form>