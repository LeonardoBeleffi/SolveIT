<?php

    // ----------------- POST-QUERY functions
    function clearPosts(){
        unset($_SESSION["posts"]);
        unset($_SESSION["postsLimit"]);
        unset($_SESSION["postsId"]);
    }

    function setPostsLimit($n){
        $_SESSION["postsLimit"] = $n;
    }
    function setPostsId($postsId){
        $_SESSION["postsId"] = $postsId;
    }

    function addPost($post) {
        if(!isset($_SESSION["posts"])) {
            $_SESSION["posts"] = [];
        }
        array_push($_SESSION["posts"], $post);
    }

    // ----------------- POST-RESULTS functions
    function getPosts() {
        return getSessionArray("posts");
    }
    
    function getPostTitle($post) {
        return $post->title;
    }
    
    function getPostText($post) {
        return $post->text;
    }

    function getPostAuthor($post) {
        return $post->authorName;
    }
    
    function getPostPostId($post) {
        return $post->postId;
    }
    
    function getPostContributors($post) {
        return $post->contributors;
    }

    function getPostAttachments($post) {
        return $post->attachments;
    }

    function getPostAttachmentsType($post) {
        return $post->attachmentsType;
    }

    function getPostAttachmentsName($post) {
        return $post->attachmentsName;
    }

    function getPostSector($post) {
        return $post->sector;
    }

    function getPostLikes($post) {
        return $post->likes;
    }

    function getPostComments($post) {
        return $post->comments;
    }

    function getPostTags($post) {
        return $post->tags;
    }

    function getPostTimestamp($post) {
        return $post->timestamp;
    }


    // ----------------- POST-ATTACHMENTS-RESULTS functions

    function loadAttachments($post) {
        for($i=0; $i<count(getPostAttachments($post)); $i++) {
            loadAttachment(getPostAttachments($post)[$i],getPostAttachmentsName($post)[$i],getPostAttachmentsType($post)[$i]);
        }
    }

    function loadAttachment($attach, $attachName, $attachType) {
       if(str_contains($attachType, "image")) {
            echo "<img src=\"". $attach ."\" download=\"".$attachName."\">";
       } else if(str_contains($attachType, "audio")) {
        echo "<audio controls=\"\" src=\"". $attach ."\" download=\"".$attachName."\"></audio>";
        } else if(str_contains($attachType, "video")) {
            echo "<video controls=\"\" src=\"".$attach."\" download=\"".$attachName."\"></video>";        
        } else {
            echo "<a href=\"".$attach."\" download=\"".$attachName."\">\"".$attachName."\"</a>";
       }
    }

    function clearAttachmentsDirecory() {
        // create dir if not present
        if(!is_dir($_SESSION["ATTACHMENTS_DIRECTORY"])) {
            mkdir($_SESSION["ATTACHMENTS_DIRECTORY"], 0777, true);
        }
        // clear attachments in directory
        foreach(scandir($_SESSION["ATTACHMENTS_DIRECTORY"]) as $filename) {
            $filename_abs = realpath($_SESSION["ATTACHMENTS_DIRECTORY"]."/".$filename);
            if(is_file($filename_abs)) {
                unlink($filename_abs);
            }
        }
    }

    function saveAttachment($attachName, $attachData) {
        $filename = $_SESSION["ATTACHMENTS_DIRECTORY"]."/".$attachName;
        file_put_contents($filename, $attachData);
        return $filename;
    }

    // ----------------- POST-COMMENT-RESULTS functions

    function getCommentId($comment) {
        return $comment->commentId;
    }

    function getCommentAuthor($comment) {
        return $comment->author;
    }

    function getCommentText($comment) {
        return $comment->text;
    }

    function getCommentParentId($comment) {
        return $comment->parentId;
    }

    function getCommentTimestamp($comment) {
        return $comment->timestamp;
    }

    function loadComments($post) {
        echo '<ul class="list-unstyled">';
        foreach(getPostComments($post) as $comment) {
            if("" == getCommentParentId($comment)) {
                echo loadComment($comment,$post);
            }
        }
        echo '</ul>';
    }

    function loadComment($comment,$post) {
        return '  <li id="com-'.getCommentId($comment).'" class="comment">
                    <p>| <strong>'.getCommentAuthor($comment).':</strong> '.getCommentText($comment).'</p>
                    <span onclick="toggleReply(event)" class="reply-button">Reply</span>
                    <form onsubmit="addComment(event)" class="reply-form">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Your reply">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                    <div class="replies">
                    <ul>'.loadCommentChildren($comment,$post).'</ul>
                    </div>
                </li>';
    }

    function loadCommentChildren($comment,$post) {
        foreach(getPostComments($post) as $children) {
            if(getCommentParentId($children) == getCommentId($comment)) {
                return loadComment($children,$post);
            }
        }
    }

?>

