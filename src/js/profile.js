
// FOLLOW

function follow(event) {
    event.preventDefault();
    // Send AJAX request to add comment reply
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'utils/addFriendship.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                console.log("all ok")
            } else {
                console.error('Failed to search.');
            }
        }
    };
    xhr.send(`username=${_USERNAME}`);
}
