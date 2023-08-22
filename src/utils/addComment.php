<?php
    // require defaults PHPs
    require_once 'bootstrap.php';
    
    if(isset($_POST["parentCommentId"]) && isset($_POST["postId"]) && isset($_POST["text"])) {
        if($_POST["parentCommentId"]=="null") {
            $_POST["parentCommentId"]=null;
        }
        $commentId = $dbh->insertCommento($_POST["postId"], getIdUtente(), $_POST["text"], date("Y-m-d H:i:s"), $_POST["parentCommentId"]);
        $comments = $dbh->getCommentsByPost($_POST["postId"]);
        $array = ['commentId' => $commentId, 'commentNumber' => count($comments)];
        echo json_encode($array);
        http_response_code(200);
        exit();
    }
    setErrorMsg("Failed uploading Comment.");
    http_response_code(500);
    exit();
    
?>
