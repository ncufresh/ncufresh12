<?php
    foreach($club_calendars as $each)
    {
        echo Club::Model()->getClubByManagerrId($each->user_id)->id;
            // echo $each->getClub($each->user_id)->id;
    }
?>
