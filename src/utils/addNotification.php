<?php
    // require defaults PHPs
    require_once 'bootstrap.php';

    // comment notification
    if(isset($_POST['postId']) && isset($_POST['parentCommentId'] )) {
        // notify post author
        $dbh->insertNotifica(getIdUtente(), $dbh->getAuthorByPost($_POST["postId"])[0]["userId"], $_POST["postId"],getCommentToPostNotificationType(), 0, date("Y-m-d H:i:s"));
        // notify parent comment author
        if($_POST["parentCommentId"]!=null) {
            $dbh->insertNotifica(getIdUtente(), $dbh->getUserByComment($_POST["parentCommentId"])[0]["userId"], $_POST["postId"], getCommentToCommentNotificationType(), 0, date("Y-m-d H:i:s"));
        }
        // notify post contributors 
        foreach($dbh->getContributorsByPost($_POST["postId"]) as $contrib) {
            $dbh->insertNotifica(getIdUtente(), $contrib["contributorId"], $_POST["postId"], getCommentToContributedPostNotificationType(), 0, date("Y-m-d H:i:s"));
        }    
    }

    // like notification
    if(isset($_POST['postId'])) {
        // notify post author
        $dbh->insertNotifica(getIdUtente(), $dbh->getAuthorByPost($_POST["postId"])[0]["userId"], $_POST["postId"], getLikeNotificationType(), 0, date("Y-m-d H:i:s"));
        // notify post contributors 
        foreach($dbh->getContributorsByPost($_POST["postId"]) as $contrib) {
            $dbh->insertNotifica(getIdUtente(), $contrib["contributorId"], $_POST["postId"], getLikeNotificationType(), 0, date("Y-m-d H:i:s"));
        }    
    }

    // follow notification
    if(isset($_POST['username'])) {
        // notify user
        $dbh->insertNotifica(getIdUtente(), $dbh->getUserByUsername($_POST["username"])[0]["userId"], NULL, getFollowNotificationType(), 0, date("Y-m-d H:i:s"));
    }

?>