<?php
    // require defaults PHPs
    require_once 'bootstrap.php';

    if(isset($_POST["commentId"])) {
        $commentId = $dbh->updateCommento($_POST["commentId"], 1, getIdUtente());
        http_response_code(200);
        exit();
    }
    setErrorMsg("Failed deleting Comment.");
    http_response_code(500);
    exit();

?>
