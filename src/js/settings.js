"use strict";

window.addEventListener("click", event => {
    if (event.target === document.querySelector("#change-theme-button")) {
        window.location.href = "./utils/changeTheme.php";
        return;
    }
});

