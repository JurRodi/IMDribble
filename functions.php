<?php 

    function getTimeDiff($time){
        $currentTime = new DateTime();
        $calcTime = new DateTime($time);
        $timeDiff = $calcTime->diff($currentTime);
        return $timeDiff->format('%y year %m month %d days %h hours %i minutes');
    }    