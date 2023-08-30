"use strict";

// SEARCH

function search(event) {
    event.preventDefault();
    const input = event.target;
    const searchText = input.value;
    const suggestionsContainer = document.querySelector('.suggestions');



    if (searchText.trim() !== '') {
        suggestionsContainer.innerHTML = '';
        // Send AJAX request to add comment reply
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'utils/search.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    suggestionsContainer.innerHTML = '';
                    // parse response
                    console.log(xhr.responseText);
                    const response = JSON.parse(xhr.responseText);
                    const usernames = response.usernames;
                    const tags = response.tags;
                    // foreach user
                    usernames.forEach((username) => displayUsername(username));
                    // foreach tag
                    tags.forEach((tag) => displayTag(tag));

                } else {
                    console.error('Failed to search.');
                }
            }
        };
        // send parentId and text
        xhr.send(`text=${searchText}`);
    }
}

function displayTag(tag) {
    const suggestionsContainer = document.querySelector('.suggestions');
    const suggestionElement = document.createElement('span');
    suggestionElement.classList.add('suggestion');
    suggestionElement.textContent = "# "+tag;
    suggestionElement.addEventListener('click', () => {
        window.location.href = './search.php?tag='+tag;
    });
    suggestionsContainer.appendChild(suggestionElement);
}

function displayUsername(username) {
    const suggestionsContainer = document.querySelector('.suggestions');
    const suggestionElement = document.createElement('span');
    suggestionElement.classList.add('suggestion');
    suggestionElement.textContent = "@ "+ username;
    suggestionElement.addEventListener('click', () => {
        window.location.href = './profile.php?user='+username;
    });
    suggestionsContainer.appendChild(suggestionElement);

}

