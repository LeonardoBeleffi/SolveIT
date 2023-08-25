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

    // mark all notifications as read
    foreach(getNotifications() as $not) {
        $dbh->updateNotifica(getNotificationId($not), 1);
    }

    // set template elements
    clearTemplate();
    setTitle("Post - SolveIT");
    setHeader("notification/notification-header.php");
    setMain("notification/notification-main.php");
    setFooter("home/home-footer.php");
    setCSS(["./css/notification.css", "./css/home.css"]);
    setRemoteCSS(["https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"]);

    // require template
    require "template/base.php";
?>