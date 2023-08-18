
function toggleReply(event){
    getClosestReplyForm(event.target).classList.toggle('expanded');
}

function getClosestReplyForm(target) {
    let parentId = target.closest(".comment").id;
    return document.querySelector("#"+parentId+' .reply-form');
}

function getClosestRepliesDiv(target) {
    let parentId = target.closest(".comment").id;
    return document.querySelector("#"+parentId+' .replies');
}

function addComment(event) {
    event.preventDefault();
    let form = event.target;
    const input = form.querySelector('input');
    const replyText = input.value;
    
    if (replyText.trim() !== '') {
        const repliesContainer = document.querySelector('.replies');
        const newReply = document.createElement('div');
        // get parent commentId
        let parentCommentId = form.closest(".comment").id.split("-")[1];
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
                    console.log("commentId:"+commentId);

                    console.log(xhr.responseText);
                    const repliesContainer = getClosestRepliesDiv(form);
                    const newReply = document.createElement('div');
                    newReply.classList.add('reply');
                    newReply.innerHTML = generateComment("com-"+commentId,replyText,_USERNAME);
                    repliesContainer.appendChild(newReply);
                    input.value = '';
                    form.classList.toggle('expanded');
                } else {
                    console.error('Failed to add comment reply.');
                }
            }
        };
        // send parentId and text
        xhr.send(`parentCommentId=${parentCommentId}&text=${replyText}`);
    }
}

function generateComment(id, text, author) {
    // TODO with query to php
    return `<li id="`+id+`" class="comment">
                <p>| <strong>`+author+`:</strong> `+text+`</p>
                <span onclick="toggleReply(event)" class="reply-button">Reply</span>
                <form onsubmit="addComment(event)" class="reply-form">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Your reply">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
                <ul class="replies">
                </ul>
            </li>`;
}

