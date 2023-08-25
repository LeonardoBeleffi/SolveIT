<?php
    // require defaults PHPs
    require_once 'utils/bootstrap.php';
    
    // check login routine
    checkUserLogin();
    // echo "Username: " . getUsername() . "<br>".
    // "idUtente: " . getIdUtente(). "<br>".
    // "sectorId: " . getUserSectorId();

    // set post query parameter
    clearPosts();
    setPostsLimit(100);

    // clear notifications
    clearNotifications();

    // require post query helper
    include "utils/download.php";

    // set template elements
    clearTemplate();
    setTitle("Home - SolveIT");
    setMain("home/home-main.php");
    setHeader("home/home-header.php");
    setFooter("home/home-footer.php");
    setCSS(["./css/home.css"]);
    setJS(["./js/home.js","./js/posts.js","./js/shared.js"]);

    // require template
    require "template/base.php";
?>
