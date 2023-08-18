<?php
    // require defaults PHPs
    require_once 'bootstrap.php';
    
    if(isset($_POST["parentCommentId"]) && isset($_POST["text"])) {
        // get idPost
        $result = $dbh->getPostByCommentId($_POST["parentCommentId"]);
        if(!count($result)==0){
            $postId = $result[0]["postId"];
            // on success
            $commentId = $dbh->insertCommento($postId, getIdUtente(), $_POST["text"], date("Y-m-d H:i:s"), $_POST["parentCommentId"]);
            $array = ['commentId' => $commentId];
            echo json_encode($array);
            http_response_code(200);
            exit();
        }
    }
    // on failure
    setErrorMsg("Failed uploading Comment.");
    http_response_code(500);
    exit();
    
?>
