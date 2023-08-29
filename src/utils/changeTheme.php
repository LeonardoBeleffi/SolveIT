<?php
    // require defaults PHPs
    require_once 'bootstrap.php';

      
    echo '<script>console.log("prova");</script>';
    updateUserTheme(getIdUtente());
    echo '<script>console.log("prova");</script>';
    goToSettings();
/*
    $likeId = $dbh->toggleLike($_POST["postId"], getIdUtente());
    if($likeId) {
            // Add notifications
        require "addNotification.php";
    }
    $likes = $dbh->getLikesByPost($_POST["postId"]);
        // get if current user liked the post
    $isLiked = 0;
    foreach($likes as $like) {
        if(getIdUtente() == $like["userId"]) {
            $isLiked = 1;
        }
    }
    // send response
    $array = ['likes' => count($likes), 'isLiked' => $isLiked];
    echo json_encode($array);
    http_response_code(200);
    exit();
    // on failure
    setErrorMsg("Failed inserting like.");
    http_response_code(500);
    exit();
*/
?>

