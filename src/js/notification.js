window.addEventListener("load", () => {
    nav_bar_links = Array.from(document.querySelectorAll("#nav-bar")[0].children);

    initializeNavBar(nav_bar_links);
    addNotificationButton()
});

