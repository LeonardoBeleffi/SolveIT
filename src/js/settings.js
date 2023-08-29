window.addEventListener("load", () => {
     fix_heights();
     let nav_bar_links = Array.from(document.querySelectorAll("#nav-bar")[0].children)
     let changeThemeButton = document.querySelectorAll(".change-theme")[0];

     initializeNavBar(nav_bar_links);
     addNotificationButton();

     changeThemeButton.addEventListener("click", event =>{
        //toggleSiteTheme();
     });

});