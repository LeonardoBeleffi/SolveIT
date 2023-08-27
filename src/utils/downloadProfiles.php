<?php
    // require defaults PHPs
    require_once 'bootstrap.php';
    require_once 'classes/post.php';
    require_once 'classes/comment.php';

    // prepare attachments directory
    clearAttachmentsDirecory();

    $profiles = [];
    $profilesName = [];

    // get specific profiles
    if(isset($_SESSION['profiles'])) {
        foreach($_SESSION['profiles']as $session_profileName) {
            array_push($profilesName, $session_profileName);
        }
    }

    // query each post
    foreach($profilesName as $profileUsername) {
        $profile = new User();
        // query post
        $result = $dbh->getUserInfoByUsername($profileUsername);
        if(count($result)==0) {
            setErrorMsg("Failed downloading profile.");
            return [];
        }
        $profile->$userId = $result[0]["userId"];
        $profile->$name = $result[0]["name"];
        $profile->$surname = $result[0]["surname"];
        $profile->$bio = $result[0]["bio"];
        $profile->$email = $result[0]["email"];
        $profile->$username = $result[0]["username"];
        $profile->$birthDate = $result[0]["birthDate"];
        $profile->$mobile = $result[0]["mobile"];
        // get user followings
        // get user followers
        // get user posts
        $profile->$posts = $result[0]["posts"];
        $profile->$followers = $result[0]["followers"];
        $profile->$followings = $result[0]["followings"];
        array_push($profiles, $profile);
    }

    return $profiles;
?>