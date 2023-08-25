
function toggleReply(event){
    getClosestReplyForm(event.target).classList.toggle('expanded');
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

                    console.log(xhr.responseText);

                    let repliesContainer;
                    if(!isRootComment) {
                        repliesContainer = getClosestReplies(form);
                    } else {
                        repliesContainer = getRootReplies(form);
                    }
                    repliesContainer.innerHTML = repliesContainer.innerHTML + generateComment("com-"+commentId,replyText,_USERNAME);
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

function generateComment(id, text, author) {
    // TODO with query to php
    return `<li id="`+id+`" class="comment">
                <p>| <strong>`+author+`:</strong> `+text+`</p>
                <span onclick="toggleReply(event)" class="reply-button">Reply</span>
                <form onsubmit="addComment(event)" class="reply-form">
                    <div class="form-input">
                        <input type="text" class="form-input"" placeholder="Reply">
                    </div>
                    <button type="submit" class="comment-button">
                        <i class="fa-solid fa-reply"></i>
                    </button>
                </form>
                <ul class="replies">
                </ul>
            </li>`;
}

// LIKEs
function addLike(event) {
    event.preventDefault();
    let likeBut = event.target;
    let postId = likeBut.closest(".post").id.split("-")[1];
    
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'utils/addLike.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                console.log(xhr.responseText);
                const response = JSON.parse(xhr.responseText);
                const likes = response.likes;

                const likesCount = document.querySelector("#post-"+postId+' .likes-count');
                likesCount.innerHTML = "liked by: "+ likes;
            } else {
                console.error('Failed to add comment reply.');
            }
        }
    };
    // send parentId and text
    xhr.send(`postId=${postId}`);

}
