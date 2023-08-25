<?php
    // require defaults PHPs
    require_once 'bootstrap.php';
    require_once 'functions/redirectFunctions.php';
    require_once 'functions/loginFunctions.php';
    require_once 'functions/templateFunctions.php';
    require_once 'functions/postFunctions.php';
    require_once 'functions/notificationFunctions.php';

    function getSessionVar($var) {
        return isset($_SESSION[$var]) ? $_SESSION[$var] : "";
    }

    function getSessionArray($var) {
        return isset($_SESSION[$var]) ? $_SESSION[$var] : [];
    }

    function setErrorMsg($errorMsg){
        $_SESSION["errorMsg"] = $errorMsg;
    }

    function getErrorMsg(){
        return getSessionVar("errorMsg");
    }

    function loadErrorMsg(){
        $msg = getErrorMsg();
        setErrorMsg("");
        if(empty($msg)) return;
        echo    "<div class=\"errorDiv\">" .
                    "<p class=\"errorP\">" .
                        "ERROR:" . $msg .
                    "</p>" .
                "</div>";
    }

    function timeDifferenceToText($startTimeStr, $endTimeStr) {
        $startTime = strtotime($startTimeStr);
        $endTime = strtotime($endTimeStr);
    
        $timeDifferenceInSeconds = $endTime - $startTime;
        $ret = "";
        
        if ($timeDifferenceInSeconds >= 31536000) {
            // Difference is greater than or equal to 1 year
            $years = floor($timeDifferenceInSeconds / 31536000);
            $ret = $years . "y";
        } /*elseif ($timeDifferenceInSeconds >= 2592000) {
            // Difference is greater than or equal to 1 month
            $months = floor($timeDifferenceInSeconds / 2592000);
            $ret = $months . "m";
        }*/ elseif ($timeDifferenceInSeconds >= 604800) {
            // Difference is greater than or equal to 1 week
            $weeks = floor($timeDifferenceInSeconds / 604800);
            $ret = $weeks . "w";
        } elseif ($timeDifferenceInSeconds >= 86400) {
            // Difference is greater than or equal to 1 day
            $days = floor($timeDifferenceInSeconds / 86400);
            $ret = $days . "d";
        } elseif ($timeDifferenceInSeconds >= 3600) {
            // Difference is less than 1 day
            $hours = floor($timeDifferenceInSeconds / 3600);
            $ret = $hours . "h";
        } elseif ($timeDifferenceInSeconds >= 60) {
            // Difference is less than 1 hour
            $minutes = round($timeDifferenceInSeconds / 60);
            $ret = $minutes . "m";
        } else {
            // Difference is less than 1 hour
            $seconds = round($timeDifferenceInSeconds);
            $ret = $seconds . "s";
        }
        return $ret;
    }
    
?>

