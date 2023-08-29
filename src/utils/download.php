<?php
    // require defaults PHPs
    require_once 'bootstrap.php';
    require_once 'classes/post.php';
    require_once 'classes/notification.php';
    require_once 'classes/comment.php';
    require_once 'classes/user.php';

    // check login routine
    checkUserLogin();

    // prepare attachments directory
    clearAttachmentsDirecory();

    $idPosts = [];

    // get specific posts
    if(isset($_SESSION['postsId'])) {
        foreach($_SESSION['postsId']as $session_idPost) {
            array_push($idPosts, $session_idPost);
        }
    }

    // get specific posts by tag
    if(isset($_SESSION['postTag'])) {
        $result = $dbh->getPostByTag($_SESSION['postTag']);
        foreach($result as $res) {
            array_push($idPosts, $res["postId"]);
        }
    }

    // get specific posts by user
    if(isset($_SESSION['postUser'])) {
        $result = $dbh->getPostByUser($_SESSION['postUser']);
        foreach($result as $res) {
            array_push($idPosts, $res["postId"]);
        }
    }

    // get posts by limit
    if(isset($_SESSION['postsLimit'])) {
        $result = $dbh->getLastPostsByLimit($_SESSION['postsLimit']);
        if(count($result)==0){
            setErrorMsg("Failed downloading Posts.");
            return -1;
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

    // get profile info
    if(isset($_SESSION['addProfileInfo']) && isset($_SESSION['postUser']) && $_SESSION['addProfileInfo']) {
        $profile = new User();
        // query post
        $result = $dbh->getUserInfoByUsername($_SESSION['postUser']);
        if(count($result)==0) {
            setErrorMsg("Failed downloading profile.");
        }
        $profile->userId = $result[0]["userId"];
        $profile->name = $result[0]["name"];
        $profile->surname = $result[0]["surname"];
        $profile->bio = $result[0]["bio"];
        $profile->email = $result[0]["email"];
        $profile->username = $result[0]["username"];
        $profile->birthDate = $result[0]["birthDate"];
        $profile->phoneNumber = $result[0]["phoneNumber"];
        // query followers
        $_followers = [];
        $followers = $dbh->getFollowersByUser($profile->userId);
        foreach($followers as $follower) {
            array_push($_followers, $follower["followerUsername"]);
        }
        $profile->followers = $_followers;
        // query followings
        $_followings = [];
        $followings = $dbh->getFollowingsByUser($profile->userId);
        foreach($followings as $following) {
            array_push($_followings, $following["followingUsername"]);
        }
        $profile->followings = $_followings;
        // get user posts
        $profile->posts = getPosts();
        addProfileInfo($profile);
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
?>