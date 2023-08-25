<?php

    // ----------------- POST-QUERY functions
    function clearPosts(){
        unset($_SESSION["posts"]);
        unset($_SESSION["postsLimit"]);
        unset($_SESSION["postsId"]);
        unset($_SESSION["postTag"]);
        unset($_SESSION["postUser"]);
    }

    function setPostsLimit($n){
        $_SESSION["postsLimit"] = $n;
    }
    function setPostsId($postsId){
        $_SESSION["postsId"] = $postsId;
    }
    function setPostTag($postTag){
        $_SESSION["postTag"] = $postTag;
    }
    function setPostUser($postUser){
        $_SESSION["postUser"] = $postUser;
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
    
    function getPostId($post) {
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
            echo "<img class=\"img-attachment\" src=\"". $attach ."\" download=\"".$attachName."\">";
       } else if(str_contains($attachType, "audio")) {
        echo "<audio class=\"audio-attachment\" controls=\"\" src=\"". $attach ."\" download=\"".$attachName."\"></audio>";
        } else if(str_contains($attachType, "video")) {
            echo "<video class=\"video-attachment\" controls=\"\" src=\"".$attach."\" download=\"".$attachName."\"></video>";        
        } else {
            echo "<a class=\"other-attachment\" href=\"".$attach."\" download=\"".$attachName."\">\"".$attachName."\"</a>";
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
        return ($comment->deleted)
            ? "This comment has been deleted."
            : $comment->text;
    }

    function getCommentParentId($comment) {
        return $comment->parentId;
    }

    function getCommentTimestamp($comment) {
        return $comment->timestamp;
    }

    function isCommentDeleted($comment) {
        return $comment->deleted;
    }

    function loadComments($post) {
        echo '<ul class="list-unstyled replies">';
        foreach(getPostComments($post) as $comment) {
            if("" == getCommentParentId($comment)) {
                echo loadComment($comment,$post);
            }
        }
        echo '</ul>';
    }

    function loadComment($comment,$post) {
        return '  <li id="com-'.getCommentId($comment).'" class="comment">
                    <p>| <emph>'.getCommentAuthor($comment).':</emph> <span class="comment-text '.(isCommentDeleted($comment)? 'deleted-comment' : '').'">'.getCommentText($comment).'</span></p>
                    <span onclick="toggleReply(event)" class="reply-button">Reply</span>
                    '.(getCommentAuthor($comment) == getUsername() and !isCommentDeleted($comment) ? '<span onclick="deleteComment(event)" class="delete-button">Delete</span>' : '' ).'
                    <form onsubmit="addComment(event)" class="reply-form">
                        <div class="form-group">
                            <input type="text" class="form-input" placeholder="replying to @'.getCommentAuthor($comment).'">
                            <button type="submit" class="button">
                                <i class="fa-solid fa-reply"></i>
                            </button>
                        </div>
                    </form>
                    <ul class="replies">
                    '.loadCommentChildren($comment,$post).'
                    </ul>
                </li>';
    }

    function loadCommentChildren($comment,$post) {
        $ret = "";
        foreach(getPostComments($post) as $children) {
            if(getCommentParentId($children) == getCommentId($comment)) {
                $ret = $ret.loadComment($children,$post);
            }
        }
        return $ret;
    }

?>

