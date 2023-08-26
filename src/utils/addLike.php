<?php
    // require defaults PHPs
    require_once 'bootstrap.php';
    

    if(isset($_POST["postId"])) {
        $likeId = $dbh->toggleLike($_POST["postId"], getIdUtente());
        if($likeId) {
            $likes = $dbh->getLikesByPost($_POST["postId"]);
            // Add notifications
            require "addNotification.php";
            // send response
            $array = ['likes' => count($likes)];
            echo json_encode($array);
            http_response_code(200);
            exit();
        }else{
            $likes = $dbh->getLikesByPost($_POST["postId"]);
            // send response
            $array = ['likes' => count($likes)];
            echo json_encode($array);
            http_response_code(200);
            exit();
        }
    }
    // on failure
    setErrorMsg("Failed inserting like.");
    http_response_code(500);
    exit();
    
?>
