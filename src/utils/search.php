<?php
    // require defaults PHPs
    require_once 'bootstrap.php';
    
    if(isset($_POST["text"])) {
        // search usernames
        $_usernames = [];
        $users = $dbh->getUsersByPrefix($_POST["text"]);
        foreach($users as $user) {
            // get usernames
            array_push($_usernames, $user["username"]);
        }
        // search tags
        $_tags = [];
        $tags = $dbh->getTagsByPrefix($_POST["text"]);
        foreach($tags as $tag) {
            // get tags
            array_push($_tags, $tag["name"]);
        }
        // on success
        $array = ['usernames' => $_usernames,'tags' => $_tags];
        echo json_encode($array);
        http_response_code(200);
        exit();   
    }
    // search posts

    // on failure
    setErrorMsg("Failed uploading Comment.");
    http_response_code(500);
    exit();
    
?>
