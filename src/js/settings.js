"use strict";

window.addEventListener("load", () => {
    fix_heights();

    initializeNavBar();
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

