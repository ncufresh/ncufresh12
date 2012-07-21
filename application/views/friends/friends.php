<h2>好友專區</h2>
    <table class="sep-group">
        <tr class="friends-title" >
        <th colspan="4" class="form-friends-sort-title" >新增好友</a></th
        </tr>
        <tr class="friends-title" >
        <th colspan="4" class="form-friends-title"><a href="<?php echo Yii::app()->createUrl('friends/samedepartmentsamegrade'); ?>" title="同系同屆" class="form-friends-title">同系同屆</a></th> <!--重新導向一個自訂的網頁-->
        </tr>
        <tr>
        <?php 
        $account = 1;
        foreach ( $profileFir as $profilefir ) :
            if ( $account<=4 )   //限顯現4人
            { 
                if ( $profilefir->picture !='' )
                {
        ?>  
                    <td class="friends-samediff-ones"><img  height="70" src=" <?php echo $target.'/'.$profilefir->picture; ?>" alt="Score image"/><br /><?php echo $profilefir->name;?></td>
                <?php
                }
                else
                {
                ?>
                    <td class="friends-close-ones"><img  height="70" src=" <?php echo $target.'/image1.jpg'; ?>" alt="Score image"/><br /><?php echo $profilefir->name;?></td>
        <?php
                }
            $account++;
            }
            else
            {
                break;
            }
        endforeach; 
        ?>
        </tr>
        <tr class="friends-title">
        <th align="center";  colspan="4" class="form-friends-title" ><a href="<?php echo Yii::app()->createUrl('friends/samedepartmentdiffgrade'); ?>" title="同系不同屆" class="form-friends-title">同系不同屆</a></th> <!--重新導向一個自訂的網頁-->
        </tr>
        <tr>
        <?php 
        $account = 1;
        foreach ( $profileSec as $profilesec ) :
            if ( $account<=4 )   //限顯現4人
            { 
                if ( $profilesec->picture !='' )
                {
        ?>  
                    <td class="friends-samediff-ones"><img  height="70" src=" <?php echo $target.'/'.$profilesec->picture; ?>" alt="Score image"/><br /><?php echo $profilesec->name;?></td>
                <?php
                }
                else
                {
                ?>
                    <td class="friends-close-ones"><img  height="70" src=" <?php echo $target.'/image1.jpg'; ?>" alt="Score image"/><br /><?php echo $profilesec->name;?></td>
        <?php
                }
            $account++;
            }
            else
            {
                break;
            }
        endforeach; 
        ?>
        </tr>
        <tr class="friends-title">
        <th colspan="4" class="form-friends-title" ><a href="<?php echo Yii::app()->createUrl('friends/otherdepartment'); ?>" title="其他科系" class="form-friends-title">其他科系</a></th> <!--重新導向一個自訂的網頁-->
        </tr>
        <tr>
        <?php 
        $account = 1;
        foreach ( $profileThir as $profilethir ) :
            if ( $account<=4 )   //限顯現4人
            { 
                if ( $profilethir->picture !='' )
                {
        ?>  
                    <td class="friends-samediff-ones"><img  height="70" src=" <?php echo $target.'/'.$profilethir->picture; ?>" alt="Score image"/><br /><?php echo $profilethir->name;?></td>
                <?php
                }
                else
                {
                ?>
                    <td class="friends-close-ones"><img  height="70" src=" <?php echo $target.'/image1.jpg'; ?>" alt="Score image"/><br /><?php echo $profilethir->name;?></td>
        <?php
                }
            $account++;
            }
            else
            {
                break;
            }
        endforeach; 
        ?>
        </tr>
    </table>
    <table class="close-group">
        <tr class="friends-title" >
        <th colspan="5" class="form-friends-sort-title" >好友分類</a></th>
        </tr>
        <tr>
        <th colspan="5" class="form-friends-title" ><a href="<?php echo Yii::app()->createUrl('friends/myfriends'); ?>" title="朋友" class="form-friends-title">朋友</a></th> <!--重新導向一個自訂的網頁-->
        </tr>
        <tr>
        <?php 
        $account = 1;
        foreach ( $profileFor->friends as $friend ) :
            if ( $account<=5 )   //限顯現4人
            { 
                if ( $friend->profile->picture !='' )
                {
        ?>  
                    <td class="friends-close-ones"><img  height="70" src=" <?php echo $target.'/'.$friend->profile->picture; ?>" alt="Score image"/><br /><?php echo $friend->profile->name;?></td>
                <?php
                }
                else
                {
                ?>
                    <td class="friends-close-ones"><img  height="70" src=" <?php echo $target.'/image1.jpg'; ?>" alt="Score image"/><br /><?php echo $friend->profile->name;?></td>
        <?php
                }
            $account++;
            }
            else
            {
                break;
            }
        endforeach; 
        ?>
        </tr>
        <tr>
        <th colspan="5" class="form-friends-title"><a href="<?php echo Yii::app()->createUrl('site/index'); ?>" title="自訂" class="form-friends-title">自訂</a></th> <!--跳出視窗-->
        </tr>
    </table>
