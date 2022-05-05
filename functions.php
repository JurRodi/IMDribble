<?php 

    function getTimeDiff($time){
        $currentTime = new DateTime();
        $calcTime = new DateTime($time);
        $timeDiff = $calcTime->diff($currentTime);
        if($timeDiff->y > 0){
            $displayedTime = $timeDiff->y . " years ago";
        }elseif($timeDiff->m > 0){
            $displayedTime = $timeDiff->m . " months ago";
        }elseif($timeDiff->d > 0){
            $displayedTime = $timeDiff->d . " days ago";
        }elseif($timeDiff->h > 0){
            $displayedTime = $timeDiff->h . " hours ago";
        }elseif($timeDiff->i > 0){
            $displayedTime = $timeDiff->i . " minutes ago";
        }
        return $displayedTime;
    }    