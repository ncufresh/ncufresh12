</table>
<table class="other-page" border="1">
   <tr>
    <th colspan="5" class="friend-close-ones-page">我的好友</th>
    </tr>
    <?php 
        $row=0;
        $col=1;
        echo '<tr>';
        foreach ( $user->friends as $friend ) :
            if ( $row<=4 )   //限顯現4行
            { 
            
                if ( $friend->profile->picture !='' )
                {
                    echo '<td><img class="user_img" src="'.$target.'/'.$friend->profile->picture.'" alt="Score image"/><br /><input type="checkbox" name="friend[]" value="'.$friend->id.'"  />'.$friend->profile->name.'</td>';
                }
                else
                {
                    echo '<td><img class="user_img" src="'.$target.'/image1.jpg" alt="Score image"/><br /><input type="checkbox" name="friend[]" value="'.$friend->id.'"  />'.$friend->profile->name.'</td>';
                }
                /*echo '<td><img class="user_img" src="'.$target.'/'.$friend->profile->picture.'" alt="Score image"/><br /><input type="checkbox" name="friend[]" value="'.$friend->id.'"  />'.$friend->profile->name.'</td>';*/
                if ( $col%5==0 ) 
                {
                    echo '</tr>';
                    echo '<tr>';
                    $row+=1;
                }
            }
            $col++;
        endforeach; 
        if ( $col%5!=0 )
            echo '</tr>';
    ?>
</table>
<button id="form-otherdepartment-rechoose" type="submit" name="myfriends-rechoose">重選</button>
<button id="form-otherdepartment-ensure" type="submit" name="myfriends-ensure">確定加為好友</button>
<button id="form-otherdepartment-cancel" type="submit" name="myfriends-cancel">取消</button>
