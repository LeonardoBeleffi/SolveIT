<?php
    // require defaults PHPs
    require_once 'bootstrap.php';
    require_once 'functions/redirectFunctions.php';
    require_once 'functions/loginFunctions.php';
    require_once 'functions/templateFunctions.php';

    function getSessionVar($var) {
        return isset($_SESSION[$var]) ? $_SESSION[$var] : "";
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
?>

