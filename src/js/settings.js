"use strict";

window.addEventListener("load", () => {
    fix_heights()
    // let change = document.querySelectorAll("#logout-button")[0];

    // if(logoutButton) {
        // logoutButton.addEventListener("click", event =>{
            // window.location.replace("./utils/logout.php");
        // });
    // }

});

window.addEventListener("click", event => {
    if (event.target === document.querySelector("#change-theme-button")) {
        window.location.href = "./utils/changeTheme.php";
        return;
    }
});

function changeTheme(params) {
    // Send AJAX request to add comment reply
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'utils/search.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                suggestionsContainer.innerHTML = '';
                // parse response
                const response = JSON.parse(xhr.responseText);
                const usernames = response.usernames;
                const tags = response.tags;
                // console.log(xhr.responseText);
                // foreach user
                usernames.forEach((username) => displayUsername(username));
                // foreach tag
                tags.forEach((tag) => displayTag(tag));
                isQuering = false;

                } else {
                    console.error('Failed to search.');
                }
            }
        };
        // send parentId and text
        isQuering=true;
        xhr.send(`text=${searchText}`);
}

