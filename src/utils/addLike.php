<?php
    // require defaults PHPs
    require_once 'bootstrap.php';
    

    if(isset($_POST["postId"])) {
        $likeId = $dbh->insertLike($_POST["postId"], getIdUtente());
        if($likeId) {
            $likes = $dbh->getLikesByPost($_POST["postId"]);
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
