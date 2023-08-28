"use strict";

// FOLLOW

function toggleFollow(event) {
    event.preventDefault();
	const profileContainer = event.target.closest(".profile-container");
	const username = profileContainer.id.split("-")[1];
	const follow_button = profileContainer.querySelector(".follow-button");
	const follower_count = profileContainer.querySelector(".followers-count");
    // Send AJAX request to add comment reply
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'utils/addFriendship.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
				console.log(xhr.responseText);
				const response = JSON.parse(xhr.responseText);
				const followers = response.followers;
				const inFollowers = response.inFollowers;
				follow_button.innerHTML = (inFollowers) ? "Unfollow" : "Follow" ;
				follower_count.innerHTML = followers;
            } else {
                console.error('Failed to search.');
            }
        }
    };
    xhr.send(`username=${username}`);
}

window.addEventListener("load", () => {
    fix_heights()
    let logoutButton = document.querySelectorAll("#logout-button")[0];

	if(logoutButton) {
		logoutButton.addEventListener("click", event =>{
			window.location.replace("./utils/logout.php");
		});
	}
    
});