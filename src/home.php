<?php
    // require defaults PHPs
    require_once 'utils/bootstrap.php';
    
    // check login routine
    checkUserLogin();
    //echo "Username: " . getUsername() . "<br>".
    //    "idUtente: " . getIdUtente();

    // set post query parameter
    clearPosts();
    setPostsLimit(100);

    // require post query helper
    require "utils/download.php";

    // set template elements
    clearTemplate();
    setTitle("Home - SolveIT");
    setMain("home/home-main.php");
    setHeader("home/home-header.php");
    setFooter("home/home-footer.php");
    setCSS(["./css/home.css"]);
    setJS(["./js/home.js","./js/posts.js"]);

    // require template
    require "template/base.php";
?>