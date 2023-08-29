"use strict";

document.addEventListener("click", (event) =>{
    if(event.target.classList.contains("reply-button")){ 
        toggleReply(event);
    }
    if(event.target.classList.contains("delete-button")){ 
        closeReplyOnDelete(event);
        deleteComment(event);
    }
});

function toggleReply(event){
    getClosestReplyForm(event.target).classList.toggle('expanded');
}

function closeReplyOnDelete(event){
    if(getClosestReplyForm(event.target).classList.contains('expanded'))
        getClosestReplyForm(event.target).classList.remove('expanded');
    return 
}

function getClosestReplyForm(target) {
    let parentId = target.closest(".comment").id;
    return document.querySelector("#"+parentId+' .reply-form');
}

function getRootReplies(target) {
    let postId = target.closest(".post").id;
    return document.querySelector("#"+postId+" .replies");
}
function getClosestReplies(target) {
    let parentId = target.closest(".comment").id;
    return document.querySelector("#"+parentId+' .replies');
}

// COMMENTs
function deleteComment(event) {
    event.preventDefault();
    const delete_button = event.target;
    const comment = delete_button.closest(".comment");
    const commentId = comment.id.split("-")[1];
    const commentText = comment.querySelector('.comment-text');
    const reply_button = comment.querySelector('.reply-button');


    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'utils/deleteComment.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                delete_button.style.display = "none";
                comment.removeChild(delete_button);
                comment.removeChild(reply_button);
                
                commentText.innerHTML = "This comment has been deleted.";
                commentText.classList.add('deleted-comment');
            } else {
                console.error('Failed to add comment reply.');
            }
        }
    };
    // send parentId and text
    xhr.send(`commentId=${commentId}`);

}

function addComment(event) {
    event.preventDefault();
    let form = event.target;
    const input = form.querySelector('input');
    const replyText = input.value;

    if (replyText.trim() !== '') {
        let parentCommentId = null;
        let postId = form.closest(".post").id.split("-")[1];
        const isRootComment = form.classList.contains("root-comment");
        
        if(!isRootComment) {
            // get parent commentId
            parentCommentId = form.closest(".comment").id.split("-")[1];
        }
        
        console.log("parentCommentId:"+parentCommentId);
        // Send AJAX request to add comment reply
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'utils/addComment.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);
                    const commentId = response.commentId;
                    const commentNumber = response.commentNumber;
                    const commentElement = response.commentElement;

                    console.log(xhr.responseText);

                    let repliesContainer;
                    if(!isRootComment) {
                        repliesContainer = getClosestReplies(form);
                    } else {
                        repliesContainer = getRootReplies(form);
                    }
                    repliesContainer.innerHTML = repliesContainer.innerHTML + commentElement;
                    // repliesContainer.querySelector(".comment")[]
                    let commentsSection = document.querySelector("#post-"+postId+' .comments-count');
                    console.log(commentNumber);
                    commentsSection.innerHTML = commentNumber+" comments";
                    input.value = '';
                    if(!isRootComment) {
                        form.classList.toggle('expanded');
                    }
                } else {
                    console.error('Failed to add comment reply.');
                }
            }
        };
        // send parentId and text
        xhr.send(`parentCommentId=${parentCommentId}&postId=${postId}&text=${replyText}`);
    }
}

// LIKEs
function toggleLike(event) {
    
    event.preventDefault();
    const likeBut = event.currentTarget;
    const postId = likeBut.closest(".post").id.split("-")[1];

    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'utils/addLike.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                // console.log(xhr.responseText);
                const response = JSON.parse(xhr.responseText);
                const likes = response.likes;
                const isLiked = response.isLiked;
                if(isLiked) likeBut.classList.add('liked');
                else likeBut.classList.remove('liked');

                const likesCount = document.querySelector("#post-" + postId + ' .likes-count');
                likesCount.innerHTML = "liked by " + likes;
            } else {
                console.error('Failed to add like.');
            }
        }
    };
    // send parentId and text
    xhr.send(`postId=${postId}`);

}