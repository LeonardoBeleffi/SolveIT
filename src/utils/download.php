<?php
    // require defaults PHPs
    require_once 'bootstrap.php';
    require_once 'classes/post.php';
    require_once 'classes/notification.php';
    require_once 'classes/comment.php';

    // check login routine
    checkUserLogin();

    // prepare attachments directory
    clearAttachmentsDirecory();

    $idPosts = [];

    // get specific posts
    if(isset($_SESSION['postsId'])) {
        // ToDo
        foreach($_SESSION['postsId']as $session_idPost) {
            array_push($idPosts, $session_idPost);
        }
    }
    
    // get random posts by limit
    if(isset($_SESSION['postsLimit'])) {
        // query random posts
        $result = $dbh->getLastPostsByLimit($_SESSION['postsLimit']);
        if(count($result)==0){
            setErrorMsg("Failed downloading Posts.");
            exit();
        }
        foreach($result as $res) {
            array_push($idPosts,$res["idPost"]);
        }
    }

    // query each post
    foreach($idPosts as $idPost) {
        $post = new Post();
        // query post
        $result = $dbh->getPostById($idPost);
        if(count($result)==0) {
            setErrorMsg("Failed downloading posts.");
            return -1;
        }
        $post->postId = $result[0]["postId"];
        $post->authorName = $result[0]["authorName"];
        $post->title = $result[0]["title"];
        $post->text = $result[0]["text"];
        $post->sector = $result[0]["sector"];
        $post->timestamp = $result[0]["timestamp"];
        // query attachments
        $attachs = $dbh->getAttachmentByPost($idPost);
        $_attachments = [];
        $_attachmentsType = [];
        $_attachmentsName = [];
        foreach($attachs as $attach) {
            $filename = saveAttachment($attach["name"],$attach["data"]);
            array_push($_attachments, $filename);
            array_push($_attachmentsType, $attach["type"]);
            array_push($_attachmentsName, $attach["name"]);
        }
        $post->attachments = $_attachments;
        $post->attachmentsType = $_attachmentsType;
        $post->attachmentsName = $_attachmentsName;
        // query tags
        $_tags = [];
        $tags = $dbh->getTagByPost($idPost);
        foreach($tags as $tag) {
            array_push($_tags, $tag["tagName"]);
        }
        $post->tags = $_tags;
        // query contributors
        $contributors = $dbh->getContributorsByPost($idPost);
        $_contributors = [];
        foreach($contributors as $contrib) {
            array_push($_contributors, $contrib["contributorName"]);
        }
        $post->contributors = $_contributors;
        // query comments
        $_comments = [];
        $comments = $dbh->getCommentsByPost($idPost);
        foreach($comments as $comm) {
            $comment = new Comment();
            $comment->commentId = $comm["commentId"];
            $comment->text = $comm["text"];
            $comment->author = $comm["commentAuthorName"];
            $comment->parentId = $comm["parentId"];
            $comment->timestamp = $comm["timestamp"];
            $comment->deleted = $comm["deleted"];
            array_push($_comments, $comment);
        }
        $post->comments = $_comments;
        // query likes
        $_likes = [];
        $likes = $dbh->getLikesByPost($idPost);
        foreach($likes as $like) {
            array_push($_likes, $like["username"]);
        }
        $post->likes = $_likes;
        addPost($post);
    }
        

    // download new notifications
    {
        // query all notifications
        $notifications = require "downloadNotifications.php"; 
        foreach($notifications as $not) {
            addNotification($not);
        }
        // get new notifications
        $newNotifications = getNewNotificationsFrom($notifications);
        foreach($newNotifications as $not) {
            addNewNotification($not);
        }
    }

    // header("Location: /src/test.php");
    // exit();
?>