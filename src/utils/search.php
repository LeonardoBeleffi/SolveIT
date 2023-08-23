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
        // search sectors
        $_sectors = [];
        $sectors = $dbh->getSectorsByPrefix($_POST["text"]);
        foreach($sectors as $sector) {
            // get sectors
            array_push($_sectors, $sector["sectorName"]);
        }
        // on success
        $array = ['usernames' => $_usernames,'tags' => $_tags,'sectors' => $_sectors];
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
