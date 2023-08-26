<?php
    // require defaults PHPs
    require_once 'utils/bootstrap.php';
    
    // check login routine
    checkUserLogin();

    // set post query parameter
    clearPosts();
    setPostsLimit(100);

    // clear notifications
    clearNotifications();

    // require post query helper
    include "utils/download.php";

    // set template elements
    clearTemplate();
    setTitle("Profile - SolveIT");
    setMain("profile/profile-main.php");
    setHeader("home/home-header.php");
    setFooter("home/home-footer.php");
    setCSS(["./css/profile.css", "./css/home.css"]);
    setRemoteCSS(["https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"]);
    setJS(["./js/shared.js"]);

    // require template
    require "template/base.php";
?>
