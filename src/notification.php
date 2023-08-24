<?php 
    // require defaults PHPs
    require_once 'utils/bootstrap.php';

    // check login routine
    checkUserLogin();
    
    // query all 
    clearPosts();
    setPostsLimit(100);

    // clear notifications
    clearNotifications();

    // require post query helper
    require "utils/download.php";


    // set template elements
    clearTemplate();
    setTitle("Post - SolveIT");
    setHeader("notification/notification-header.php");
    setMain("notification/notification-main.php");
    setFooter("home/home-footer.php");
    setCSS(["./css/notification.css", "./css/home.css", "./css/fontawesome-free-6.4.2-web/css/all.min.css"]);

    // require template
    require "template/base.php";
?>