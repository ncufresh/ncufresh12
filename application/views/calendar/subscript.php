<?php
    foreach($club_calendars as $each)
    {
        echo Club::Model()->getClubByManagerrId(2)->id;
            // echo $each->getClub($each->user_id)->id;
    }
?>
