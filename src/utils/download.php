<?php
    // require defaults PHPs
    require_once 'bootstrap.php';
    require_once 'classes/post.php';
    require_once 'classes/comment.php';

    // check login routine
    checkUserLogin();

    // clear all files

    // get specific posts
    if(isset($_SESSION['postsId'])) {
        // ToDo
    }

    // get random posts by limit
    if(isset($_SESSION['postsLimit'])) {
        // query random posts
        $result = $dbh->getRandomIdPostsByLimit($_SESSION['postsLimit']);
        if(count($result)==0){
            setErrorMsg("Failed downloading Posts.");
            if($_SESSION["DEBUG"]) 
                echo "Failed downloading Posts.";
            exit();
        }

        $idPosts = [];
        foreach($result as $res) {
            array_push($idPosts,$res["idPost"]);
        }
        // query each post
        foreach($idPosts as $idPost) {
            if($_SESSION["DEBUG"]) 
                echo "idPost:".$idPost.PHP_EOL;
            $post = new Post();
            // query post
            $result = $dbh->getPostById($idPost);
            $post->postId = $result[0]["postId"];
            $post->postId = $result[0]["authorName"];
            $post->title = $result[0]["title"];
            $post->text = $result[0]["text"];
            $post->sector = $result[0]["sector"];
            $post->timestamp = $result[0]["timestamp"];
            if($_SESSION["DEBUG"]) 
            echo    "postId:".$result[0]["postId"].PHP_EOL.
                    "authorName:".$result[0]["authorName"].PHP_EOL.
                    "title:".$result[0]["title"].PHP_EOL.
                    "text:".$result[0]["text"].PHP_EOL.
                    "sector:".$result[0]["sector"].PHP_EOL.
                    "timestamp:".$result[0]["timestamp"].PHP_EOL;
            // query attachments
            $attachs = $dbh->getAttachmentByPost($idPost);
            $_attachments = [];
            $_attachmentsType = [];
            $_attachmentsName = [];
            foreach($attachs as $attach) {
                $filename = $ATTACHMENTS_DIRECTORY."/".$attach["name"];
                file_put_contents($filename, $attach["data"]);
                array_push($_attachments, $filename);
                array_push($_attachmentsType, $attach["type"]);
                array_push($_attachmentsName, $attach["name"]);
                if($_SESSION["DEBUG"]) 
                echo    
                    "attachmentsType:".$attach["type"].PHP_EOL.
                    "attachmentsName:".$attach["name"].PHP_EOL;
            }
            $post->attachments = $_attachments;
            $post->attachmentsType = $_attachmentsType;
            $post->attachmentsName = $_attachmentsName;
            // query tags
            $_tags = [];
            $tags = $dbh->getTagByPost($idPost);
            foreach($tags as $tag) {
                array_push($_tags, $tag["tagName"]);
                if($_SESSION["DEBUG"]) 
                echo    
                        "tagName:".$tag["tagName"].PHP_EOL;
            }
            $post->tags = $_tags;
            // query contributors
            $contributors = $dbh->getContributorsByPost($idPost);
            $_contributors = [];
            foreach($contributors as $contrib) {
                array_push($_contributors, $contrib["contributorName"]);
                if($_SESSION["DEBUG"]) 
                echo    
                    "contributors:".$contrib["contributorName"].PHP_EOL;
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
                array_push($_comments, $comment);
                if($_SESSION["DEBUG"]) 
                    echo    
                        "--comment:".$comm["text"].PHP_EOL.
                        "--commentAuthor:".$comm["commentAuthorName"].PHP_EOL;
            }
            $post->comments = $_comments;
            // query likes
            $_likes = [];
            $likes = $dbh->getLikesByPost($idPost);
            foreach($likes as $like) {
                array_push($_likes, $like["username"]);
                if($_SESSION["DEBUG"]) 
                echo    
                    "like:".$like["username"].PHP_EOL;
            }
            $post->likes = $_likes;
            addPost($post);
        }
    
    }
    // header("Location: /src/test.php");
    // exit();
?>